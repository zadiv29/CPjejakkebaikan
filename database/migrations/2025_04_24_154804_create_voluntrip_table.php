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
        Schema::create('voluntrip', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('name');
            $table->date('start_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('total_ticket');
            $table->text('about');
            $table->boolean('is_active');
            $table->foreignId('fundraiser_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('ticket_price');
            $table->enum('event_status', ['pending', 'active', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntrip');
    }
};
