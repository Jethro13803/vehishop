<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id('carID');
            $table->string('manufacturer');
            $table->string('model');
            $table->double('price');
            $table->string('vin', 17);
            $table->string('description');
            $table->string('imageURL');
            $table->timestamps();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id');
         
            $table->foreign('branch_id')->references('branchID')->on('branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
