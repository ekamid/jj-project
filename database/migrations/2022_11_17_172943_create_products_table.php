<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->double('price');
            $table->double('weight');
            $table->double('karat');
            $table->integer('stock');
            $table->boolean('published')->default(0);
            $table->json('physical_store')->nullable();
            $table->text('description')->nullable();
            $table->json('categories')->nullable();
            $table->json('images')->nullable(); //images will be a array of objects. feature image will be the first one if there is no featured image
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
        Schema::dropIfExists('products');
    }
}
