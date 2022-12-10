<?php

namespace App\Http\Controllers;

use App\LibroVenta;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use League\Csv\Writer;
use League\Csv\Reader;

use SplTempFileObject;
use SplFileObject;
use SplFileInfo;

class LibroVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ventas = DB::table('libro_ventas')->get();

            return view('ventas.index', compact('ventas'));
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
        return view('ventas.create');
    }

    public function store(Request $request) //floatval()
    {        
        //dd($request->all() + ['sender_id' => '1'] + ['receiver_id' => '1']);
        // dd(floatval($request->tipo_op));
        try {
            // User::create($request->all() + ['index' => 'value']);
            $venta = LibroVenta::create($request->all() + ['sender_id' => '1'] + ['receiver_id' => '1']);
            return redirect()->route('ventas.index')->with('success', 'LibroVenta agregados correctamente!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show(LibroVenta $libroVenta)
    {
        //
    }

    public function edit($id)
    {
        try {
            $venta = LibroVenta::find($id);
            if ($venta) {
                return view('ventas.edit', compact('venta'));
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(Request $request, LibroVenta $libroVenta)
    {
        try {
            $venta = LibroVenta::find($request->id);
            if ($venta) {
                $venta->update($request->all());
            }

            return redirect()->route('ventas.index')->with('success', 'Venta editada correctamente!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $venta = LibroVenta::find($id);

            if ($venta) {
                $venta->delete();
            }
            return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function exportVentas()
    {
        $ventas = DB::table('libro_ventas')->get(); //me dev un array de obj, $v->value
     
        $csv = Writer::createFromFileObject(new SplTempFileObject());
     
        $csv->insertOne(['id','sender_id','receiver_id','fecha', 'pto_venta', 'codigo', 'tipo_comprobante','nombre' ,'cuit', 'condicion', 'neto', 'iva','iva_liquidado','iva_sobretasa', 'percepcion','iva_retencion','conceptos_no_gravados', 'ingresos_exentos','ganancias_retencion','total','tipo_op']);
        foreach ($ventas as $key => $f) {
            $csv->insertOne(get_object_vars($f));
        }
        //descarga
        $csv->output('ventas.csv');
    }
}
