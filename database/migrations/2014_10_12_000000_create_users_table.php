<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->boolean('is_admin')->default(0);
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->timestamp('email_verified_at')->nullable()->comment('if null then verifield, not null then not verified');
            $table->string('email_verified_token')->nullable()->comment('Token for email/phone verification, if null then verifield, not null then not verified');
            $table->string('phone')->nullable()->unique();
            $table->string('password');
            $table->json('address')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('avater')->nullable();

            $table->integer('role_id')->default(6); //1->admin, 2->moderator, 3->customer

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
