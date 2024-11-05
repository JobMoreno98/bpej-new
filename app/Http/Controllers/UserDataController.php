<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
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
        return view('users.datos', compact('user'));
    }

    public function edit($id)
    {
        $usuario = User::where('id', $id)->first();

        return view('admin.usuarios.edit')->with('usuario', $usuario);
    }
    public function update_user(Request $request, $user)
    {

        $this->authorize('update', Auth::user());

        $validator = Validator::make($request->all(), [
            'comprobante_domicilio' => ['required', File::types(['pdf'])->max(1024)],
            'comprobante_ine' => ['required', File::types(['pdf'])->max(1024)]
        ]);
        
        if ($validator->fails()) {
            toast(implode("<br/>",$validator->messages()->all()),'error')->timerProgressBar()->persistent(true,false);
            return redirect()->back();
        }

        $usuario = User::find($user);
        $usuario->update([
            "tipo" => "adulto",
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "calle" => $request->calle,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado,
            "terminos" => 1,
        ]);

        $archivo = $request->file('comprobante_domicilio');
        $nombre =  'comprobante_' . Auth::user()->name . '.pdf';
        $nombre = str_replace('/', '_', $nombre);
        $nombre = str_replace(' ', '_', $nombre);
        Storage::disk('extenso')->put($nombre, \File::get($archivo));

        $usuario->documento = $nombre;


        $archivo = $request->file('comprobante_ine');
        $nombre =  'ine_' . Auth::user()->name . '.pdf';
        $nombre = str_replace('/', '_', $nombre);
        $nombre = str_replace(' ', '_', $nombre);
        Storage::disk('extenso')->put($nombre, \File::get($archivo));

        $usuario->identificacion = $nombre;


        return $request;
    }
}
