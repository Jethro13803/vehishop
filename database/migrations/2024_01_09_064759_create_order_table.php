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
        Schema::create('order', function (Blueprint $table) {
            $table->id('orderID');
            $table->string('status');
            $table->integer('quantity');
            $table->string('payment_method');
            $table->timestamps();
        });

        Schema::table('order', function (Blueprint $table) {
            $table->unsignedBigInteger('customerID');

            $table->foreign('customerID')->references('customerID')->on('users');

            $table->unsignedBigInteger('carID');
         
            $table->foreign('carID')->references('carID')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
