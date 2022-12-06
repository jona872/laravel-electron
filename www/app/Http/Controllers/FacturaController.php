<?php

namespace App\Http\Controllers;

use App\Factura;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use League\Csv\Writer;
use League\Csv\Reader;

use SplTempFileObject;
use SplFileObject;
use SplFileInfo;

class FacturaController extends Controller
{
    public function index()
    {
        try {
            $facturas = DB::table('facturas')->get();

            return view('facturas.index', compact('facturas'));
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function getFacturas()
    {
        try {
            $facturas = DB::table('facturas')->get();

            return response()->json([
                'value'  => $facturas,
                'status' => 'success',
                'message' => 'Facturas Listed Successfully !!'
            ]);
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
        //
    }

    public function store(Request $request)
    {

        try {
            $factura = Factura::create($request->all());

            return response()->json([
                'value'  => $factura,
                'status' => 'success',
                'message' => 'Factura Added Successfully !!'
            ]);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function show(Factura $factura)
    {
        try {
            $getFacturaData = Factura::find($factura->id);
            return response()->json([
                'value'  => $getFacturaData,
                'status' => 'success',
                'message' => 'Factura Retrieved Successfully !!'
            ]);
        } catch (\Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function edit(Factura $factura)
    {
        //
    }

    public function update(Request $request, Factura $factura)
    {
        try {
            $factura = Factura::find($request->id);
            if ($factura) {
                $factura->update($request->all());
            }
            // return redirect()->route('facturas.index')->with('success', 'Factura editada correctamente!');
            return response()->json([
                'value'  => $factura,
                'status' => 'success',
                'message' => 'Factura Added Successfully !!'
            ]);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function destroy($id)
    {
        try {
            $factura = Factura::find($id);
            if ($factura) {
                $factura->delete();
            }
            //return redirect()->route('facturas.index')->with('success', 'Factura eliminado correctamente');
            return response()->json([
                'value'  => $factura,
                'status' => 'success',
                'message' => 'Factura Added Successfully !!'
            ]);
        } catch (Exception $e) {
            return [
                'value'  => [],
                'status' => 'error',
                'message'   => $e->getMessage()

            ];
        }
    }

    public function printCsv()
    {
        // $tmp = new Factura();

        // $tmp->code = Str::random(10);
        // $tmp->save();

        // $facturas = DB::table('facturas')->get();

        // $csv = Writer::createFromFileObject(new SplTempFileObject());
        // $csv->insertOne(['codigo']);
        // foreach ($facturas as $key => $f) {
        //     $csv->insertOne([$f->code]);
        // }
        // //descarga
        // $csv->output('testing.csv');

        // return view('factu', compact('facturas'));
    }
}
