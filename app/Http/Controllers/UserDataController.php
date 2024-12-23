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
use Maestroerror\HeicToJpg;
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
        $message = [
            'documento.max' => 'El tamaño de la identificacion debe ser menor a  5Mb',
            'identificacion.max' => 'El tamaño de la identificacion debe ser menor a  5Mb',
            'identificacion.required' => 'El campo identificación es obligatorio',
            'telefono.required' => 'El campo teléfono es obligatorio',
            'profile_photo_path.max' => 'El tamaño de la fotografia debe ser menor a 5Mb',
            'profile_photo_path.uploaded' => 'El tamaño de la fotografia debe ser menor a 5Mb',
            'documento.uploaded' => 'El tamaño de la fotografia debe ser menor a 5Mb',
            'identificacion.uploaded' => 'El tamaño de la identificacion debe ser menor a  5Mb',
            'tipo.required' => 'Debes de especificar si eres mayor de edad o no',
            'codigo_postal.required' => 'El campo código postal es obligatorio'
        ];

        $request->validate([
            'profile_photo_path' => 'nullable|max:5120',
            'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
            'tutor' => Rule::requiredIf($request->tipo == 'menor'),
            'curp' => [Rule::requiredIf($request->tipo == 'menor'), 'nullable','size:18'],
            'name' => 'required',
            'email' => ['required', Rule::unique('users')],
            'terminos' => 'required|in:1',
            'calle' => 'required',
            'colonia' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'tipo' => 'required',
            'codigo_postal' => 'required',
            'documento' => ['required', 'file', 'mimes:jpg,jpeg,heic,pdf', 'max:5120'],
            'identificacion' => ['required', 'file', 'mimes:jpg,jpeg,heic,pdf', 'max:5120'],
            'telefono' => 'required|regex:/[0-9]{10}/|size:10'
        ], $message);
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
                'documento' => ['required', 'mimes:jpg,jpeg,heic,pdf'],
                'identificacion' => ['required', 'mimes:jpg,jpeg,heic,pdf'],
            ]);
        }
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
            return redirect()->back();
        }

            */


        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "calle" => $request->calle,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado,
            "terminos" => 1,
            'tipo' => $request->tipo,
            'telefono' => $request->telefono,
            'tutor' => ($request->tipo == 'menor') ? $request->tutor : null,
            'curp' => ($request->tipo == 'menor') ? $request->curp : null,
            'colonia' => $request->colonia,
        ]);

        if ($request->hasFile('documento')) {
            if (isset($usuario->documento)) {
                Storage::disk('files')->delete($usuario->documento);
            }


            $archivo = $request->file('documento');
            $extencion = $request->file('documento')->getClientOriginalExtension();
            $comprobante =  'documento_' . $usuario->name . ".jpg";
            $comprobante = str_replace('/', '_', $comprobante);
            $comprobante = str_replace(' ', '_', $comprobante);
            if ($extencion == 'HEIC') {
                HeicToJpg::convert($archivo)->saveAs("../storage/app/private/comprobante/" .  $usuario->name);
            } else {

                Storage::disk('files')->put("comprobante/" . $comprobante, \File::get($archivo));
            }
            $usuario->documento = "comprobante/" . $comprobante;
        }

        if ($request->hasFile('identificacion')) {
            if (isset($usuario->identificacion)) {
                Storage::disk('files')->delete($usuario->identificacion);
            }
            $archivo = $request->file('identificacion');
            $extencion = $request->file('identificacion')->getClientOriginalExtension();
            $nombre_identificacion =  'identificacion_' .  $usuario->name . ".jpg";
            $nombre_identificacion = str_replace('/', '_', $nombre_identificacion);
            $nombre_identificacion = str_replace(' ', '_', $nombre_identificacion);
            if ($extencion == 'HEIC') {
                HeicToJpg::convert($archivo)->saveAs("../storage/app/private/identificacion/" .  $usuario->name);
            } else {
                Storage::disk('files')->put("identificacion/" . $nombre_identificacion, \File::get($archivo));
            }

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
        /*
        if ($request->email != $usuario->email) {
            $usuario->email_verified_at = null;
        }
*/
        $usuario->clave_bpej = "2012" . sprintf("%'.06d\n", $usuario->id);
        $usuario->update();
        event(new Registered($usuario));
        return view('revisarCorreo');
        //toast('Exito, se actualizarón tus datos de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        //return redirect()->route('verification.notice');
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
