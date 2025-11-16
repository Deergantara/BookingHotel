<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('fasilitas_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['property_id', 'fasilitas_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_fasilitas');
    }
};
