<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Categorias extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function usuario(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'categorias_to_usuarios', 'categorias_id', 'users_id',);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'categorias_to_usuarios', 'categorias_id', 'users_id')
        ->select('users.id')->where('users.id', Auth::user()->id);
    }
}
