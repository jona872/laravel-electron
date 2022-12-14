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

    // public function autocompleteSearch(Request $request)
    // {
    //     dd($request->all());
    //     $query = $request->get('query');
    //     $filterResult = Cliente::where('name', 'LIKE', '%' . $query . '%')->get();

    //     return response()->json($filterResult);
    // }

    public function index()
    {
        try {
            $compras = DB::table('libro_compras')->get();
            
            $relevamientos = DB::table('libro_compras as lc')
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


        // +"id": 2
        // +"name": "Angelica"
        // +"cuit": "cuit de la bd"
        // +"condition": "Responsable Inscripto"
        // +"direction": "Av. Almafuertes 4777"
        // +"activity_start": "12/2/2022"
        // +"gross_receipts_tax": "12123123"
        // +"created_at": null
        // +"updated_at": null
        // +"sender_id": 2
        // +"receiver_id": 1
        // +"fecha": "2022-12-13"
        // +"pto_venta": "001"
        // +"codigo": "00001"
        // +"tipo_comprobante": "Otros"
        // +"nombre": "nombre de la bd"
        // +"condicion": "condicion de la bd"
        // +"neto": null
        // +"iva": null
        // +"iva_liquidado": null
        // +"iva_sobretasa": null
        // +"percepcion": null
        // +"iva_retencion": null
        // +"impuestos_internos": null
        // +"conceptos_no_gravados": null
        // +"compras_no_inscriptas": null
        // +"total": null
        // +"tipo_op": null



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
