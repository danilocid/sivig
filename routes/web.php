<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComunasController;
use App\Http\Controllers\mediosdepagoController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\RecepcionesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');
//configuracion
//usuarios
Route::get('Configuracion/Usuarios', [UsuariosController::class, 'index'])->name('configuracion.usuarios.index');
Route::get('Configuracion/Usuarios/Crear', [UsuariosController::class, 'create'])->name('configuracion.usuarios.create');
Route::post('Configuracion/Usuarios', [UsuariosController::class, 'store'])->name('configuracion.usuarios.store');
Route::get('Configuracion/Usuarios/{id}', [UsuariosController::class, 'show'])->name('configuracion.usuarios.editar');
Route::put('Configuracion/Usuarios/{usuario}', [UsuariosController::class, 'update'])->name('configuracion.usuarios.update');

//medios de pago

Route::get('Configuracion/MediosDePago', [mediosdepagoController::class, 'index'])->name('configuracion.mediosdepago.index');
Route::get('Configuracion/MediosDePago/Crear', [mediosdepagoController::class, 'create'])->name('configuracion.mediosdepago.create');
Route::post('Configuracion/MediosDePago', [mediosdepagoController::class, 'store'])->name('configuracion.mediosdepago.store');
Route::get('Configuracion/MediosDePago/{id}', [mediosdepagoController::class, 'show'])->name('configuracion.mediosdepago.editar');
Route::put('Configuracion/MediosDePago/{id}', [mediosdepagoController::class, 'update'])->name('configuracion.mediosdepago.update');

// clientes

Route::get('Clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('Clientes/Crear', [ClientesController::class, 'create'])->name('clientes.create');
Route::get('Clientes/{id}', [ClientesController::class, 'show'])->name('clientes.editar');
Route::put('Clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::post('Clientes', [ClientesController::class, 'store'])->name('clientes.store');

//proveedores

Route::get('Proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
Route::get('Proveedores/Crear', [ProveedoresController::class, 'create'])->name('proveedores.create');
Route::get('Proveedores/{id}', [ProveedoresController::class, 'show'])->name('proveedores.editar');
Route::put('Proveedores/{proveedor}', [ProveedoresController::class, 'update'])->name('proveedores.update');
Route::post('Proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');

//articulos

Route::get('Articulos', [ArticulosController::class, 'index'])->name('articulos.index');
Route::get('Articulos/Crear', [ArticulosController::class, 'create'])->name('articulos.create');
Route::get('Articulos/{id}', [ArticulosController::class, 'show'])->name('articulos.editar');
Route::put('Articulos/{articulo}', [ArticulosController::class, 'update'])->name('articulos.update');
Route::post('Articulos', [ArticulosController::class, 'store'])->name('articulos.store');

//recepciones
Route::get('Recepciones', [RecepcionesController::class, 'index'])->name('recepciones.index');
Route::get('Recepciones/Agregar', [RecepcionesController::class, 'create'])->name('recepciones.create');
Route::get('Recepciones/{id}', [RecepcionesController::class, 'view'])->name('recepciones.view');
Route::post('Recepciones/Agregar', [RecepcionesController::class, 'addArticulo'])->name('recepciones.addarticulo');