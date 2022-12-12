<?php

namespace App\Http\Controllers;

use App\LibroCompra;
use App\Cliente;
use Exception;
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

    public function autocompleteSearch(Request $request)
    {
        dd($request->all());
        $query = $request->get('query');
        $filterResult = Cliente::where('name', 'LIKE', '%' . $query . '%')->get();

        return response()->json($filterResult);
    }

    public function autocompleteSearch2(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Cliente::where('name', 'LIKE', '%' . $query . '%')->get();
        
        return response()->json($filterResult);
    }



    public function index()
    {
        try {
            $compras = DB::table('libro_compras')->get();

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

    public function store(Request $request)
    {
        dd($request->all());
        try {
            $compra = LibroCompra::create($request->all() + ['sender_id' => '1'] + ['receiver_id' => '1']);
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
