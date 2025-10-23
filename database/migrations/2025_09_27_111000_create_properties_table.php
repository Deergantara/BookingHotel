<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel hotels
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');

            // Informasi umum properti
            $table->json('foto')->nullable(); // untuk multiple foto // atau tetap string jika 1 foto saja
            $table->string('name')->nullable(); // nama properti / cabang hotel
            $table->string('address')->nullable();
            $table->string('city')->nullable(); // kota tempat hotel berada
            $table->string('area')->nullable(); // kecamatan / area
            $table->string('contact')->nullable();

            // Informasi kapasitas dan ketersediaan
            $table->integer('jumlah_kamar')->default(1);
            $table->integer('kapasitas_tamu')->default(1);
            $table->date('available_from')->nullable();
            $table->date('available_to')->nullable();

            // Informasi tambahan
            $table->text('fasilitas')->nullable();
            $table->decimal('bintang', 3, 1)->nullable(); // rating hotel
            $table->boolean('is_active')->default(true);

            // Index untuk pencarian cepat
            $table->index(['city', 'area', 'name']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
