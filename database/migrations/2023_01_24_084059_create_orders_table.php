<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('cod');
            $table->double('subtotal_amount');
            $table->double('delivery_charge');
            $table->double('total_amount');
            $table->double('paid_amount')->default(0);
            $table->string('payment_status')->default('unpaid');
            $table->unsignedInteger('total_quantity');
            $table->text('delivery_address');
            $table->text('order_note')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
