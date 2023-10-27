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
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements("promotionID")->unique();
            $table->string('promotion_name')->nullable();
            $table->string('description')->nullable();
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->boolean('status')->default(false);
            $table->decimal('minimum_spend')->default(0);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('promotions');
    }
};
