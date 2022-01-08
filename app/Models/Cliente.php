<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable =[
        'rut',
        'nombre',
        'giro',
        'direccion',
        'comuna_id',
        'region_id',
        'telefono',
        'mail'
    ];

    public function comuna(){
        return $this->belongsTo(Comuna::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }

}
