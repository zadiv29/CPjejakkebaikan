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
            Schema::create('volunteer_payments', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('uuid')->nullable();
                $table->string('merchant_trx_id')->unique();
                $table->unsignedBigInteger('amount'); // nominal sesuai ticket_price
                $table->string('payment_method')->nullable();
                $table->string('payment_channel'); // Bank VA, misal: BRI
                $table->string('va_number')->nullable(); // kalau diberikan oleh Ommopay
                $table->timestamp('expired_at'); // waktu kadaluarsa VA
                $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');
                $table->text('callback_payload')->nullable(); // untuk log respon callback
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('volunteer_payments');
        }
    };
