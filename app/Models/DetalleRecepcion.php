<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRecepcion extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function Producto()
    {

        return $this->hasOne(Articulo::class, 'id', 'id');
        
    }
}
