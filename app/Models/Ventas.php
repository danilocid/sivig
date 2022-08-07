<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    public function TipoDocumento()
    {
        return $this->belongsTo(tipo_documento::class, 'tipo_documentos_id', 'id');
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}