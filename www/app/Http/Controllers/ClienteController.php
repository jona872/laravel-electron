<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Cliente_Usuario;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        // if ( Auth::user() ) {
        //     $clientes = Cliente::all()->except(Auth::id());

        //     return view('clientes.index', compact('clientes'));
        // }
        // else {
        //     return redirect()->route('login')->withErrors('Solo docentes pueden acceder al panel!');
        // }
        try {
            $clientes = DB::table('clientes')->get();

            $clientes = DB::table('clientes')
                ->select('clientes.*')
                ->join('cliente_usuario', 'clientes.id', '=', 'cliente_usuario.cliente_id')
                ->where('cliente_usuario.user_id', Auth::user()->id)
                ->get();

            return view('clientes.index', compact('clientes'));
            // return response()->json([
            //     'value'  => $clientes,
            //     'status' => 'success',
            //     'message' => 'Clientes Listed Successfully !!'
            // ]);

        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function apiClients(){
        try {
            $clientes = Cliente::all();
            return response()->json($clientes->toArray());

        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        try {
            $cliente = Cliente::create($request->all());

            $cu = new Cliente_Usuario();
            $cu->cliente_id = $cliente->id;
            $cu->user_id = 1;
            $cu->save();

            // return response()->json([
            //     'value'  => [$cliente, $cu],
            //     'status' => 'success',
            //     'message' => 'Cliente created Successfully !!'
            // ]);
            return redirect()->route('clientes.index')->with('success', 'Cliente agregados correctamente!');
        } catch (Exception $e) {
            // return [
            //     'value'  => [],
            //     'status' => 'error',
            //     'message'   => $e->getMessage()

            // ];
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $cliente = Cliente::find($id);

            if ($cliente) {
                return view('clientes.edit', compact('cliente'));
            }
            // return redirect()->route('facturas.index')->with('success', 'Cliente editada correctamente!');
            // return response()->json([
            //     'value'  => $cliente,
            //     'status' => 'success',
            //     'message' => 'Cliente Updated Successfully !!'
            // ]);
        } catch (Exception $e) {
            // return [
            //     'value'  => [],
            //     'status' => 'error',
            //     'message'   => $e->getMessage()

            // ];
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(Request $request, Cliente $cliente)
    {
        try {
            $cliente = Cliente::find($request->id);
            if ($cliente) {
                $cliente->update($request->all());
            }

            return redirect()->route('clientes.index')->with('success', 'Cliente editado correctamente!');
            // return response()->json([
            //     'value'  => $cliente,
            //     'status' => 'success',
            //     'message' => 'Cliente Updated Successfully !!'
            // ]);
        } catch (Exception $e) {
            // return [
            //     'value'  => [],
            //     'status' => 'error',
            //     'message'   => $e->getMessage()
            // ];
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = Cliente::find($id);
            //cascade
            $cu = Cliente_Usuario::where('cliente_id', '=', $cliente->id)->firstOrFail();

            $cu->delete();

            if ($cliente) {
                $cliente->delete();
            }
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
            // return response()->json([
            //     'value'  => [$cliente, $cu],
            //     'status' => 'success',
            //     'message' => 'Cliente Completely Deleted Successfully !!'
            // ]);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }
}
