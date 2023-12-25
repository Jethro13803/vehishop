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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id('ID');
            $table->integer('quantity');
            $table->timestamp('arrival_date');
            $table->timestamps();
        });

        Schema::table('inventory', function (Blueprint $table) {
            $table->unsignedBigInteger('carID');

            $table->foreign('carID')->references('carID')->on('cars');

            $table->unsignedBigInteger('branchID');
         
            $table->foreign('branchID')->references('branchID')->on('branch');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
