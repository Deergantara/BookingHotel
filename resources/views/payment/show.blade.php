<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $booking->property->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Midtrans Snap JS -->
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        :root {
            --primary: #0a0a0a;
            --accent: #d4af37;
        }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--accent);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-credit-card text-white text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran</h1>
                <p class="text-gray-600">{{ $booking->property->name }}</p>
            </div>

            <!-- Booking Summary -->
            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <h3 class="font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Booking ID</span>
                        <span class="font-semibold">#BK{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tipe Kamar</span>
                        <span class="font-semibold">{{ $booking->kamar->tipeKamar->nama_tipe }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check-in</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Check-out</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Malam</span>
                        <span class="font-semibold">{{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} malam</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-4 pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-yellow-600">
                            Rp {{ number_format($booking->payment->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment Button -->
            <button id="pay-button"
                    class="w-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold py-4 px-6 rounded-xl hover:from-yellow-500 hover:to-yellow-700 transition-all duration-300 flex items-center justify-center gap-3 shadow-lg">
                <i class="fas fa-lock"></i>
                Bayar Sekarang
            </button>

            <!-- Loading State -->
            <div id="loading" class="hidden text-center py-6">
                <div class="loader mx-auto mb-4"></div>
                <p class="text-gray-600">Memproses pembayaran...</p>
            </div>

            <!-- Cancel Button -->
            <a href="{{ route('booking.confirmation', $booking->id) }}"
               class="block text-center text-gray-600 hover:text-gray-900 mt-4 font-semibold">
                Kembali ke Detail Booking
            </a>

            <!-- Info -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex gap-3">
                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-semibold mb-1">Informasi Pembayaran</p>
                        <p>Anda akan diarahkan ke halaman pembayaran Midtrans yang aman. Pilih metode pembayaran yang Anda inginkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const payButton = document.getElementById('pay-button');
        const loading = document.getElementById('loading');
        const snapToken = '{{ $snapToken }}';

        payButton.addEventListener('click', function () {
            // Show loading
            payButton.style.display = 'none';
            loading.classList.remove('hidden');

            // Open Snap payment page
            snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    // Redirect ke halaman finish
                    window.location.href = '{{ route("payment.finish", $booking->id) }}';
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    // Redirect ke halaman finish
                    window.location.href = '{{ route("payment.finish", $booking->id) }}';
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    alert('Pembayaran gagal! Silakan coba lagi.');
                    payButton.style.display = 'flex';
                    loading.classList.add('hidden');
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    alert('Anda menutup halaman pembayaran sebelum menyelesaikan pembayaran');
                    payButton.style.display = 'flex';
                    loading.classList.add('hidden');
                }
            });
        });

        // Auto check payment status every 5 seconds
        let checkStatusInterval = setInterval(function() {
            fetch('{{ route("payment.status", $booking->id) }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.status === 'settlement') {
                        clearInterval(checkStatusInterval);
                        window.location.href = '{{ route("payment.finish", $booking->id) }}';
                    }
                });
        }, 5000);
    </script>
</body>
</html>
