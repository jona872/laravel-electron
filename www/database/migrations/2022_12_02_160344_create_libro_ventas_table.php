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

            //Emite la factura  el usuario (vendedor)
            $table->bigInteger('sender_id')->unsigned()->index()->nullable();
            $table->foreign('sender_id')->references('id')->on('users');

            //recibe la factura  el cliente (comprador)
            $table->bigInteger('receiver_id')->unsigned()->index()->nullable();
            $table->foreign('receiver_id')->references('id')->on('clientes');
            
            $table->date('fecha')->nullable();
            $table->string('pto_venta')->nullable();
            $table->string('codigo_comprobante')->nullable();
            $table->string('tipo_comprobante')->nullable();
            
            //datos del vendedor ============================
            // $table->string('nombre')->nullable();
            // $table->string('cuit')->nullable();
            // $table->string('condicion')->nullable();
            //===============================================
            $table->float('neto')->nullable();
            $table->float('iva')->nullable();
            $table->float('iva_liquidado')->nullable();
            $table->float('iva_sobretasa')->nullable();
            $table->float('percepcion')->nullable();
            $table->float('iva_retencion')->nullable();
            $table->float('conceptos_no_gravados')->nullable();
            $table->float('ingresos_exentos')->nullable();
            $table->float('ganancias_retencion')->nullable();
            $table->float('total')->nullable();
            $table->integer('tipo_op')->nullable();
        
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
