<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Ubah ke string untuk menghindari masalah ENUM
            $table->string('status', 20)->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Kembalikan ke ENUM jika rollback
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->change();
        });
    }
};
