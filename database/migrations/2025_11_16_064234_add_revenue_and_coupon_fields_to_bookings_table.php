<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambah field untuk coupon
            $table->foreignId('coupon_id')->nullable()->after('review_id')->constrained()->nullOnDelete();

            // Tambah field untuk perhitungan harga
            $table->decimal('subtotal', 12, 2)->default(0)->after('status');
            $table->decimal('pajak', 12, 2)->default(0)->after('subtotal');
            $table->decimal('total_harga', 12, 2)->default(0)->after('pajak');
            $table->decimal('discount_amount', 12, 2)->default(0)->after('total_harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['coupon_id']);
            $table->dropColumn(['coupon_id', 'subtotal', 'pajak', 'total_harga', 'discount_amount']);
        });
    }
};
