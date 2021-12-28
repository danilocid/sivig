<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('administracion.usuarios.index', compact('usuarios'));
    }
    public function create()
    {

        return view('administracion.usuarios.crear');
    }
    public function store(Request $request)
    {
        $usuario = new User();

        $usuario->name = $request->nombre;
        $usuario->user = $request->user;
        $usuario->email = $request->email;
        $usuario->active = $request->activo;
        $usuario->password = Hash::make($request->password);
        try {
            $usuario->save();
            return redirect()->route('configuracion.usuarios.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Usuario creado con exito',
                'tipo' => 'alert-success'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('configuracion.usuarios.index')->with([
                'error' => 'Error',
                'mensaje' => 'Usuario no pudo ser creado',
                'tipo' => 'alert-danger'
            ]);
        }
    }
    public function show($id)
    {
        $usuario = User::find($id);
        return view('administracion.usuarios.editar', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $usuario->name = $request->nombre;
        $usuario->user = $request->user;
        $usuario->email = $request->email;
        $usuario->active = $request->activo;
        try {
            $usuario->save();
            return redirect()->route('configuracion.usuarios.index')->with([
                'error' => 'Exito',
                'mensaje' => 'Usuario modificado con exito',
                'tipo' => 'alert-primary'
            ]);
        } catch (\Exception $e) {

            return view('configuracion.usuarios.editar', compact('usuario'));
        }
    }
}
