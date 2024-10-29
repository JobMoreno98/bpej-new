<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorias extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function usaurio(): BelongsToMany
    {
        return $this->belongsToMany(UsuariosGeneral::class);
    }
}
