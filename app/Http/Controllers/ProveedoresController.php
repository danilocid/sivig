<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regiones = Region::all();
        return view('proveedores.crear', compact('regiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->rut = $request->rut;
        $proveedor->nombre_fantasia = $request->nombre_fantasia;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->giro = $request->giro;
        $proveedor->direccion = $request->direccion;
        $proveedor->comuna_id =  $request->comuna;
        $proveedor->region_id = $request->region;
        $proveedor->mail = $request->email;
        $proveedor->telefono = $request->telefono;
        try {
            $proveedor->save();
            return redirect()->route('proveedores.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Proveedor creado con exito',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            $regiones = Region::all();
            $comunas = Comuna::whereRegion_id($proveedor->region['id'])->get();
            return view('proveedores.editar', compact(['proveedor','regiones','comunas']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($proveedor)
    {
        $proveedor = Proveedor::find($proveedor);
        $regiones = Region::all();
       $comunas = Comuna::whereRegion_id($proveedor->region['id'])->get();
        
        return view('proveedores.editar', compact(['proveedor','regiones','comunas']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->nombre_fantasia = $request->nombre_fantasia;
        $proveedor->razon_social = $request->razon_social;
        $proveedor->giro = $request->giro;
        $proveedor->direccion = $request->direccion;
        $proveedor->comuna_id =  $request->comuna;
        $proveedor->region_id = $request->region;
        $proveedor->mail = $request->email;
        $proveedor->telefono = $request->telefono;
        try {
            $proveedor->save();
            return redirect()->route('proveedores.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Proveedor modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {
            $regiones = Region::all();
            $comunas = Comuna::whereRegion_id($proveedor->region['id'])->get();
            return view('proveedores.editar', compact(['proveedor','regiones','comunas']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
