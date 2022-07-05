<?php

namespace App\Http\Controllers;

use App\Models\DetalleRecepcion;
use App\Models\Recepciones;
use Illuminate\Http\Request;

class RecepcionesController extends Controller
{
    public function index()
    {
        $recepciones = Recepciones::all();
        return view('recepciones.index', compact('recepciones'));
    }
    public function view($recepcion)
    {
        $recepcion = Recepciones::find($recepcion);
        $detalle = DetalleRecepcion::where('recepcion_id', $recepcion->id)->get();
        return view('recepciones.view', compact(['recepcion', 'detalle']));
    }
}