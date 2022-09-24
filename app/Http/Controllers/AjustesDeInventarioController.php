<?php

namespace App\Http\Controllers;

use App\Models\AjustesDeInventario;
use App\Models\Articulo;
use App\Models\Tipo_movimiento;
use App\Models\DetalleAjustesDeInventario;
use App\Models\DetalleMovimientosArticulos;
use Illuminate\Http\Request;

class AjustesDeInventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('ajuste')) {
            session()->forget('ajuste');
        }
        $ajustesDeInventario = AjustesDeInventario::all();
        return view('ajustesdeinventario.index', compact('ajustesDeInventario'));
    }

    public function addArticulo(Request $request)

    {
        if ($request->salidas == 0 && $request->entradas == 0) {
            return redirect()->route('ajustesdeinventario.create')->with([
                'error' => 'Error',
                'mensaje' => 'Las entradas y salidas no pueden ser iguales',
                'tipo' => 'alert-danger'
            ]);
        } else {
            $ajuste_new = [];
            $ajuste_flag = false;
            if (session('ajuste')) {

                foreach (session('ajuste') as $value) {
                    if ($value['articulo_id'] == $request->articulo) {
                        $ajuste_tmp = new DetalleAjustesDeInventario();

                        $ajuste_tmp->articulo = Articulo::find($request->articulo);
                        $ajuste_tmp->articulo_id = $request->articulo;
                        $ajuste_tmp->salidas = $request->salidas;
                        $ajuste_tmp->entradas = $request->entradas;
                        $ajuste_tmp->costo_neto = $request->costo_neto;
                        $ajuste_tmp->costo_imp = $request->costo_imp;
                        array_push($ajuste_new, $ajuste_tmp);
                        $ajuste_flag = true;
                    } else {
                        $ajuste_tmp = new DetalleAjustesDeInventario();
                        $ajuste_tmp->articulo = Articulo::find($value->articulo_id);
                        $ajuste_tmp->articulo_id = $value->articulo_id;
                        $ajuste_tmp->salidas = $value->salidas;
                        $ajuste_tmp->entradas = $value->entradas;
                        $ajuste_tmp->costo_neto = $value->costo_neto;
                        $ajuste_tmp->costo_imp = $value->costo_imp;
                        array_push($ajuste_new, $ajuste_tmp);
                    }
                }
                if ($ajuste_flag == false) {
                    $ajuste_tmp = new DetalleAjustesDeInventario();

                    $ajuste_tmp->articulo = Articulo::find($request->articulo);
                    $ajuste_tmp->articulo_id = $request->articulo;
                    $ajuste_tmp->salidas = $request->salidas;
                    $ajuste_tmp->entradas = $request->entradas;
                    $ajuste_tmp->costo_neto = $request->costo_neto;
                    $ajuste_tmp->costo_imp = $request->costo_imp;
                    array_push($ajuste_new, $ajuste_tmp);
                }
                session(['ajuste' => $ajuste_new]);
            } else {
                $ajuste_tmp = new DetalleAjustesDeInventario();

                $ajuste_tmp->articulo = Articulo::find($request->articulo);
                $ajuste_tmp->articulo_id = $request->articulo;
                $ajuste_tmp->salidas = $request->salidas;
                $ajuste_tmp->entradas = $request->entradas;
                $ajuste_tmp->costo_neto = $request->costo_neto;
                $ajuste_tmp->costo_imp = $request->costo_imp;
                array_push($ajuste_new, $ajuste_tmp);
                session(['ajuste' => $ajuste_new]);
            }

            return redirect()->route('ajustesdeinventario.create')->with([
                'error' => 'Exito',
                'mensaje' => 'Se agrego el articulo al ajuste',
                'tipo' => 'alert-success'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::all();
        $tipo_movimientos = Tipo_movimiento::all();
        return view('ajustesdeinventario.create', compact(['articulos', 'tipo_movimientos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ajuste = new AjustesDeInventario();
        $ajuste->costo_neto = $request->monto_neto;
        $ajuste->costo_imp = $request->monto_imp;
        $ajuste->entradas = $request->total_entradas;
        $ajuste->salidas = $request->total_salidas;
        $ajuste->observaciones = $request->observaciones;
        $ajuste->tipo_movimiento_id = $request->tipo_movimiento;
        $ajuste->user_id = auth()->user()->id;
        $ajuste->save();
        $detalle = session('ajuste');
        foreach ($detalle as $value) {
            $ajuste_detalle = new DetalleAjustesDeInventario();
            $ajuste_detalle->ajuste_de_inventario_id = $ajuste->id;
            $ajuste_detalle->articulo_id = $value->articulo_id;
            $ajuste_detalle->salidas = $value->salidas;
            $ajuste_detalle->entradas = $value->entradas;
            $ajuste_detalle->costo_neto = $value->costo_neto;
            $ajuste_detalle->costo_imp = $value->costo_imp;
            $ajuste_detalle->save();

            $articulo = Articulo::find($value->articulo_id);
            if ($value->entradas > 0) {
                $articulo->stock = $articulo->stock + $value->entradas;
            } else {
                $articulo->stock = $articulo->stock - $value->salidas;
            }
            $articulo->save();

            $movimiento = new DetalleMovimientosArticulos();
            $movimiento->producto_id = $value->articulo_id;
            $movimiento->id_movimiento = $ajuste->id;
            $movimiento->movimiento_id = $ajuste->tipo_movimiento_id;
            if ($value->entradas > 0) {
                $movimiento->cantidad = $value->entradas;
            } else {
                $movimiento->cantidad = $value->salidas * -1;
            }
            $movimiento->usuario_id = auth()->user()->id;
            $movimiento->save();
        }
        session()->forget('ajuste');
        return redirect()->route('ajustesdeinventario.index')->with([
            'error' => 'Exito',
            'mensaje' => 'Se agrego el ajuste de inventario',
            'tipo' => 'alert-success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AjustesDeInventario  $ajustesDeInventario
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $ajuste = AjustesDeInventario::find($id);
        if ($ajuste == null) {
            return redirect()->route('ajustesdeinventario.index')->with([
                'error' => 'Error',
                'mensaje' => 'No se encontro el ajuste de inventario',
                'tipo' => 'alert-danger'
            ]);
        }
        $detalle = DetalleAjustesDeInventario::where('ajuste_de_inventario_id', $id)->get();
        return view('ajustesdeinventario.view', compact(['ajuste', 'detalle']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AjustesDeInventario  $ajustesDeInventario
     * @return \Illuminate\Http\Response
     */
    public function edit(AjustesDeInventario $ajustesDeInventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AjustesDeInventario  $ajustesDeInventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AjustesDeInventario $ajustesDeInventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AjustesDeInventario  $ajustesDeInventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(AjustesDeInventario $ajustesDeInventario)
    {
        //
    }
}