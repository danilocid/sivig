<?php

namespace App\Http\Controllers;

use App\Models\DetalleVentas;
use Illuminate\Http\Request;

class DetalleVentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\DetalleVentas  $detalleVentas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleVentas = DetalleVentas::where('venta_id', $id)->get();
        return $detalleVentas[0]->Producto;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleVentas  $detalleVentas
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleVentas $detalleVentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleVentas  $detalleVentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleVentas $detalleVentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleVentas  $detalleVentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleVentas $detalleVentas)
    {
        //
    }
}