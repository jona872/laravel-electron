<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use SplTempFileObject;
use PhpParser\Node\Expr\FuncCall;
use SplFileObject;

class ResumenesController extends Controller
{

    public function index()
    {
        return view('resumenes.index');
    }

    public function indexMensual()
    {
        return view('resumenes.mensuales.index');
    }
    public function mensualesPreview(Request $request)
    {
        $operatoria = $request->operatoria;
        //Ventas no tiene el autocompletar aun,
        if ($operatoria == "compras") {
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '=', $request->mes)
                ->get();

            return view('resumenes.mensuales.listadoCompras', compact('consulta', 'operatoria'));
        } else {
            $consulta = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '=', $request->mes)
                ->get();

            return view('resumenes.mensuales.listadoVentas', compact('consulta', 'operatoria'));
        }
    }

    public function mensualesExport(Request $request)
    {
        if ($request->exportData) {
            $tmp = [];
            $data = unserialize(base64_decode($request->exportData));
            foreach ($data as $key => $f) {
                array_push($tmp,get_object_vars($f));
            }

            // dd($tmp);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(['id', 'sender_id', 'receiver_id', 'fecha', 'pto_venta', 'codigo', 'tipo_comprobante', 'nombre', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op']);
            foreach ($tmp as $key => $array) {
                dd($tmp, $key,$array);
                //$csv->insertOne(get_object_vars($f));
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('Compras.csv');
        } else {
            $data = [];
            $csv = Writer::createFromFileObject(new SplTempFileObject());
            $csv->insertOne(['id', 'sender_id', 'receiver_id', 'fecha', 'pto_venta', 'codigo', 'tipo_comprobante', 'nombre', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op']);
            foreach ($data as $key => $f) {
                $csv->insertOne($f);
            }

            //descarga
            $csv->output('Compras.csv');
        }


        dd($data, $request->operatoria);
    }


    public function indexAnual()
    {
        return view('resumenes.anuales.index');
    }

    public function anualesPreview(Request $request){
        // dd($request->all());
        $operatoria = $request->operatoria;
        $year = $request->year;
        
        if ($request->operatoria && $request->operatoria == "compras") {
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('libro_compras.fecha', '=', $request->year)
                ->get();
            // dd($comprasAnuales);

            return view('resumenes.anuales.listadoCompras', compact('consulta', 'operatoria','year'));
        }else {
            dd('ventas');
        }
    }
    public function anualesExport(Request $request){
        dd($request->all());
    }

    
    public function indexPeriodo()
    {
        return view('resumenes.periodo');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
