<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_documento extends Model
{
    use HasFactory;
    protected  $fillable = [
        'tipo_documento'
    ];
    protected $table = 'tipo_documentos';
}