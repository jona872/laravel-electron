<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('type')->nullable();

            $table->bigInteger('sender_id')->unsigned()->index()->nullable();
            $table->foreign('sender_id')->references('id')->on('users');

            $table->bigInteger('receiver_id')->unsigned()->index()->nullable();
            $table->foreign('receiver_id')->references('id')->on('clientes');

            $table->float('iva')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
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
        Schema::dropIfExists('libro_ventas');
    }
}
