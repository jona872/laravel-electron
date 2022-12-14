<?php

namespace App\Http\Controllers;

use App\LibroCompra;
use App\Cliente;
use Exception;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use League\Csv\Writer;
use League\Csv\Reader;

use SplTempFileObject;
use SplFileObject;
use SplFileInfo;

class LibroCompraController extends Controller
{
    public function index()
    {
        try {
            // $compras = DB::table('libro_compras')->get();
            
            $compras = DB::table('libro_compras as lc')
                ->join('clientes as c', 'lc.sender_id', '=', 'c.id')
                ->select('c.*', 'lc.*')
                ->get();
            // dd($relevamientos);

            return view('compras.index', compact('compras'));
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }




        return view('compras.index');
    }

    public function create()
    {
        return view('compras.create');
    }

    // public function addDinamicClient(Cliente $cliente) {
    //     if (is_null(Cliente::find($cliente->id))) {

    //     }

    // }

    public function store(Request $request)
    {
        $libroCompra = new LibroCompra();
        //  dd($cData->toArray());
        $c = Cliente::find(1);

        if (isset($request->client_id) && !is_null($request->client_id)) {
            /*
Si esta seteado y NO es nulo--> (Deberia estar en la bd, pero chequeo por las dudas)
            1) Chequeo si existe 
            2) Si verifico que SI existe solamente pongo los datos del model
            3) Si NO existe agrego todo el nuevo cliente
            */
            // SI hay $c es xq existe en la bd, solamente pongo los datos del model.
            if ($c) {
                echo "si";
            }
        } else { //client_id == null => agrego todo a la bd
            $c->name = $request->name;
            $c->cuit = $request->cuit;
            $c->condition = $request->condition;
            $c->save();
        }

        try {
            $compra = LibroCompra::create($request->all() + ['sender_id' => $c->id] + ['receiver_id' => '1']);
            return redirect()->route('compras.index')->with('success', 'LibroCompra agregados correctamente!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show(LibroCompra $libroCompra)
    {
        //
    }

    public function edit($id)
    {
        try {
            $compra = LibroCompra::find($id);
            if ($compra) {
                return view('com$compras.edit', compact('com$compra'));
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(Request $request, LibroCompra $libroCompra)
    {
        try {
            $compra = LibroCompra::find($request->id);
            if ($compra) {
                $compra->update($request->all());
            }

            return redirect()->route('compras.index')->with('success', 'Compra editada correctamente!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $compra = LibroCompra::find($id);

            if ($compra) {
                $compra->delete();
            }
            return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }
}
