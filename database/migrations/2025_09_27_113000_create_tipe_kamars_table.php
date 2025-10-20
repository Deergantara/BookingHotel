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
        Schema::create('tipe_kamars', function (Blueprint $table) {
    $table->id();
    $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
    $table->string('nama_tipe');
    $table->text('deskripsi');
    $table->integer('kapasitas');
    $table->decimal('harga', 10, 2);
    $table->json('fasilitas_kamar')->nullable();
    $table->integer('stok_kamar')->default(0);
    $table->string('foto')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_kamars');
    }
};
