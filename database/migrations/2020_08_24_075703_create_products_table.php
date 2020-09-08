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
//             $table->string('Uid');

           // $table->unsignedBigInteger('user_id'); //changed this line
           //  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('title')->nullable();

            $table->longText('description')->nullable();
            $table->string('image');    
            $table->integer('layout_id')->nullable();
            
            $table->integer('theme_id')->nullable();
            $table->longText('shipping_details')->nullable();
            $table->longText('payment_details')->nullable();

            $table->longText('return_policy')->nullable();
            $table->longText('additional_details')->nullable();
            $table->integer('user_id');

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
