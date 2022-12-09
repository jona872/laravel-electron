<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LibroVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('libro_ventas')->insert([
            'sender_id' => 1,
            'receiver_id' => 1,
            'fecha' => Carbon::create('2000', '01', '01'),
            'pto_venta' => Str::random(10),
            'codigo' => Str::random(10),
            'tipo_comprobante' => Str::random(10),
            'nombre'  => Str::random(10),
            'cuit' => Str::random(10),
            'condicion' => Str::random(10),
            'neto' => 10.5,
            'iva' => 10.5,
            'iva_liquidado' => 10.5,
            'iva_sobretasa' => 10.5,
            'percepcion' => 10.5,
            'iva_retencion' => 10.5,
            'conceptos_no_gravados' => 10.5,
            'ingresos_exentos' => 10.5,
            'ganancias_retencion' => 10.5,
            'total' => 10.5,
            'tipo_op' => 10.5,

        ]);
    }
}
