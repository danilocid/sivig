<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recepciones extends Model
{
    use HasFactory;

    protected $fillable = [];
    public function
    documentos()
    {

        //$this->belongsTo(TipoDocumentos::class, 'tipo_documentos_id');
        return $this->belongsTo(tipo_documento::class, 'tipo_documentos_id', 'id');
        // return null;
    }

    public function proveedor()
    {
        // return $this->belongsTo(proveedor::class);

        return $this->belongsTo(proveedor::class);
    }



    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}