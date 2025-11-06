<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pembayaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-2xl w-full">

            @if($booking->payment->transaction_status === 'settlement')
            <!-- SUCCESS -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                    <i class="fas fa-check text-white text-4xl"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-3">Pembayaran Berhasil!</h1>
                <p class="text-gray-600 mb-8">Terima kasih! Pembayaran Anda telah berhasil diproses.</p>

                <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6 mb-6">
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Booking ID</p>
                            <p class="font-bold text-gray-900">#BK{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Status</p>
                            <p class="font-bold text-green-600">PAID</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Metode Pembayaran</p>
                            <p class="font-bold text-gray-900">{{ ucfirst($booking->payment->payment_type ?? '-') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Dibayar</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($booking->payment->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('booking.confirmation', $booking->id) }}"
                       class="block w-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold py-4 px-6 rounded-xl hover:from-yellow-500 hover:to-yellow-700 transition-all">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Lihat Detail Booking
                    </a>

                    <a href="{{ route('homepage') }}"
                       class="block w-full border-2 border-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl hover:bg-gray-50 transition-all">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            @elseif($booking->payment->transaction_status === 'pending')
            <!-- PENDING -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clock text-white text-4xl"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-3">Menunggu Pembayaran</h1>
                <p class="text-gray-600 mb-8">Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran Anda.</p>

                <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6 mb-6">
                    <p class="text-sm text-gray-700 mb-4">
                        <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                        Jika Anda memilih metode pembayaran bank transfer atau e-wallet, silakan selesaikan pembayaran melalui aplikasi bank/e-wallet Anda.
                    </p>
                    <p class="font-bold text-gray-900">Booking ID: #BK{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="space-y-3">
                    <button onclick="checkPaymentStatus()"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold py-4 px-6 rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all">
                        <i class="fas fa-sync-alt mr-2"></i>
                        Cek Status Pembayaran
                    </button>

                    <a href="{{ route('booking.confirmation', $booking->id) }}"
                       class="block w-full border-2 border-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl hover:bg-gray-50 transition-all">
                        <i class="fas fa-file-invoice mr-2"></i>
                        Lihat Detail Booking
                    </a>
                </div>
            </div>

            @else
            <!-- FAILED / CANCELLED -->
            <div class="bg-white rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-times text-white text-4xl"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-3">Pembayaran Gagal</h1>
                <p class="text-gray-600 mb-8">
                    @if($booking->payment->transaction_status === 'expire')
                        Pembayaran Anda telah kadaluarsa. Silakan lakukan booking ulang.
                    @elseif($booking->payment->transaction_status === 'cancel')
                        Pembayaran Anda dibatalkan.
                    @else
                        Pembayaran Anda ditolak. Silakan coba metode pembayaran lain.
                    @endif
                </p>

                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 mb-6">
                    <p class="text-sm text-gray-700">
                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                        Booking ID: #BK{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="text-sm text-gray-700 mt-2">
                        Status: <span class="font-bold text-red-600">{{ strtoupper($booking->payment->transaction_status) }}</span>
                    </p>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('payment.create', $booking->id) }}"
                       class="block w-full bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-bold py-4 px-6 rounded-xl hover:from-yellow-500 hover:to-yellow-700 transition-all">
                        <i class="fas fa-redo mr-2"></i>
                        Coba Bayar Lagi
                    </a>

                    <a href="{{ route('homepage') }}"
                       class="block w-full border-2 border-gray-300 text-gray-700 font-bold py-4 px-6 rounded-xl hover:bg-gray-50 transition-all">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
            @endif

        </div>
    </div>

    <script>
        function checkPaymentStatus() {
            const button = event.target;
            const originalText = button.innerHTML;

            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengecek...';

            fetch('{{ route("payment.status", $booking->id) }}')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === 'settlement') {
                            window.location.reload();
                        } else {
                            alert('Status pembayaran: ' + data.status.toUpperCase());
                            button.disabled = false;
                            button.innerHTML = originalText;
                        }
                    }
                })
                .catch(error => {
                    alert('Gagal mengecek status pembayaran');
                    button.disabled = false;
                    button.innerHTML = originalText;
                });
        }

        // Auto refresh jika pending
        @if($booking->payment->transaction_status === 'pending')
        setTimeout(function() {
            checkPaymentStatus();
        }, 10000); // Check setiap 10 detik
        @endif
    </script>
</body>
</html>
