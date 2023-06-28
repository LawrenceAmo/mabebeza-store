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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('deliveryID');
            $table->string('car_number_plade')->nullable();
            $table->string('car_model')->nullable();
            $table->integer('qty')->default(1); 
            $table->enum('status', ['pending', 'shipped', 'delivered'])->default('pending');
            $table->foreignId('driverID')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('userID')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('orderID')->constrained('orders', 'orderID')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
};
