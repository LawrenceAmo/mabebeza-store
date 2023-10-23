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
        Schema::create('cutie_of_the_years', function (Blueprint $table) {
            $table->bigIncrements("id")->unique();
            $table->string('parent_name');
            $table->string('parent_surname');
            $table->string('child_name');
            $table->string('child_surname');
            $table->string('reciept');
            $table->string('email')->nullable();
            $table->string('cell_number')->nullable();
            $table->string('store');
            $table->string('photo');
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
        Schema::dropIfExists('cutie_of_the_years');
    }
};
