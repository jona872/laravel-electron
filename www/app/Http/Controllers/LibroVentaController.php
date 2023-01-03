<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cliente_Usuario;
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
            // $ventas = DB::table('libro_ventas')->get();
            $ventas = DB::table('libro_ventas as lc')
            ->join('clientes as c', 'lc.sender_id', '=', 'c.id')
            ->select('c.*', 'lc.*')
            ->get();

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
    public function clientExists($id)
    {
       $flag = false;
       if (Cliente::find($id)) {
          $flag = true;
       }
       return $flag;
    }

    public function store(Request $request) //floatval()
    {
        try {
            $venta = new LibroVenta();
            if ($this->clientExists($request->client_id)) { //Si existe en la bd, solamente guardo el ID
                $venta->sender_id = $request->client_id;
            } else { //Si no existe creo el cliente nuevo desde el controller de compras
                $cliente = new Cliente();
                $cliente->name = $request->nombre;
                $cliente->cuit = $request->cuit;
                $cliente->condition = $request->condition;
                $cliente->save();

                //Agrego la relacion ClienteUsuario
                $cu = new Cliente_Usuario();
                $cu->cliente_id = $cliente->id;
                $cu->user_id = Auth::user()->id;
                $cu->save();

                $venta->sender_id = Auth::user()->id;
            }
            $venta->fecha = $request->fecha;
            $venta->pto_venta = $request->pto_venta;
            $venta->codigo_comprobante = $request->codigo_comprobante;
            $venta->tipo_comprobante  = $request->tipo_comprobante;
            $venta->receiver_id = $request->client_id;
            $venta->neto = $request->neto;
            $venta->iva = $request->iva;
            $venta->iva_liquidado = $request->iva_liquidado;
            $venta->iva_sobretasa = $request->iva_sobretasa;
            $venta->percepcion = $request->percepcion;
            $venta->iva_retencion = $request->iva_retencion;
            $venta->conceptos_no_gravados = $request->conceptos_no_gravados;
            $venta->ingresos_exentos = $request->ingresos_exentos;
            $venta->ganancias_retencion = $request->ganancias_retencion;
            $venta->total = $request->total;
            $venta->tipo_op = $request->tipo_op;
            $venta->tipo_calculo = $request->tipo_calculo;
            $venta->save();
            //$compra = LibroCompra::create($request->all() + ['sender_id' => $c->id] + ['receiver_id' => '1']);

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

        $csv->insertOne([
            'id', 'sender_id', 'receiver_id', 'fecha', 'pto_venta', 'codigo', 'tipo_comprobante', 'nombre', 'cuit', 'condicion', 'neto', 'iva', 'iva_liquidado', 'iva_sobretasa', 'percepcion', 'iva_retencion', 'conceptos_no_gravados', 'ingresos_exentos', 'ganancias_retencion', 'total', 'tipo_op', 'tipo_calculo'
            ]);
        foreach ($ventas as $key => $f) {
            $csv->insertOne(get_object_vars($f));
        }
        //descarga
        $csv->output('ventas.csv');
    }
}
