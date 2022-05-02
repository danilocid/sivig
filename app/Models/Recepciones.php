<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_recepcion',
        'proveedor',
        'documento',
        'tipo_documento',
        'total_neto',
        'total_iva',
        'unidades',
        'observaciones',
        'fecha_recepcion',
        'usuario'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function tipodocumento()
    {
        return $this->belongsTo(tipo_documento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}