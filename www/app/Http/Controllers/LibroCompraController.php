<?php

namespace App\Http\Controllers;

use App\LibroCompra;
use App\Cliente;
use App\Cliente_Usuario;
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
   public function index()
   {
      try {
         $compras = DB::table('libro_compras as lc')
            ->join('clientes as c', 'lc.sender_id', '=', 'c.id')
            ->select('c.*', 'lc.*')
            ->orderBy('lc.id', 'DESC')
            ->get();

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

   public function clientExists($id)
   {
      $flag = false;
      if (Cliente::find($id)) {
         $flag = true;
      }
      return $flag;
   }

   public function store(Request $request)
   {
      try {
         $compra = new LibroCompra();

         if ($this->clientExists($request->client_id)) { //Si existe en la bd, solamente guardo el ID
            $compra->sender_id = $request->client_id;
         } else { //Si no existe creo el cliente nuevo desde el controller de compras
            $cliente = new Cliente();
            $cliente->name = $request->name;
            $cliente->cuit = $request->cuit;
            $cliente->condition = $request->condition;
            $cliente->save();
            //Agrego la relacion ClienteUsuario
            $cu = new Cliente_Usuario();
            $cu->cliente_id = $cliente->id;
            $cu->user_id = Auth::user()->id;
            $cu->save();
            
            $compra->sender_id = $cliente->id;

         }
         $compra->fecha = $request->fecha;
         $compra->pto_venta = $request->pto_venta;
         $compra->codigo_comprobante = $request->codigo_comprobante;
         $compra->tipo_comprobante  = $request->tipo_comprobante;
         $compra->receiver_id = Auth::user()->id;
         $compra->neto = $request->neto;
         $compra->iva = $request->iva;
         $compra->iva_liquidado = $request->iva_liquidado;
         $compra->iva_sobretasa = $request->iva_sobretasa;
         $compra->percepcion = $request->percepcion;
         $compra->iva_retencion = $request->iva_retencion;
         $compra->impuestos_internos = $request->impuestos_internos;
         $compra->conceptos_no_gravados = $request->conceptos_no_gravados;
         $compra->compras_no_inscriptas = $request->compras_no_inscriptas;
         $compra->total = $request->total;
         $compra->tipo_op = $request->tipo_op;
         $compra->tipo_calculo = $request->tipo_calculo;

         
         $compra->save();
         //$compra = LibroCompra::create($request->all() + ['sender_id' => $c->id] + ['receiver_id' => '1']);

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
         $cliente = Cliente::find($compra->sender_id);

         if ($compra) {
            return view('compras.edit', compact('compra','cliente'));
         }
      } catch (Exception $e) {
         return redirect()->back()->withErrors($e->getMessage());
      }
   }

   public function update(Request $request, LibroCompra $libroCompra)
   {
      try {
         // dd($request->all());
         $compra = LibroCompra::find($request->id);
         if ($compra) {
            // dd($compra->sender_id);
            $compra->sender_id = $request->client_id;
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
