<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    /**
     * Get base URL - otomatis detect ngrok di local
     */
    private function getBaseUrl()
    {
        // Jika di local environment, gunakan ngrok URL
        if (app()->environment('local')) {
            return config('app.ngrok_url', config('app.url'));
        }
        
        return config('app.url');
    }

    /**
     * Buat transaksi pembayaran
     */
    public function createTransaction(Booking $booking)
    {
        // Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);

        // Authorization check
        if (auth()->check() && $booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Load relations
        $booking->load(['property', 'kamar.tipeKamar', 'payment', 'user']);

        if (!$booking->payment) {
            return redirect()
                ->route('booking.confirmation', $booking->id)
                ->with('error', 'Payment record tidak ditemukan.');
        }

        // Siapkan parameter
        $orderId = $booking->payment->midtrans_order_id;
        $grossAmount = (int) $booking->payment->price;

        // Gunakan base URL yang support ngrok
        $baseUrl = $this->getBaseUrl();

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [
                [
                    'id' => $booking->kamar->tipeKamar->id,
                    'price' => $grossAmount,
                    'quantity' => 1,
                    'name' => $booking->kamar->tipeKamar->nama_tipe . ' - ' . $booking->property->name,
                ]
            ],
            'customer_details' => [
                'first_name' => $booking->user->name,
                'email' => $booking->user->email,
                'phone' => $booking->user->phone ?? '08123456789',
            ],
            'callbacks' => [
                'finish' => $baseUrl . '/payment/' . $booking->id . '/finish',
            ],
            'enabled_payments' => [
                'credit_card', 'gopay', 'shopeepay', 'qris',
                'bca_va', 'bni_va', 'bri_va', 'permata_va', 'other_va'
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);

            // Update payment dengan snap token
            $booking->payment->update(['snap_token' => $snapToken]);

            Log::info('Snap token generated', [
                'booking_id' => $booking->id,
                'order_id' => $orderId,
                'base_url' => $baseUrl
            ]);

            return view('payment.show', [
                'booking' => $booking,
                'snapToken' => $snapToken,
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return redirect()
                ->route('booking.confirmation', $booking->id)
                ->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * HANDLE NOTIFICATION FROM MIDTRANS (WEBHOOK)
     * INI YANG PALING PENTING UNTUK NGROK
     */
    public function notification(Request $request)
    {
        Log::info('=== MIDTRANS NOTIFICATION RECEIVED ===');
        Log::info('Headers:', $request->headers->all());
        Log::info('Payload:', $request->all());

        try {
            // Setup Midtrans config
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');

            // Get notification
            $notification = new Notification();
            
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $paymentType = $notification->payment_type;
            $transactionId = $notification->transaction_id;

            Log::info('Processing notification', [
                'order_id' => $orderId,
                'status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $paymentType
            ]);

            // Cari payment berdasarkan order_id
            $payment = Payment::where('midtrans_order_id', $orderId)->first();

            if (!$payment) {
                Log::error('Payment not found for order: ' . $orderId);
                return response()->json(['error' => 'Payment not found'], 404);
            }

            // Cari booking terkait
            $booking = Booking::where('payment_id', $payment->id)->first();

            // Update payment data
            $updateData = [
                'transaction_id' => $transactionId,
                'payment_type' => $paymentType,
                'transaction_status' => $transactionStatus,
            ];

            // Handle status transaksi
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $updateData['transaction_status'] = 'settlement';
                    $updateData['paid_at'] = now();
                    
                    if ($booking) {
                        $booking->update(['status' => 'confirmed']);
                        Log::info('Booking confirmed', ['booking_id' => $booking->id]);
                    }
                }
            } elseif ($transactionStatus == 'settlement') {
                $updateData['transaction_status'] = 'settlement';
                $updateData['paid_at'] = now();
                
                if ($booking) {
                    $booking->update(['status' => 'confirmed']);
                    Log::info('Booking settled', ['booking_id' => $booking->id]);
                }
            } elseif ($transactionStatus == 'pending') {
                $updateData['transaction_status'] = 'pending';
                if ($booking) {
                    $booking->update(['status' => 'pending']);
                }
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $updateData['transaction_status'] = $transactionStatus;
                if ($booking) {
                    $booking->update(['status' => 'cancelled']);
                    // Kembalikan status kamar
                    if ($booking->kamar) {
                        $booking->kamar->update(['status' => 'tersedia']);
                    }
                    Log::info('Booking cancelled', ['booking_id' => $booking->id]);
                }
            }

            $payment->update($updateData);

            Log::info('Payment updated successfully', [
                'order_id' => $orderId,
                'new_status' => $transactionStatus
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Notification processed',
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus
            ]);

        } catch (\Exception $e) {
            Log::error('Error processing notification: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle finish redirect dari Midtrans
     */
    public function finish(Booking $booking)
    {
        Log::info('Finish callback received', [
            'booking_id' => $booking->id,
            'query_params' => request()->all()
        ]);

        $booking->load(['property', 'kamar.tipeKamar', 'payment', 'user']);

        return view('payment.finish', compact('booking'));
    }

    /**
     * Check payment status
     */
    public function checkStatus(Booking $booking)
    {
        if (!$booking->payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $booking->payment->transaction_status,
            'booking_status' => $booking->status,
        ]);
    }
}