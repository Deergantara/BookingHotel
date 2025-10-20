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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipe_kamar_id')->constrained('tipe_kamars')->onDelete('cascade');
            $table->string('nomor_kamar')->unique();
            $table->enum('status', ['tersedia','dipesan','ditempati','perbaikan'])->default('tersedia');
            $table->string('lantai')->nullable();
            $table->string('posisi')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse (hapus) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
