<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Proveedor;
use App\Models\tipo_documento;
use Illuminate\Http\Request;
use App\Models\DetalleMovimientosArticulos;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all();
        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articulo = new Articulo();
        $articulo->cod_interno = $request->cod_interno;
        $articulo->cod_barras = $request->cod_barras;
        $articulo->descripcion = $request->descripcion;
        $articulo->costo_neto = 0;
        $articulo->costo_imp = 0;
        $articulo->stock = 0;
        $articulo->venta_neto = $request->venta_neto;
        $articulo->venta_imp = $request->venta_imp;
        $articulo->stock_critico = $request->stock_critico;
        $articulo->activo = $request->activo;

        try {
            $articulo->save();
            if (session('recepcion')) {
                $proveedores = Proveedor::all();
                $articulos = Articulo::all();
                $tipo_documento = tipo_documento::all();

                return view('recepciones.create', compact(['proveedores', 'articulos', 'tipo_documento']))->with([
                    'error' => 'Exito',
                    'mensaje' => 'Articulo creado con exito',
                    'tipo' => 'alert-success'
                ]);
            }
            return redirect()->route('articulos.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Articulo creado con exito',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('articulos.create')->with([
                    'error' => 'Error',
                    'mensaje' => 'El articulo ya existe',
                    'tipo' => 'alert-danger'
                ]);
            }
            return redirect()->route('articulos.create')->with([
                'error' => 'Error',
                'mensaje' => 'Articulo no pudo ser creado' . $e->getMessage(),
                'tipo' => 'alert-danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show($articulo)
    {
        $articulo = Articulo::find($articulo);
        return view('articulos.editar', compact('articulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        $articulo->cod_interno = $request->cod_interno;
        $articulo->cod_barras = $request->cod_barras;
        $articulo->descripcion = $request->descripcion;
        $articulo->costo_neto = $request->costo_neto;
        $articulo->costo_imp = $request->costo_imp;
        $articulo->venta_neto = $request->venta_neto;
        $articulo->venta_imp = $request->venta_imp;
        $articulo->stock_critico = $request->stock_critico;
        $articulo->activo = $request->activo;

        try {
            $articulo->save();
            return redirect()->route('articulos.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Articulo modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {

            return view('articulos.editar', compact('articulo'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //
    }

    public function getHistorialArticulo($id)
    {
        $articulo = Articulo::find($id);
        $historial = DetalleMovimientosArticulos::where('producto_id', $id)->get();
        return view('articulos.historial', compact(['articulo', 'historial']));
        //return ['articulo' => $articulo, 'historial' => $historial];
    }
}
