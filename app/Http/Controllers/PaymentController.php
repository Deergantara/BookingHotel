<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Buat transaksi pembayaran dan redirect ke Snap
     */
    public function createTransaction(Booking $booking)
    {
        // Cek apakah booking milik user yang login atau booking guest
        if (auth()->check() && $booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah sudah dibayar
        if ($booking->payment && $booking->payment->transaction_status === 'settlement') {
            return redirect()
                ->route('booking.confirmation', $booking->id)
                ->with('info', 'Booking ini sudah dibayar.');
        }

        // Load relasi
        $booking->load(['property', 'kamar.tipeKamar', 'payment', 'user']);

        // Pastikan ada payment record
        if (!$booking->payment) {
            return redirect()
                ->back()
                ->with('error', 'Payment record tidak ditemukan.');
        }

        // Siapkan parameter transaksi untuk Midtrans
        $orderId = $booking->payment->midtrans_order_id;
        $grossAmount = (int) $booking->payment->price;

        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ];

        // Item details
        $itemDetails = [
            [
                'id' => $booking->kamar->tipeKamar->id,
                'price' => (int) $booking->kamar->tipeKamar->harga,
                'quantity' => \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date),
                'name' => $booking->kamar->tipeKamar->nama_tipe . ' - ' . $booking->property->name,
            ]
        ];

        // Customer details
        $customerDetails = [
            'first_name' => $booking->user->name,
            'email' => $booking->user->email,
            'phone' => $booking->user->phone ?? '08123456789',
        ];

        // Transaction data
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
            'enabled_payments' => [
                'credit_card',
                'bca_va',
                'bni_va',
                'bri_va',
                'permata_va',
                'other_va',
                'gopay',
                'shopeepay',
                'qris'
            ],
            'callbacks' => [
                'finish' => route('payment.finish', $booking->id),
            ]
        ];

        try {
            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($transaction);

            // Update payment record dengan snap token
            $booking->payment->update([
                'snap_token' => $snapToken,
            ]);

            // Redirect ke halaman payment dengan snap token
            return view('payment.show', [
                'booking' => $booking,
                'snapToken' => $snapToken,
            ]);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment finish (redirect dari Midtrans)
     */
    public function finish(Booking $booking)
    {
        $booking->load(['property', 'kamar.tipeKamar', 'payment', 'user']);

        return view('payment.finish', compact('booking'));
    }

    /**
     * Handle notification callback dari Midtrans
     */
    public function notification(Request $request)
    {
        try {
            // Buat instance notifikasi
            $notification = new Notification();

            // Data dari notifikasi
            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $transactionId = $notification->transaction_id;
            $paymentType = $notification->payment_type;
            $transactionTime = $notification->transaction_time;

            // Cari payment berdasarkan order_id
            $payment = Payment::where('midtrans_order_id', $orderId)->firstOrFail();
            $booking = Booking::where('payment_id', $payment->id)->first();

            // Update payment data
            $payment->transaction_id = $transactionId;
            $payment->payment_type = $paymentType;
            $payment->transaction_time = $transactionTime;

            // Handle berdasarkan status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    // Payment success
                    $payment->transaction_status = 'settlement';
                    $payment->paid_at = now();
                    if ($booking) {
                        $booking->status = 'confirmed';
                        $booking->save();
                    }
                }
            } elseif ($transactionStatus == 'settlement') {
                // Payment success
                $payment->transaction_status = 'settlement';
                $payment->paid_at = now();
                if ($booking) {
                    $booking->status = 'confirmed';
                    $booking->save();
                }
            } elseif ($transactionStatus == 'pending') {
                // Payment pending
                $payment->transaction_status = 'pending';
                if ($booking) {
                    $booking->status = 'pending';
                    $booking->save();
                }
            } elseif ($transactionStatus == 'deny') {
                // Payment denied
                $payment->transaction_status = 'deny';
            } elseif ($transactionStatus == 'expire') {
                // Payment expired
                $payment->transaction_status = 'expire';
                if ($booking) {
                    $booking->status = 'cancelled';
                    $booking->save();
                }
            } elseif ($transactionStatus == 'cancel') {
                // Payment cancelled
                $payment->transaction_status = 'cancel';
                if ($booking) {
                    $booking->status = 'cancelled';
                    $booking->save();
                }
            }

            $payment->save();

            return response()->json([
                'success' => true,
                'message' => 'Notification processed successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cek status pembayaran
     */
    public function checkStatus(Booking $booking)
    {
        if (!$booking->payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'status' => $booking->payment->transaction_status,
            'booking_status' => $booking->status,
        ]);
    }
}
