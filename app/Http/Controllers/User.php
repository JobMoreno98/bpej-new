<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Validation\Rule;

class User extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', ModelsUser::class);
        $users = ModelsUser::all();
        return view('admin.usuarios.index', compact('users'));
    }
    public function create()
    {
        return view('admin.usuarios.create');
    }
    public function store(Request $request)
    {
        $message = [
            'documento.size' => 'El tamaño de la identificacion debe ser menor a  5Mb',
            'identificacion.size' => 'El tamaño de la identificacion debe ser menor a  5Mb',
            'profile_photo_path.size' => 'El tamaño de la fotografia debe ser menor a 5Mb'
        ];


        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
            'tutor' => Rule::requiredIf($request->tipo == 'menor'),
            'documento' => ['required', 'file', 'mimes:jpg,jpeg,heic,pdf', 'max:5120'],
            'identificacion' =>  ['required', 'file', 'mimes:jpg,jpeg,heic,pdf', 'max:5120'],
            'curp' => [Rule::requiredIf($request->tipo == 'menor'), 'nullable','size:18'],
            'calle' => 'required',
            'colonia' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required|numeric',
            'tipo' => 'required',
            'clave_rfid' => 'required',
            'email' => ['required', Rule::unique('users')],
            'name' => ['required', Rule::unique('users')]
        ], $message);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        $user = ModelsUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'tipo' => $request->tipo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'calle' => $request->calle,
            'municipio' => $request->municipio,
            'codigo_postal' => $request->codigo_postal,
            'estado' => $request->estado,
            'clave_rfid' => $request->clave_rfid,
            'curp' => ($request->tipo == 'menor') ? $request->curp : null,
            'tutor' => ($request->tipo == 'menor') ? $request->tutor : null,
        ]);

        if (isset($request->image)) {
            $data = $request->image;
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $url = "/profile_images/temp/" . time() . '.jpg';
            Storage::disk('files')->put($url, $data);
            $imgOriginal = Image::read(Storage::disk('files')->get($url));
            $img = $imgOriginal->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'))->toPng();
            $filenametostore = date('Y') . "_" . $request->nombre . ".jpg";
            Storage::disk('files')->put("/profile_images/crop/" . $filenametostore, $img);
            Storage::disk('files')->delete($url);
            $user->profile_photo_path = "/profile_images/crop/" . $filenametostore;
        }

        if ($request->hasFile('documento')) {
            if (isset($usuario->documento)) {
                Storage::disk('files')->delete($usuario->documento);
            }
            $archivo = $request->file('documento');
            $extencion = $request->file('documento')->getClientOriginalExtension();
            $comprobante =  'documento_' . $user->name . "." . $extencion;
            $comprobante = str_replace('/', '_', $comprobante);
            $comprobante = str_replace(' ', '_', $comprobante);
            Storage::disk('files')->put("comprobante/" . $comprobante, \File::get($archivo));
            $user->documento = "comprobante/" . $comprobante;
        }

        if ($request->hasFile('identificacion')) {
            if (isset($usuario->identificacion)) {
                Storage::disk('files')->delete($usuario->identificacion);
            }

            $archivo = $request->file('identificacion');
            $extencion = $request->file('identificacion')->getClientOriginalExtension();
            $nombre_identificacion =  'identificacion_' .  $user->name . "." . $extencion;
            $nombre_identificacion = str_replace('/', '_', $nombre_identificacion);
            $nombre_identificacion = str_replace(' ', '_', $nombre_identificacion);
            Storage::disk('files')->put("identificacion/" . $nombre_identificacion, \File::get($archivo));
            $user->identificacion = "identificacion/" . $nombre_identificacion;
        }


        $user->clave_bpej = "2012" . sprintf("%'.06d\n", $user->id);
        $user->update();

        $user->assignRole('general');
        return redirect()->route('usuarios.edit', $user->id);
    }

    public function update(Request $request, $user)
    {

        $usuario = ModelsUser::find($user);
        $this->authorize('update',  [ModelsUser::class, $usuario]);


        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
            'tutor' => Rule::requiredIf($request->tipo == 'menor'),
            'curp' => [Rule::requiredIf($request->tipo == 'menor'), 'nullable','size:18'],
            'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
            'calle' => 'required',
            'colonia' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required',
            'clave_rfid' => 'required',
            'clave_bpej' => ['required', Rule::unique('users')->ignore($usuario->id)]
        ]);

        if (!isset($usuario->documento) || !isset($usuario->identificacion)) {
            $validator = Validator::make($request->all(), [
                'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
                'tutor' => Rule::requiredIf($request->tipo == 'menor'),
                'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
                'curp' => [Rule::requiredIf($request->tipo == 'menor'), 'nullable','size:18'],
                'calle' => 'required',
                'municipio' => 'required',
                'estado' => 'required',
                'codigo_postal' => 'required',
                'clave_rfid' => 'required',
                'documento' => ['required', 'mimes:jpg,jpeg,heic,pdf'],
                'identificacion' => ['required', 'mimes:jpg,jpeg,heic,pdf'],
            ]);
        }
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back();
        }

        if ($request->hasFile('documento')) {
            if (isset($usuario->documento)) {
                Storage::disk('files')->delete($usuario->documento);
            }
            $archivo = $request->file('documento');
            $extencion = $request->file('documento')->getClientOriginalExtension();
            $comprobante =  'documento_' . $usuario->name . "." . $extencion;
            $comprobante = str_replace('/', '_', $comprobante);
            $comprobante = str_replace(' ', '_', $comprobante);
            Storage::disk('files')->put("comprobante/" . $comprobante, \File::get($archivo));

            $usuario->documento = "comprobante/" . $comprobante;
            $usuario->update();
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
            $usuario->update();
        }

        if (isset($request->image)) {
            $data = $request->image;

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $url = "/profile_images/temp/" . time() . '.jpg';
            Storage::disk('files')->put($url, $data);
            $imgOriginal = Image::read(Storage::disk('files')->get($url));
            $img = $imgOriginal->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'))->toPng();
            $filenametostore = date('Y') . "_photo_" . $request->nombre . ".jpg";
            $nombre_photo = str_replace('/', '_', $filenametostore);
            $nombre_photo = str_replace(' ', '_', $nombre_photo);

            Storage::disk('files')->put("/profile_images/crop/" . $nombre_photo, $img);
            Storage::disk('files')->delete($url);

            $usuario->profile_photo_path = "/profile_images/crop/" . $nombre_photo;
            $usuario->update();
        }
        if ($request->email != $usuario->email) {
            $usuario->email_verified_at = null;
            $usuario->update();
        }


        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            "fecha_nacimiento" => $request->fecha_nacimiento,
            "calle" => $request->calle,
            "municipio" => $request->municipio,
            "codigo_postal" => $request->codigo_postal,
            "estado" => $request->estado,
            "terminos" => 1,
            'tipo' => $request->tipo,
            'tutor' => ($request->tipo == 'menor') ? $request->tutor : null,
            'curp' => ($request->tipo == 'menor') ? $request->curp : null,
            'aleph' => isset($request->aleph) ? 1 : 0,
            'clave_rfid' => $request->clave_rfid,
            'fecha_impresion' => isset($request->fecha_impresion) ? date('Y-m-d') : null
        ]);
        toast('Exito, se actualizo el usuario de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return redirect()->route('usuarios.edit', $usuario->id);
    }
    public function edit($id)
    {
        $user = ModelsUser::find($id);
        $this->authorize('edit',  [ModelsUser::class, $user]);

        return view('admin.usuarios.edit', compact('user'));
    }
}
