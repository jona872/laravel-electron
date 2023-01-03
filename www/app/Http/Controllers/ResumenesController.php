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
        $mes = $request->mes;
        $year = $request->year;
        //Ventas no tiene el autocompletar aun,
        if ($operatoria == "compras") {
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '=', $request->mes)
                ->get();

            return view('resumenes.mensuales.listadoCompras', compact('consulta', 'operatoria', 'year', 'mes'));
        } else {
            $consulta = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '=', $request->mes)
                ->get();

            return view('resumenes.mensuales.listadoVentas', compact('consulta', 'operatoria','year','mes'));
        }
    }

    public function mensualesExport(Request $request)
    {
        //operatoria, mes, year
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereMonth('libro_compras.fecha', '=', $request->mes)
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
                    'libro_compras.tipo_op',
                    'libro_compras.tipo_calculo'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([ 'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante', 'nombre', 'cuit', 'Resp. I.V.A.', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'impuestos_internos', 'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op','tipo_calculo']);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenMensualCompras' . $request->mes . '.csv');
        } else {
            // dd($request->all(),$request->mes,$request->year);
            $data = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereMonth('libro_ventas.fecha', '=', $request->mes)
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
                    'libro_ventas.tipo_op',
                    'libro_ventas.tipo_calculo'
                )
                ->get();
                
            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([ 'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante', 'name', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op','tipo_calculo' ]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenMensualVentas' . $request->mes . '.csv');
        }
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
                    'libro_compras.tipo_op',
                    'libro_compras.tipo_calculo'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([
                'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante',
                'nombre', 'cuit', 'Resp. I.V.A.',
                'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion',
                'impuestos_internos', 'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op','tipo_calculo'
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
                    'libro_ventas.tipo_op',
                    'libro_ventas.tipo_calculo'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([
                'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante',
                'name', 'cuit', 'condicion',
                'neto', 'iva', 'iva_liquidado', 'iva_sobretasa',
                'percepcion', 'iva_retencion', 'conceptos_no_gravados',
                'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op','tipo_calculo'
            ]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenAnualVentas.csv');
        }
    }


    public function indexPeriodo()
    {
        return view('resumenes.periodos.index');
    }
    public function periodosPreview(Request $request){
        $operatoria = $request->operatoria;
        $mes = $request->mes;
        $mes_final = $request->mes_final;
        $year = $request->year;
        //Ventas no tiene el autocompletar aun,
        if ($operatoria == "compras") {
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '>=', $request->mes)
                ->whereMonth('fecha', '<=', $request->mes_final)
                ->get();

            return view('resumenes.periodos.listadoCompras', compact('consulta', 'operatoria', 'year', 'mes' , 'mes_final'));
        } else {
            $consulta = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '>=', $request->mes)
                ->whereMonth('fecha', '<=', $request->mes_final)
                ->get();

            return view('resumenes.periodos.listadoVentas', compact('consulta', 'operatoria','year','mes' , 'mes_final'));
        }

    }
    public function periodosExport(Request $request){
        //operatoria, mes, year
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('libro_compras.fecha', '=', $request->year)
                ->whereMonth('libro_compras.fecha', '>=', $request->mes)
                ->whereMonth('libro_compras.fecha', '<=', $request->mes_final)
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
                    'libro_compras.tipo_op',
                    'libro_compras.tipo_calculo'
                )
                ->get();

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([ 'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante', 'nombre', 'cuit', 'Resp. I.V.A.', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'impuestos_internos', 'conceptos_no_gravados', 'compras_no_inscriptas', 'total', 'tipo_op','tipo_calculo']);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('Resumen-Periodos-Compras-'.$request->mes.'-'.$request->mes_final.'.csv');
        } else {
            // dd($request->all(),$request->mes,$request->year);
            $data = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('libro_ventas.fecha', '=', $request->year)
                ->whereMonth('libro_ventas.fecha', '>=', $request->mes)
                ->whereMonth('libro_ventas.fecha', '<=', $request->mes_final)
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
                    'libro_ventas.tipo_op',
                    'libro_ventas.tipo_calculo'
                )
                ->get();
                
            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([ 'fecha', 'pto_venta', 'codigo_comprobante', 'tipo_comprobante', 'name', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op','tipo_calculo' ]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('Resumen-Periodos-Ventas-'.$request->mes.'-'.$request->mes_final.'.csv');
        }

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
