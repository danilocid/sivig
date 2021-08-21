<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('administracion.usuarios.index', compact('usuarios'));
    }
    public function create(){
        
        return view('administracion.usuarios.crear');
    }
    public function store(Request $request){
        $usuario = new User();

        $usuario->name = $request->nombre;
        $usuario->user = $request->user;
        $usuario->email = $request->email;
        $usuario->active = $request->activo;
        $usuario->password = Hash::make($request->password);

        $usuario->save();
        return redirect()->route('configuracion.usuarios.index');

    }
    public function show($id){
        $usuario = User::find($id);
        return view('administracion.usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, User $usuario){
        $usuario->name = $request->nombre;
        $usuario->user = $request->user;
        $usuario->email = $request->email;
        $usuario->active = $request->activo;

        $usuario->save();
        return redirect()->route('configuracion.usuarios.index');
       
    }
}
