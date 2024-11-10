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

        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'required|date',
            'tutor' => 'exclude_if:tipo,adulto',
            'comprobante_domicilio' => ['required', File::types(['jpg', 'pdf'])->max(12 * 1024)],
            'comprobante_ine' => ['required', File::types(['jpg', 'pdf'])->max(12 * 1024)]
        ]);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back();
        }


        $user = ModelsUser::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'tipo' => $request->tipo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'calle' => $request->calle,
            'municipio' => $request->municipio,
            'codigo_postal' => $request->codigo_postal,
            'estado' => $request->estado,
            'clave_bpej' => $request->clave_bpej,

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
        }

        $user->profile_photo_path = "/profile_images/crop/" . $filenametostore;
        $user->update();

        $user->assignRole('general');
        return $request;
    }

    public function update(Request $request, $user)
    {

        $usuario = ModelsUser::find($user);
        
        
        $this->authorize('update',  [ModelsUser::class, $usuario]);
        
        $validator = Validator::make($request->all(), [
            'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
            'tutor' => 'exclude_if:tipo,adulto',
            'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
            'calle' => 'required',
            'municipio' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'required',
        ]);

        if (!isset($usuario->documento) || !isset($usuario->identificacion)) {
            $validator = Validator::make($request->all(), [
                'fecha_nacimiento' => 'required|date|before:' . date('Y-m-d'),
                'tutor' => 'exclude_if:tipo,adulto',
                'email' => ['required', Rule::unique('users')->ignore($usuario->id)],
                'calle' => 'required',
                'municipio' => 'required',
                'estado' => 'required',
                'codigo_postal' => 'required',
                'documento' => ['required', 'mimes:jpg,pdf'],
                'identificacion' => ['required', 'mimes:jpg,pdf'],
            ]);
        }
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back();
        }
        if ($request->hasFile('documento')) {
            $archivo = $request->file('documento');
            $extencion = $request->file('documento')->getClientOriginalExtension();
            $comprobante =  'documento_' . $usuario->name . "." . $extencion;
            $comprobante = str_replace('/', '_', $comprobante);
            $comprobante = str_replace(' ', '_', $comprobante);
            Storage::disk('files')->put("comprobante/" . $comprobante, \File::get($archivo));

            $usuario->documento = $comprobante;
        }

        if ($request->hasFile('identificacion')) {
            $archivo = $request->file('identificacion');
            $extencion = $request->file('identificacion')->getClientOriginalExtension();

            $nombre_identificacion =  'identificacion_' .  $usuario->name . "." . $extencion;
            $nombre_identificacion = str_replace('/', '_', $nombre_identificacion);
            $nombre_identificacion = str_replace(' ', '_', $nombre_identificacion);
            Storage::disk('files')->put("identificacion/" . $nombre_identificacion, \File::get($archivo));

            $usuario->identificacion = $nombre_identificacion;
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
        }
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
            'identificacion' => $usuario->identificacion,
            'documento' =>  $usuario->documento,
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
