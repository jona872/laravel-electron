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
            'name' => Str::random(10),
            'cuit' => Str::random(10),
            'condition' => Str::random(10),
            'direction' => Str::random(10),
            'activity_start' => Str::random(10),
            'gross_receipts_tax' => Str::random(10),
        ]);
        $id = DB::table('clientes')->count();

        DB::table('cliente_usuario')->insert([
            'cliente_id' => $id, 
            'user_id' => 1,
        ]);
    }
}
