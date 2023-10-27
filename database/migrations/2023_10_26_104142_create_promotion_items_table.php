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
        Schema::create('promotion_items', function (Blueprint $table) {
            $table->bigIncrements("promotion_itemID")->unique(); 
            // $table->boolean('status')->default(false);
            $table->decimal('sale_price')->default(0);
            $table->foreignId('promotionID')->constrained('promotions', 'promotionID')->onDelete('cascade');
            $table->foreignId('productID')->constrained('products', 'productID')->onDelete('cascade');
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
        Schema::dropIfExists('promotion_items');
    }
};
