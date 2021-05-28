<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('eye');
            $table->string('sph');
            $table->string('cyl');
            $table->string('axis');
            $table->string('add');
            $table->string('pd');
            $table->string('ph');
            $table->string('a');
            $table->string('b');
            $table->string('dbl');
            $table->string('ed');
            $table->enum('order_status',['received','missing'])->default('received');
            $table->unsignedInteger('prescription_id');
            $table->unsignedInteger('coating_1_id');
            $table->unsignedInteger('coating_2_id');
            $table->unsignedInteger('lens_type_id');
            $table->unsignedInteger('shippment_status')->default('0');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('date_id');

            $table->foreign('prescription_id')->references('id')->on('prescription_type') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('coating_1_id')->references('id')->on('coating') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('coating_2_id')->references('id')->on('coating') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('lens_type_id')->references('id')->on('lens_type') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('orders_head') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('date_id')->references('id')->on('orders_head') ->onUpdate('cascade')->onDelete('cascade');
            
            
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
        Schema::dropIfExists('orders');
    }
}
