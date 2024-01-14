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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('orderDetailID');
            $table->integer('quantity');
            $table->double('total_price')->nullable();
            $table->timestamps();
        });

        Schema::table('order_details', function (Blueprint $table) {

            $table->unsignedBigInteger('orderID');
         
            $table->foreign('orderID')->references('orderID')->on('order');

            $table->unsignedBigInteger('carID');

            $table->foreign('carID')->references('carID')->on('cars');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orde_details');
    }
};
