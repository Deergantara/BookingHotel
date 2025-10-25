<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('tax', 12, 2)->default(0)->after('price'); // Pajak
            $table->decimal('total', 12, 2)->default(0)->after('tax'); // Total (price + tax)
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['tax', 'total']);
        });
    }
};
