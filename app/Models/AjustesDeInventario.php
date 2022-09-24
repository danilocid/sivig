<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjustesDeInventario extends Model
{
    use HasFactory;
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function Movimiento()
    {

        return $this->hasOne(Tipo_movimiento::class, 'id', 'tipo_movimiento_id');
    }
}