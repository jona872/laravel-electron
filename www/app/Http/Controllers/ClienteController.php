<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Cliente_Usuario;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        if ( Auth::user() ) {
            $clientes = Cliente::all()->except(Auth::id());
            
            return view('clientes.index', compact('clientes'));
        }
        else {
            return redirect()->route('login')->withErrors('Solo docentes pueden acceder al panel!');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $cliente = Cliente::create($request->all());

            $cu = new Cliente_Usuario();
            $cu->cliente_id = $cliente->id;
            $cu->user_id = Auth::user()->id;
            $cu->save();

            return response()->json([
                'value'  => [$cliente,$cu],
                'status' => 'success',
                'message' => 'Cliente created Successfully !!'
            ]);
            //return redirect()->route('home')->with('success', 'Cliente agregados correctamente');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
