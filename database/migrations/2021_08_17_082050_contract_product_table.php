<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContractProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_product', function (Blueprint $table) {

            $table->unsignedBigInteger('contract_id')->unsigned()->index()->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            
            
            $table->unsignedBigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
           

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
        Schema::dropIfExists('contract_product');
    }
}
