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
        Schema::create("volunteers", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('number_phone');
            $table->foreignId('voluntrip_id')
                ->constrained('voluntrip')
                ->onDelete('cascade');
            $table->foreignId('volunteer_payments_id')
                ->nullable()
                ->constrained('volunteer_payments')
                ->onDelete('cascade');
            $table->boolean('is_verified');
            $table->string('verify_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropForeign(['voluntrip_id']);
            $table->dropForeign(['volunteer_payments_id']);
        });

        Schema::dropIfExists('volunteers');
    }
};
