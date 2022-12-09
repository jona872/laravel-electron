<?php

namespace App\Http\Controllers;

use App\LibroVenta;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        //
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
}
