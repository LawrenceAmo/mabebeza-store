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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('supplierID')->index();
            $table->string('supplier_name'); 
            $table->string('company_name')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->string('website')->nullable(); 
            $table->string('link')->nullable(); 
            $table->string('description')->nullable();
            // $table->text('product_detail')->nullable();  
            $table->string('street')->nullable(); 
            $table->string('surbub')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('countr')->nullable(); 
            $table->boolean('multiple_addresses')->default(false); 
            // $table->foreignId('contactID')->constrained('contacts', 'contactID')->onDelete('cascade');
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
        Schema::dropIfExists('suppliers');
    }
};
