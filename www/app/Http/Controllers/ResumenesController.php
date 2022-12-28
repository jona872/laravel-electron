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
                array_push($tmp, get_object_vars($f));
            }

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(['id', 'sender_id', 'receiver_id', 'fecha', 'pto_venta', 'codigo', 'tipo_comprobante', 'nombre', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op']);
            foreach ($tmp as $key => $array) {
                dd($tmp, $key, $array);
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

    public function anualesPreview(Request $request)
    {
        // dd($request->all());
        $operatoria = $request->operatoria;
        $year = $request->year;

        if ($request->operatoria && $request->operatoria == "compras") {
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('libro_compras.fecha', '=', $request->year)
                ->get();

            return view('resumenes.anuales.listadoCompras', compact('consulta', 'operatoria', 'year'));
        } else {
            $consulta = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('libro_ventas.fecha', '=', $request->year)
                ->get();

            return view('resumenes.anuales.listadoVentas', compact('consulta', 'operatoria', 'year'));
        }
    }

    public function anualesExport(Request $request)
    {
        // dd($request->operatoria, $request->year);
        // $data = DB::table("libro_" . $request->operatoria)->get();
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('libro_compras.fecha', '=', $request->year)
                ->select(
                    'libro_compras.fecha',
                    'libro_compras.pto_venta',
                    'libro_compras.codigo_comprobante',
                    'libro_compras.tipo_comprobante',
                    'clientes.name',
                    'clientes.cuit',
                    'clientes.condition',
                    'libro_compras.neto',
                    'libro_compras.iva',
                    'libro_compras.iva_liquidado',
                    'libro_compras.iva_sobretasa',
                    'libro_compras.percepcion',
                    'libro_compras.iva_retencion',
                    'libro_compras.impuestos_internos',
                    'libro_compras.conceptos_no_gravados',
                    'libro_compras.compras_no_inscriptas',
                    'libro_compras.total',
                    'libro_compras.tipo_op'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([
                'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante',
                'nombre', 'cuit', 'Resp. I.V.A.',
                'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion',
                'impuestos_internos', 'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op'
            ]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenAnualCompras.csv');
        } else {
            $data = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('libro_ventas.fecha', '=', $request->year)
                ->select(
                    'libro_ventas.fecha',
                    'libro_ventas.pto_venta',
                    'libro_ventas.codigo_comprobante',
                    'libro_ventas.tipo_comprobante',
                    'clientes.name',
                    'clientes.cuit',
                    'clientes.condition',
                    'libro_ventas.neto',
                    'libro_ventas.iva',
                    'libro_ventas.iva_liquidado',
                    'libro_ventas.iva_sobretasa',
                    'libro_ventas.percepcion',
                    'libro_ventas.iva_retencion',
                    'libro_ventas.conceptos_no_gravados',
                    'libro_ventas.ingresos_exentos',
                    'libro_ventas.ganancias_retencion',
                    'libro_ventas.total',
                    'libro_ventas.tipo_op'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([
                'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante',
                'name', 'cuit', 'condicion',
                'neto', 'iva', 'iva_liquidado', 'iva_sobretasa',
                'percepcion', 'iva_retencion', 'conceptos_no_gravados',
                'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op'
            ]);

            foreach ($data as $key => $array) {
                //dd($array);
                $csv->insertOne(get_object_vars($array));
                // $csv->insertOne([
                //     $array->fecha,
                //     $array->pto_venta,
                //     $array->codigo_comprobante,
                //     $array->tipo_comprobante,
                //     $array->name,
                //     $array->cuit,
                //     $array->condition,
                //     $array->neto,
                //     $array->iva,
                //     $array->iva_liquidado,
                //     $array->iva_sobretasa,
                //     $array->percepcion,
                //     $array->iva_retencion,
                //     $array->conceptos_no_gravados,
                //     $array->ingresos_exentos,
                //     $array->ganancias_retencion,
                //     $array->total,
                //     $array->tipo_op
                // ]);
            }
            //descarga
            $csv->output('ResumenAnualVentas.csv');
        }
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
