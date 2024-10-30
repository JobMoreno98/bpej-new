<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserDataController extends Controller
{
    public function index() {}

    public function categorias()
    {
        $categorias = Categorias::leftJoin('categorias_to_usuarios', 'categorias_to_usuarios.categorias_id', '=', 'categorias.id')
            ->select('categorias.*', 'categorias_to_usuarios.categorias_id', 'categorias_to_usuarios.users_id')->where('categorias.active', true)
            ->groupBy('name')->get();

        return view('users.categorias', compact('categorias'));
    }
    public function saveCategorias(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->categorias()->sync($request->categorias);
        //Alert::toast('Exito', 'Se han guardado tus preferencias');
        toast('Exito, se han guardado tus preferencias', 'success')->timerProgressBar()->autoClose(3000);
        return redirect()->route('mis-categorias');
    }

    public function datos()
    {
        $user = User::find(Auth::user()->id);
        return view('users.datos',compact('user'));
    }
}
