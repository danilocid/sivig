<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\DetalleVentas;
use App\Models\Articulo;
use App\Models\tipo_documento;
use App\Models\mediosdepago;
use App\Models\Cliente;
use App\Models\DetalleMovimientosArticulos;

use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('venta')) {
            session()->forget('venta');
        }
        $ventas = Ventas::all();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $tipo_documento = tipo_documento::all();
        $articulos = Articulo::all()->where('stock', '>', 0)->where('activo', '=', 1);
        $medios_pago = mediosdepago::all();
        return view('ventas.create', compact(['clientes', 'articulos', 'tipo_documento', 'medios_pago']));
    }
    public function addArticulo(Request $request)
    {
        $venta_new = [];
        $venta_flag = false;
        if (session('venta')) {
            $venta = session('venta');

            foreach (session('venta') as $value) {
                if ($value['articulo_id'] == $request->articulo) {
                    $venta_tmp = new DetalleVentas();

                    $venta_tmp->articulo = Articulo::find($request->articulo);
                    $venta_tmp->articulo_id = $request->articulo;
                    $venta_tmp->cantidad = $request->unidades + $value['cantidad'];
                    $venta_tmp->precio_unitario = $request->venta_neto;
                    $venta_tmp->impuesto_unitario = $request->venta_imp;
                    $venta_tmp->ganancia = $request->ganancia;
                    $venta_tmp->total = $request->venta_total * $request->unidades;
                    array_push($venta_new, $venta_tmp);
                    $venta_flag = true;
                } else {
                    $venta_tmp = new DetalleVentas();

                    $venta_tmp->articulo = Articulo::find($value->articulo_id);
                    $venta_tmp->articulo_id = $value->articulo_id;
                    $venta_tmp->cantidad = $value['cantidad'];
                    $venta_tmp->precio_unitario = $value['precio_unitario'];
                    $venta_tmp->impuesto_unitario = $value['impuesto_unitario'];
                    $venta_tmp->ganancia = $value['ganancia'];
                    $venta_tmp->total = $value['total'];
                    array_push($venta_new, $venta_tmp);
                }
            }
            if ($venta_flag == false) {
                $venta_tmp = new DetalleVentas();

                $venta_tmp->articulo = Articulo::find($request->articulo);
                $venta_tmp->articulo_id = $request->articulo;
                $venta_tmp->cantidad = $request->unidades;
                $venta_tmp->precio_unitario = $request->venta_neto;
                $venta_tmp->impuesto_unitario = $request->venta_imp;
                $venta_tmp->ganancia = $request->ganancia;
                $venta_tmp->total = $request->costo_total * $request->unidades;
                array_push($venta_new, $venta_tmp);
            }
            session(['venta' => $venta_new]);
        } else {
            $venta = new DetalleVentas();
            $venta->articulo = Articulo::find($request->articulo);
            $venta->articulo_id = $request->articulo;
            $venta->cantidad = $request->unidades;
            $venta->precio_unitario = $request->venta_neto;
            $venta->impuesto_unitario = $request->venta_imp;
            $venta->ganancia = $request->ganancia;
            $venta->total = $request->costo_total * $request->unidades;
            array_push($venta_new, $venta);
            session(['venta' => $venta_new]);
        }
        $clientes = Cliente::all();
        $articulos = Articulo::all()->where('stock', '>', 0)->where('activo', '=', 1);
        $tipo_documento = tipo_documento::all();
        $medios_pago = mediosdepago::all();
        return view('ventas.create', compact(['clientes', 'articulos', 'tipo_documento', 'medios_pago']));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $venta = Ventas::firstWhere([['documento', '=', $request->numero_documento], ['tipo_documentos_id', '=', $request->tipo_documento]]);
        if ($venta) {
            return redirect()->route('ventas.create')->with([
                'error' => 'Error',
                'mensaje' => 'el numero de documento ya existe',
                'tipo' => 'alert-danger'
            ]);
        } else {
            $venta = new Ventas();

            $venta->cliente_id = $request->cliente;
            $venta->tipo_documentos_id = $request->tipo_documento;
            $venta->documento = $request->numero_documento;
            $venta->monto_neto = $request->monto_neto;
            $venta->monto_imp = $request->monto_imp;
            $venta->costo_neto = $request->costo_neto;
            $venta->costo_imp = $request->costo_imp;
            $venta->medio_pago_id = $request->medio_de_pago;
            $venta->unidades = $request->total_articulos;
            $venta->user_id = Auth::user()->id;

            $venta->save();
            $venta_id = $venta->id;
            $venta_detalle = session('venta');
            foreach ($venta_detalle as $value) {
                $detalle = new DetalleVentas();
                $detalle->venta_id = $venta_id;
                $detalle->producto_id = $value->articulo_id;
                $detalle->cantidad = $value->cantidad;
                $detalle->precio_neto = $value->precio_unitario;
                $detalle->precio_imp = $value->impuesto_unitario;
                $detalle->costo_neto = $value->articulo->costo_neto;
                $detalle->costo_imp = $value->articulo->costo_imp;
                $detalle->save();

                $detalleMovimiento = new DetalleMovimientosArticulos();
                $detalleMovimiento->movimiento_id = 2; // 2 = ventas
                $detalleMovimiento->id_movimiento = $venta_id;
                $detalleMovimiento->producto_id = $value->articulo_id;
                $detalleMovimiento->cantidad = $value->cantidad;
                $detalleMovimiento->usuario_id = Auth::user()->id;
                $detalleMovimiento->save();

                $articulo = Articulo::find($value->articulo_id);
                $articulo->stock = $articulo->stock - $value->cantidad;
                $articulo->costo_neto = $value->precio_unitario;
                $articulo->costo_imp = $value->impuesto_unitario;
                $articulo->save();

                $tipo_documento = tipo_documento::find($request->tipo_documento);
                $tipo_documento->ultima_emision = $request->numero_documento;
                $tipo_documento->save();
            }
            return redirect()->route('ventas.index')->with([
                'error' => 'Venta agregada',
                'mensaje' => 'Venta registrada correctamente',
                'tipo' => 'alert-success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalleVentas = DetalleVentas::where('venta_id', $id)->get();
        $venta = Ventas::find($id);
        return view('ventas.view', compact(['detalleVentas', 'venta']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ventas $ventas)
    {
        //
    }
}