<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('country_id');
            $table->string('city_id');
            $table->string('zipcode');
            $table->string('address');
            $table->string('product_status')->default(1)->comment('1=pending 2=shipping 3=deliver');
            $table->string('payment_status')->default(1)->comment('1=unpaid 2=paid');
            $table->string('total_amount');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('shippings');
    }
}
