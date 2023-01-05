<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'name' => "NEWTON STATION S.R.L.",
            'cuit' => "30-71198096-9",
            'condition' => "Resp. Inscripto",
            'direction' => "PARANA 552 Piso:8 Dpto:84",
            'activity_start' => "01-08-2011",
            'gross_receipts_tax' => "9015774730",
        ]);
        $id = DB::table('clientes')->count();

        DB::table('cliente_usuario')->insert([
            'cliente_id' => $id, 
            'user_id' => 1,
        ]);
    }
}
