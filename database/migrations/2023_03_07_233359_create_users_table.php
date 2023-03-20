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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id')->unique();
            $table->string('email');
            $table->string('password')->default('lekajkejdi');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('phone')->default('');
            $table->string('address')->default('');
            $table->string('city')->default('');
            $table->string('country')->default('');
            $table->string('postal_code')->default('');
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
};
