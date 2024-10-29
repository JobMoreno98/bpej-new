<?php

namespace App\Http\Controllers;

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
        return view('home', compact('modulos'));
    }
}
