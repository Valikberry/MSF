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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 20);
            $table->string('name', 200);
            $table->string('email', 120);
            $table->string('phone_code', 4)->nullable();
            $table->string('phone_no', 15);
            $table->string('whatsapp_no', 20);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->json('services');
            $table->float('total');
            $table->json('pick_locations');
            $table->json('drop_locations');
            $table->date('moving_date');
            $table->time('moving_time');
            $table->json('moving_items');
            $table->text('description')->nullable();
            $table->enum('payment_method', \App\Enums\PaymentMethod::names())->default(\App\Enums\PaymentMethod::cash);
            $table->boolean('google_sheet')->default(0);
            $table->boolean('sms_sent')->default(0);
            $table->timestamps();
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
