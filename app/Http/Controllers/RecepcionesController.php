<?php

namespace App\Http\Controllers;

use App\Models\Recepciones;
use Illuminate\Http\Request;

class RecepcionesController extends Controller
{
    public function index()
    {
        $recepciones = Recepciones::all();
        return view('recepciones.index', compact('recepciones'));
    }
}