<?php

namespace App\Http\Controllers;

use App\Models\DetalleRecepcion;
use App\Models\Recepciones;
use App\Models\Articulo;
use App\Models\Proveedor;
use App\Models\tipo_documento;
use App\Models\DetalleMovimientosArticulos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RecepcionesController extends Controller
{
    public function index()
    {
        if (session('recepcion')) {
            session()->forget('recepcion');
        }
        $recepciones = Recepciones::all();
        return view('recepciones.index', compact('recepciones'));
    }
    public function view($id)
    {
        $recepcion = Recepciones::find($id);
        if ($recepcion == null) {
            return redirect()->route('recepciones.index')->with([
                'error' => 'Error',
                'mensaje' => 'Recepcion no encontrada',
                'tipo' => 'alert-danger'
            ]);
        }
        $detalle = DetalleRecepcion::where('recepcion_id', $id)->get();
        //return [$recepcion, $detalle];
        // return $detalle;
        return view('recepciones.view', compact(['recepcion', 'detalle']));
    }
    public function create()
    {
        $proveedores = Proveedor::all();
        $articulos = Articulo::all();
        return view('recepciones.create', compact(['proveedores', 'articulos']));
    }
    public function addArticulo(Request $request)
    {
        $recepcion_new = [];
        $recepcion_flag = false;
        if (session('recepcion')) {
            $recepcion = session('recepcion');

            foreach (session('recepcion') as $value) {
                if ($value['articulo_id'] == $request->articulo) {
                    $recepcion_tmp = new DetalleRecepcion();

                    $recepcion_tmp->articulo = Articulo::find($request->articulo);
                    $recepcion_tmp->articulo_id = $request->articulo;
                    $recepcion_tmp->cantidad = $request->unidades + $value['cantidad'];
                    $recepcion_tmp->precio_unitario = $request->costo_neto;
                    $recepcion_tmp->impuesto_unitario = $request->costo_imp;
                    $recepcion_tmp->total = $request->costo_total * $request->unidades;
                    array_push($recepcion_new, $recepcion_tmp);
                    $recepcion_flag = true;
                } else {
                    $recepcion_tmp = new DetalleRecepcion();

                    $recepcion_tmp->articulo = Articulo::find($value->articulo_id);
                    $recepcion_tmp->articulo_id = $value->articulo_id;
                    $recepcion_tmp->cantidad = $value['cantidad'];
                    $recepcion_tmp->precio_unitario = $value['precio_unitario'];
                    $recepcion_tmp->impuesto_unitario = $value['impuesto_unitario'];
                    $recepcion_tmp->total = $value['total'];
                    array_push($recepcion_new, $recepcion_tmp);
                }
            }
            if ($recepcion_flag == false) {
                $recepcion_tmp = new DetalleRecepcion();

                $recepcion_tmp->articulo = Articulo::find($request->articulo);
                $recepcion_tmp->articulo_id = $request->articulo;
                $recepcion_tmp->cantidad = $request->unidades;
                $recepcion_tmp->precio_unitario = $request->costo_neto;
                $recepcion_tmp->impuesto_unitario = $request->costo_imp;
                $recepcion_tmp->total = $request->costo_total * $request->unidades;
                array_push($recepcion_new, $recepcion_tmp);
            }
            session(['recepcion' => $recepcion_new]);
        } else {
            $recepcion = new DetalleRecepcion();
            $recepcion->articulo = Articulo::find($request->articulo);
            $recepcion->articulo_id = $request->articulo;
            $recepcion->cantidad = $request->unidades;
            $recepcion->precio_unitario = $request->costo_neto;
            $recepcion->impuesto_unitario = $request->costo_imp;
            $recepcion->total = $request->costo_total * $request->unidades;
            array_push($recepcion_new, $recepcion);
            session(['recepcion' => $recepcion_new]);
        }



        $proveedores = Proveedor::all();
        $articulos = Articulo::all();
        $tipo_documento = tipo_documento::all();

        return view('recepciones.create', compact(['proveedores', 'articulos', 'tipo_documento']));
    }
    public function store(Request $request)
    {

        $recepcion = new Recepciones();
        $recepcion->proveedor_id = $request->proveedor;
        $recepcion->documento = $request->numero_documento;
        $recepcion->tipo_documentos_id = $request->tipo_documento;
        $recepcion->total_neto = $request->monto_neto;
        $recepcion->total_iva = $request->monto_imp;
        $recepcion->unidades = $request->total_articulos;
        $recepcion->fecha_recepcion = Carbon::now()->format('Y-m-d');
        $recepcion->observaciones = $request->observaciones;
        $recepcion->user_id = Auth::user()->id;
        $recepcion->timestamps = false;
        $recepcion->save();
        $detalle = session('recepcion');
        foreach ($detalle as $value) {
            $detalle_recepcion = new DetalleRecepcion();
            $detalle_recepcion->recepcion_id = $recepcion->id;
            $detalle_recepcion->producto_id = $value->articulo_id;
            $detalle_recepcion->cantidad = $value->cantidad;
            $detalle_recepcion->precio_unitario = $value->precio_unitario;
            $detalle_recepcion->impuesto_unitario = $value->impuesto_unitario;
            $detalle_recepcion->save();

            $articulo = Articulo::find($value->articulo_id);
            $articulo->stock = $articulo->stock + $value->cantidad;
            $articulo->costo_neto = $value->precio_unitario;
            $articulo->costo_imp = $value->impuesto_unitario;
            $articulo->save();

            $detalleMovimiento = new DetalleMovimientosArticulos();
            $detalleMovimiento->movimiento_id = 1; // 1 = recepciones
            $detalleMovimiento->id_movimiento = $recepcion->id;
            $detalleMovimiento->producto_id = $value->articulo_id;
            $detalleMovimiento->cantidad = $value->cantidad;
            $detalleMovimiento->usuario_id = Auth::user()->id;
            $detalleMovimiento->save();
        }
        session()->forget('recepcion');
        return redirect()->route('recepciones.index')->with([
            'error' => 'Error',
            'mensaje' => 'Recepcion creada correctamente con el numero ' . $recepcion->id,
            'tipo' => 'alert-success'
        ]);
    }
}
