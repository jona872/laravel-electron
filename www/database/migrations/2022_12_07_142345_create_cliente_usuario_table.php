<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('cliente_id')->unsigned()->index()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::table('cliente_usuario', function($table){
            $table->foreign()->references("id")->on("clientes")->onDelete("cascade");
            $table->foreign()->references("id")->on("users")->onDelete("cascade");
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_usuario');
    }
}
