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
    public function MedioDePago()
    {
        return $this->belongsTo(mediosdepago::class, 'medio_pago_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}