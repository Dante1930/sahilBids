<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbayProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebay_product', function (Blueprint $table) {
            $table->id();
            $table->json('Browse_Cateogries');
            $table->string('Primary_Category')->nullable();

            $table->string('Item_Title')->nullable();
            $table->longText('Item_Description')->nullable();
            $table->string('Condition');    
            $table->integer('layout_id')->nullable();
            
            $table->string('Listing Type')->nullable();
            $table->string('Fixed_Price_Item')->nullable();
            $table->string('Listing_Duration')->nullable();

            $table->string('Price')->nullable();
            $table->string('Pictures')->nullable();
            $table->string('Searched_Keyword')->nullable();
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
        Schema::dropIfExists('ebay_product');
    }
}
