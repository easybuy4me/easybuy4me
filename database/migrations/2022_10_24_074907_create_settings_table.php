<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('referral_bonus')->default(0);
            $table->string('vendor_payment_amount')->default(0);
            $table->string('flutterwave_public_key')->default(0);
            $table->string('flutterwave_secret_key')->default(0);
            $table->string('cloudinary_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('splash_screen_img')->nullable();
            $table->string('splash_screen_header')->nullable();
            $table->string('splash_screen_text')->nullable();
            $table->string('favicon')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
