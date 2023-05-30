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
        Schema::create('store_inventories', function (Blueprint $table) {
            $table->bigIncrements('store_inventoryID');
            $table->integer('quantity')->default(0);
            $table->integer('alert')->default(0);

            // Add foreign key constraints
            $table->foreignId('storeID')->constrained('stores', 'storeID')->onDelete('cascade');
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
        Schema::dropIfExists('store_inventories');
    }
};
