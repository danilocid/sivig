<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mediosdepago extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'medio_de_pago',

    ];
}
