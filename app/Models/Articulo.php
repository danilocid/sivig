<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'cod_interno',
        'cod_barras',
        'descripcion',
        'costo_neto',
        'costo_imp',
        'venta_neto',
        'venta_imp',
        'stock',
        'stock_critico',
        'activo'
    ];
}
