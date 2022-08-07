<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;
    public function Producto()
    {

        return $this->hasOne(Articulo::class, 'id', 'producto_id');
    }
}