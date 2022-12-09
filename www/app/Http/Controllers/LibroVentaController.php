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

            // $clientes = DB::table('libro_ventas')
            //     ->select('libro_ventas.*')
            //     ->join('cliente_usuario', 'clientes.id', '=', 'cliente_usuario.cliente_id')
            //     ->where('cliente_usuario.user_id', Auth::user()->id)
            //     ->get();

            return view('ventas.index', compact('ventas'));
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //floatval()
    {
        dd(floatval($request->tipo_op));
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LibroVenta  $libroVenta
     * @return \Illuminate\Http\Response
     */
    public function show(LibroVenta $libroVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LibroVenta  $libroVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroVenta $libroVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LibroVenta  $libroVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroVenta $libroVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LibroVenta  $libroVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroVenta $libroVenta)
    {
        //
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
