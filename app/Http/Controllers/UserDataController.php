<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
        $this->authorize('update', Auth::user());
        $usuario = User::where('id', $id)->first();

        return view('admin.usuarios.edit')->with('usuario', $usuario);
    }
    public function update_user(Request $request)
    {

        //$usuario = User::find($user);

        //dd($request->tipo);
        //$this->authorize('update', $usuario);

        $request->validate([
            'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
            'tutor' => Rule::requiredIf($request->tipo == 'menor'),
            'name' =>'required',
            'email' => ['required', Rule::unique('users')],
            'terminos' => 'required|in:1',
            'calle' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'tipo' => 'required',
            'codigo_postal' => 'required',
            'documento' => ['required', 'mimes:jpg,pdf'],
            'identificacion' => ['required', 'mimes:jpg,pdf'],
        ]);
        /*
        if (!isset($usuario->documento) || !isset($usuario->identificacion)) {
            $validator = Validator::make($request->all(), [
                'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
                'tutor' => Rule::requiredIf($request->tipo == 'menor'),
                'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
                'terminos' => 'required|in:1',
                'tipo' => 'required',
                'calle' => 'required',
                'municipio' => 'required',
                'estado' => 'required',
                'codigo_postal' => 'required',
                'documento' => ['required', 'mimes:jpg,pdf'],
                'identificacion' => ['required', 'mimes:jpg,pdf'],
            ]);
        }
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
            return redirect()->back();
        }

            */


        $usuario = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "calle" => $request->calle,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado,
            "terminos" => 1,
            'tipo' => $request->tipo,
            'tutor' => ($request->tipo == 'menor') ? $request->tutor : null
        ]);

        if ($request->hasFile('documento')) {
            $archivo = $request->file('documento');
            $extencion = $request->file('documento')->getClientOriginalExtension();
            $comprobante =  'documento_' . $usuario->name . "." . $extencion;
            $comprobante = str_replace('/', '_', $comprobante);
            $comprobante = str_replace(' ', '_', $comprobante);
            Storage::disk('files')->put("comprobante/" . $comprobante, \File::get($archivo));

            $usuario->documento = "comprobante/" . $comprobante;
        }

        if ($request->hasFile('identificacion')) {
            if (isset($usuario->identificacion)) {
                Storage::disk('files')->delete($usuario->identificacion);
            }

            $archivo = $request->file('identificacion');
            $extencion = $request->file('identificacion')->getClientOriginalExtension();

            $nombre_identificacion =  'identificacion_' .  $usuario->name . "." . $extencion;
            $nombre_identificacion = str_replace('/', '_', $nombre_identificacion);
            $nombre_identificacion = str_replace(' ', '_', $nombre_identificacion);
            Storage::disk('files')->put("identificacion/" . $nombre_identificacion, \File::get($archivo));

            $usuario->identificacion = "identificacion/" . $nombre_identificacion;
        }

        if ($request->hasFile('profile_photo_path')) {
            $archivo = $request->file('profile_photo_path');
            $extencion = $request->file('profile_photo_path')->getClientOriginalExtension();

            $nombre_photo =  date('Y') . '_photo_' .  $usuario->name . "." . $extencion;
            $nombre_photo = str_replace('/', '_', $nombre_photo);
            $nombre_photo = str_replace(' ', '_', $nombre_photo);
            Storage::disk('files')->put("/profile_images/crop/" . $nombre_photo, \File::get($archivo));

            $usuario->profile_photo_path = "/profile_images/crop/" . $nombre_photo;
        }

        if ($request->email != $usuario->email) {
            $usuario->email_verified_at = null;
        }

        $usuario->update();
        event(new Registered($usuario));
        //toast('Exito, se actualizarón tus datos de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return redirect()->route('verification.notice');
       // return redirect()->route('user.data', $usuario->id);
    }
    public function getPhoto($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('photo',  $user);
        return Storage::disk('files')->get($user->profile_photo_path);
    }

    public function getFile($id, $type)
    {
        $user = User::findOrFail($id);
        $this->authorize('file',  $user);
        return response()->file(Storage::disk('files')->path($user->$type));
    }
}
