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
        Schema::rename('volunteer_payments', 'payments');

        Schema::table('payments', function (Blueprint $table) {
            $table->enum('payment_type', ['donasi', 'voluntrip'])->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('payment_type'); // Ini harus terjadi
        });
        Schema::rename('payments', 'volunteer_payments');
    }
};
