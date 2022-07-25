<?php

namespace App\Http\Controllers;

use App\Models\DetalleRecepcion;
use App\Models\Recepciones;
use App\models\Articulo;
use App\models\Proveedor;
use App\Models\tipo_documento;
use Illuminate\Http\Request;

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
    public function view($recepcion)
    {
        $recepcion = Recepciones::find($recepcion);
        if ($recepcion == null) {
            return redirect()->route('recepciones.index')->with([
                'error' => 'Error',
                'mensaje' => 'Recepcion no encontrada',
                'tipo' => 'alert-danger'
            ]);
        }
        $detalle = DetalleRecepcion::where('recepcion_id', $recepcion->id)->get();
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
}