<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        $usuario = User::find($user);
        $anio = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'required|date|before:'.date('Y-m-d'),
            'tutor' => 'exclude_if:tipo,adulto',
            'comprobante_domicilio' => ['mimes:jpg,pdf'],
            'comprobante_ine' => ['mimes:jpg,pdf'],
            'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
            'terminos' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
            return redirect()->back();
        }

        $archivo = $request->file('comprobante_domicilio');
        $extencion = $request->file('comprobante_domicilio')->getClientOriginalExtension();
        $comprobante =  'comprobante_' . $usuario->name . $extencion;
        $comprobante = str_replace('/', '_', $comprobante);
        $comprobante = str_replace(' ', '_', $comprobante);
        Storage::disk('private')->put($comprobante, \File::get($archivo));

        $usuario->documento = $comprobante;


        $archivo = $request->file('comprobante_ine');
        $extencion = $request->file('comprobante_domicilio')->getClientOriginalExtension();
        $nombre_identificacion =  'ine_' . $usuario->name . $extencion;
        $nombre_identificacion = str_replace('/', '_', $nombre_identificacion);
        $nombre_identificacion = str_replace(' ', '_', $nombre_identificacion);
        Storage::disk('private')->put($nombre_identificacion, \File::get($archivo));

        $usuario->identificacion = $nombre_identificacion;
        if ($request->email != $usuario->email) {
            $usuario->email_verified_at = null;
            $usuario->update();
        }
        $usuario->update([
            "tipo" => "adulto",
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "calle" => $request->calle,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado,
            "terminos" => 1,
            'identificacion' => $nombre_identificacion,
            'documento' =>  $nombre_identificacion,
        ]);


        return $request;
    }
}
