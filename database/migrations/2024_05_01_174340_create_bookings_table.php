<?php

use App\Enums\BookingStatusType;
use App\Enums\PaymentStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->tinyInteger('guests_count');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->unsignedBigInteger('booking_status_id')->default(BookingStatusType::Pending->value);
            $table->unsignedBigInteger('payment_status_id')->default(PaymentStatusType::Pending->value);
            $table->integer('total_price');
            $table->string('additional_comments');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('booking_status_id')->references('id')->on('booking_statuses');
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses');
        });
    }

    /**
     * Reverse the migrations.

     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
