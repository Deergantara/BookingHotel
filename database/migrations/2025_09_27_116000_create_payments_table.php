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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();

            $table->string('midtrans_order_id');
            $table->string('transaction_id')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('payment_type')->nullable();
            $table->dateTime('transaction_time')->nullable();
            
            $table->enum('transaction_status', ['pending','settlement','cancel','expire','deny'])->default('pending');

            $table->dateTime('paid_at')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
