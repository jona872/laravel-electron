<?php

namespace App\Http\Controllers;

use App\LibroCompra;
use Illuminate\Http\Request;

class LibroCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Compra.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\LibroCompra  $libroCompra
     * @return \Illuminate\Http\Response
     */
    public function show(LibroCompra $libroCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LibroCompra  $libroCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(LibroCompra $libroCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LibroCompra  $libroCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LibroCompra $libroCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LibroCompra  $libroCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(LibroCompra $libroCompra)
    {
        //
    }
}
