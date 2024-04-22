<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantOrderTable extends Migration
{

    public function up()
    {
        Schema::create('plant_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('plant_id')->constrained('plants')->onDelete('cascade');
            $table->integer('amount')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plant_order');
    }
}
