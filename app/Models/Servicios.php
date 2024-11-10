<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Servicios extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected function horario(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hora_inicio . "-" . $this->hora_fin,
        );
    }
}
