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
            $table->bigIncrements('id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('icon')->nullable();
            $table->text('desc_ar')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('desc_en')->nullable();
            $table->double('price')->default(0)->nullable();
            $table->tinyInteger('is_offer')->default(0)->nullable();
            $table->double('offer_amount')->default(0)->nullable();
            $table->double('price_after_offer')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('rate')->default(0)->nullable();
            $table->integer('seen')->default(0)->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('set null');  // make cascade manual in some e-commerce.
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
