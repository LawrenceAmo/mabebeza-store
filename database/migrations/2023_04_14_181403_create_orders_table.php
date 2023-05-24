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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('orderID')->index();
            $table->string('name'); 
            $table->string('descript')->nullable(); 
            // $table->string('status');
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
            $table->string('company_name')->nullable(); 
            $table->string('email')->nullable();
            $table->string('email_alt')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_alt')->nullable();
            $table->decimal('shipping_amount')->nullable(); 
            $table->string('shipping_method')->nullable(); 
            $table->string('shipping_description')->nullable();             
            // $table->string('unit_number')->nullable(); 
            // $table->string('complex')->nullable();  
            // $table->string('street')->nullable(); 
            // $table->string('surbub')->nullable(); 
            // $table->string('city')->nullable(); 
            // $table->string('state')->nullable(); 
            // $table->string('country')->nullable(); 
            // $table->bigInteger('zip_code')->nullable(); 
            $table->text('comments')->nullable(); 
            $table->string('coupon_code')->nullable(); 
            $table->decimal('sub_total')->nullable(); 
            $table->decimal('discount_amount')->nullable(); 
            $table->decimal('tax_amount')->nullable(); 
            $table->decimal('total_amount'); 
            $table->decimal('total_amount_refunded')->default(0); 
            $table->integer('qty')->default(1); 
            $table->boolean('is_guest')->default(false); 
            $table->boolean('paid')->default(false); 
            $table->boolean('paid_all')->default(false); 
            $table->decimal('payment')->nullable(); 
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->foreignId('customerID')->constrained('customers', 'customerID')->onDelete('cascade');
            $table->foreignId('productID')->constrained('products', 'productID')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};



// Schema::create('payments', function (Blueprint $table) {
//     $table->bigIncrements('id');
//     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
//     $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
//     $table->string('payment_method');
//     $table->decimal('amount', 10, 2);
//     $table->timestamps();
// });
 
 
