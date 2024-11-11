<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $permissionNames = $user->getPermissionsViaRoles();
        $modulos = DB::table('modulos_enlace')
            ->whereIn('enlace_permiso', $permissionNames->pluck('name')->toArray())
            ->get()
            ->groupBy('modulo_nombre');
        //dd($user);
        return view('home', compact('modulos'));
    }
    public function home()
    {
        $categorias = Categorias::inRandomOrder()->take(5)->get();
        $servicios  = Servicios::inRandomOrder()->take(5)->get();
        return view('welcome', compact('categorias', 'servicios'));
    }
}
