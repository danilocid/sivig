<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $regiones = Region::all();
         return view('clientes.crear', compact('regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->rut = $request->rut;
        $cliente->nombre = $request->nombre;
        $cliente->giro = $request->giro;
        $cliente->direccion = $request->direccion;
        $cliente->comuna_id =  $request->comuna;
        $cliente->region_id = $request->region;
        $cliente->mail = $request->email;
        $cliente->telefono = $request->telefono;
        try {
            $cliente->save();
            return redirect()->route('clientes.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Cliente creado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {
            $regiones = Region::all();
            $comunas = Comuna::whereRegion_id($cliente->region['id'])->get();
            return view('clientes.editar', compact(['cliente','regiones','comunas']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente)
    {   
        $cliente = Cliente::find($cliente);
        $regiones = Region::all();
       $comunas = Comuna::whereRegion_id($cliente->region['id'])->get();
        
        return view('clientes.editar', compact(['cliente','regiones','comunas']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
      
        $cliente->nombre = $request->nombre;
        $cliente->giro = $request->giro;
        $cliente->direccion = $request->direccion;
        $cliente->comuna_id =  $request->comuna;
        $cliente->region_id = $request->region;
        $cliente->mail = $request->email;
        $cliente->telefono = $request->telefono;
        try {
            $cliente->save();
            return redirect()->route('clientes.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Cliente modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {
            $regiones = Region::all();
            $comunas = Comuna::whereRegion_id($cliente->region['id'])->get();
            return view('clientes.editar', compact(['cliente','regiones','comunas']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
