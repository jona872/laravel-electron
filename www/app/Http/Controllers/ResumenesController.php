<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use SplTempFileObject;
use PhpParser\Node\Expr\FuncCall;
use SplFileObject;

const HEADER_COMPRAS = [
    'Fecha', 'Punto de Venta', 'Nro. de Comprob.', 'Tipo de Comprob.', 'Nombre', 'C.U.I.T.', 'Resp. I.V.A.', 'Neto Gravado', 'Tasa de I.V.A.', 'I.V.A. Liquidado', 'Sobretasa I.V.A.', 'Percep. D.G.R.', 'Retenc. I.V.A.', 'Imp. Internos', 'Concep. No Gravados', 'Compras No Insc.', 'Total', 'Tipo Op.'
];

const HEADER_VENTAS = [
    'Fecha', 'Punto de Venta', 'Nro. de Comprob.', 'Tipo de Comprob.', 'Nombre', 'C.U.I.T.', 'Responsable ante el I.V.A.', 'Neto Gravado', 'Tasa de I.V.A.', 'I.V.A. Liquidado', 'Sobretasa I.V.A.', 'Percep. D.G.R.', 'Retenc. I.V.A.', 'Concep. No Gravados', 'Ingresos Exentos', 'Retenc. Gcias.', 'Total', 'Tipo Op.'
];

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

            return view('resumenes.mensuales.listadoVentas', compact('consulta', 'operatoria', 'year', 'mes'));
        }
    }

    public function mensualesExport(Request $request)
    {
        //operatoria, mes, year
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = $this->getComprasData($request->year, $request->mes);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([HEADER_COMPRAS]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenMensualCompras' . $request->mes . '.csv');
        } else {
            // dd($request->all(),$request->mes,$request->year);
            $data = $this->getVentasData($request->year, $request->mes);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne([HEADER_VENTAS]);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenMensualVentas' . $request->mes . '.csv');
        }
    }

    public function mensualesExportV2($operatoria, $year, $mes)
    {
        if ($operatoria && $operatoria == "compras") {
            
            $consulta = DB::table('libro_compras')
                ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $year)
                ->whereMonth('fecha', '=', $mes)
                ->get();
                $user = (object) Auth::user()->toArray(); 
            return view('resumenes.mensuales.exportCompras', compact('consulta', 'operatoria', 'year', 'mes','user'));
        } else {
            dd("Ventas");
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
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = $this->getComprasData($request->year);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(HEADER_COMPRAS);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('ResumenAnualCompras.csv');
        } else {
            $data = $this->getVentasData($request->year, $request->mes);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(HEADER_VENTAS);
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
    public function periodosPreview(Request $request)
    {
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

            return view('resumenes.periodos.listadoCompras', compact('consulta', 'operatoria', 'year', 'mes', 'mes_final'));
        } else {
            $consulta = DB::table('libro_ventas')
                ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
                ->whereYear('fecha', '=', $request->year)
                ->whereMonth('fecha', '>=', $request->mes)
                ->whereMonth('fecha', '<=', $request->mes_final)
                ->get();

            return view('resumenes.periodos.listadoVentas', compact('consulta', 'operatoria', 'year', 'mes', 'mes_final'));
        }
    }
    public function periodosExport(Request $request)
    {
        //operatoria, mes, year
        if ($request->operatoria && $request->operatoria == "compras") {

            $data = $this->getComprasData($request->year, $request->mes, $request->mes_final);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(HEADER_COMPRAS);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('Resumen-Periodos-Compras-' . $request->mes . '-' . $request->mes_final . '.csv');
        } else {

            $data = $this->getVentasData($request->year, $request->mes, $request->mes_final);

            $csv = Writer::createFromFileObject(new SplTempFileObject());

            $csv->insertOne(HEADER_VENTAS);

            foreach ($data as $key => $array) {
                $csv->insertOne(get_object_vars($array));
            }
            //descarga
            $csv->output('Resumen-Periodos-Ventas-' . $request->mes . '-' . $request->mes_final . '.csv');
        }
    }

    public function getComprasData($year, ?int $startMonth = null, ?int $endMonth = null)
    {
        if ($startMonth == null or empty($startMonth)) {
            $startMonth = 1;
            $endMonth = 12;
        } else {
            if ($endMonth == null or empty($endMonth)) $endMonth = $startMonth;
        }

        return DB::table('libro_compras')
            ->join('clientes', 'libro_compras.sender_id', '=', 'clientes.id')
            ->whereYear('libro_compras.fecha', '=', $year)
            ->whereMonth('libro_compras.fecha', '>=', $startMonth)
            ->whereMonth('libro_compras.fecha', '<=', $endMonth)
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
    }

    public function getVentasData($year, ?int $startMonth = null, ?int $endMonth = null)
    {
        if ($startMonth == null or empty($startMonth)) {
            $startMonth = 1;
            $endMonth = 12;
        } else {
            if ($endMonth == null or empty($endMonth)) $endMonth = $startMonth;
        }

        return DB::table('libro_ventas')
            ->join('clientes', 'libro_ventas.sender_id', '=', 'clientes.id')
            ->whereYear('libro_ventas.fecha', '=', $year)
            ->whereMonth('libro_ventas.fecha', '>=', $startMonth)
            ->whereMonth('libro_ventas.fecha', '<=', $endMonth)
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
