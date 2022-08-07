<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMovimientosArticulos extends Model
{
    use HasFactory;
    public function Movimiento()
    {

        return $this->hasOne(Tipo_movimiento::class, 'id', 'movimiento_id');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }
    public function Articulo()
    {
        return $this->hasOne(Articulo::class, 'id', 'producto_id');
    }
}