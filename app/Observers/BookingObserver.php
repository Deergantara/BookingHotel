<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\Coupon;

class BookingObserver
{
    /**
     * Handle the Booking "creating" event.
     * Auto-calculate subtotal, pajak, dan total_harga sebelum booking dibuat
     */
    public function creating(Booking $booking): void
    {
        $this->calculateBookingPrice($booking);
    }

    /**
     * Handle the Booking "updating" event.
     * Auto-calculate ulang jika ada perubahan data
     */
    public function updating(Booking $booking): void
    {
        // Hanya recalculate jika field yang berpengaruh berubah
        if ($booking->isDirty(['kamar_id', 'checkin_date', 'checkout_date', 'coupon_id'])) {
            $this->calculateBookingPrice($booking);
        }
    }

    /**
     * Calculate booking price dengan formula:
     * - subtotal = (harga kamar × jumlah malam) - diskon coupon
     * - pajak = subtotal × 10%
     * - total_harga = subtotal + pajak
     */
    private function calculateBookingPrice(Booking $booking): void
    {
        // Pastikan data lengkap
        if (!$booking->kamar_id || !$booking->checkin_date || !$booking->checkout_date) {
            return;
        }

        // Ambil harga kamar dari TipeKamar
        $tipeKamar = $booking->tipeKamar;
        if (!$tipeKamar) {
            return;
        }

        $hargaPerMalam = $tipeKamar->harga ?? 0;

        // Hitung jumlah malam
        $checkin = \Carbon\Carbon::parse($booking->checkin_date);
        $checkout = \Carbon\Carbon::parse($booking->checkout_date);
        $jumlahMalam = $checkin->diffInDays($checkout);

        // Pastikan minimal 1 malam
        if ($jumlahMalam < 1) {
            $jumlahMalam = 1;
        }

        // Hitung subtotal sebelum diskon
        $subtotalSebelumDiskon = $hargaPerMalam * $jumlahMalam;

        // Hitung diskon dari coupon (jika ada)
        $diskon = 0;
        if ($booking->coupon_id) {
            $coupon = Coupon::find($booking->coupon_id);

            if ($coupon && $coupon->is_active) {
                // Cek apakah coupon masih valid
                $now = now();
                $isValid = (!$coupon->valid_from || $now->gte($coupon->valid_from)) &&
                           (!$coupon->valid_until || $now->lte($coupon->valid_until));

                if ($isValid) {
                    // Hitung diskon berdasarkan tipe
                    if ($coupon->discount_type === 'percentage') {
                        // Diskon persentase
                        $diskon = ($subtotalSebelumDiskon * $coupon->discount_value) / 100;

                        // Batasi dengan max_discount jika ada
                        if ($coupon->max_discount && $diskon > $coupon->max_discount) {
                            $diskon = $coupon->max_discount;
                        }
                    } else {
                        // Diskon fixed amount
                        $diskon = $coupon->discount_value;

                        // Pastikan diskon tidak lebih besar dari subtotal
                        if ($diskon > $subtotalSebelumDiskon) {
                            $diskon = $subtotalSebelumDiskon;
                        }
                    }

                    // Cek minimum purchase
                    if ($coupon->min_purchase && $subtotalSebelumDiskon < $coupon->min_purchase) {
                        $diskon = 0;
                    }
                }
            }
        }

        // Hitung subtotal setelah diskon
        $subtotal = $subtotalSebelumDiskon - $diskon;

        // Hitung pajak 10%
        $pajak = $subtotal * 0.10;

        // Hitung total harga
        $totalHarga = $subtotal + $pajak;

        // Set nilai ke booking
        $booking->subtotal = round($subtotal, 2);
        $booking->pajak = round($pajak, 2);
        $booking->total_harga = round($totalHarga, 2);

        // Optional: simpan info diskon jika mau tracking
        // $booking->discount_amount = round($diskon, 2);
    }
}
