<?php

namespace App\Http\Controllers;

use App\Models\mediosdepago;
use Illuminate\Http\Request;

class mediosdepagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medio = mediosdepago::all();
        return view('administracion.mediosdepago.index', compact('medio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.mediosdepago.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medio = new mediosdepago();

        $medio->medio_de_pago = ucfirst($request->medio_de_pago);

        try {

            $medio->save();
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Medio de pago creado con exito',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Error',
                'mensaje' => 'Medio de pago no pudo ser creado',
                'tipo' => 'alert-danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medio = mediosdepago::find($id);
        return view('administracion.mediosdepago.editar', compact('medio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function edit(mediosdepago $mediosdepago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mediosdepago $mediosdepago)
    {
        $mediosdepago = mediosdepago::find($request->id);
        $mediosdepago->medio_de_pago = ucfirst($request->medio_de_pago);

        try {
            $mediosdepago->save();
            return redirect()->route('configuracion.mediosdepago.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Medio de pago modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {
            $medio = $mediosdepago;
            return view('administracion.mediosdepago.editar', compact('medio'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mediosdepago  $mediosdepago
     * @return \Illuminate\Http\Response
     */
    public function destroy(mediosdepago $mediosdepago)
    {
        //
    }
}