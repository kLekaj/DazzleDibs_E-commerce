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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('mpn');
            $table->decimal('price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->decimal('vip_price', 8, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('availability')->default('in stock');
            $table->string('size')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_link');
            $table->string('product_type')->nullable();
            $table->string('eta')->nullable();
            $table->string('brand')->nullable();
            $table->string('gender')->nullable();
            $table->string('color')->nullable();
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
};
