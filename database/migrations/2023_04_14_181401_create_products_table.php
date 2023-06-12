<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\supplier;
use App\Models\SubCategory;

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
            $table->bigIncrements('productID');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->decimal('cost_price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sale_name')->nullable();
            $table->text('description')->nullable();
            $table->text('product_detail')->nullable();
            $table->boolean('availability')->default(false);            //
            $table->boolean('publish')->default(false);                 //
            $table->boolean('physical_product')->default(true);
            $table->boolean('sale')->default(false);                    //
            $table->boolean('vat')->default(true);                      
            $table->string('weight')->nullable();
            $table->string('shipping_time_period')->nullable();
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();  
            $table->string('weight_unit')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable(); 
            $table->integer('rating')->nullable();
            $table->integer('review_count')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('sub_categoryID')->unsigned()->constrained('sub_categories', 'sub_categoryID')->onDelete('cascade');
            $table->foreignId('supplierID')->unsigned()->constrained('suppliers', 'supplierID')->onDelete('cascade');
            $table->foreignId('id')->unsigned()->constrained('users', 'id')->onDelete('cascade');
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
