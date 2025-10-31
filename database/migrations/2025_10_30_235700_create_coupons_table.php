<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained('properties')->nullOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('type', ['offline', 'online'])->default('online');
            $table->enum('scope', ['all_hotels', 'specific_property'])->default('specific_property');
            $table->enum('discount_type', ['fixed', 'percentage'])->default('percentage');
            $table->decimal('discount_value', 10, 2);
            $table->decimal('min_payment', 10, 2)->nullable();
            $table->decimal('max_payment', 10, 2)->nullable();
            $table->integer('quota')->default(0);
            $table->integer('used')->default(0);
            $table->date('valid_from')->nullable();
            $table->date('valid_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
