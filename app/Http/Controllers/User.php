<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
use App\Models\datosGenerales;
use App\Models\proyectos;
use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\Password_reset;
use DragonCode\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Laravel\Facades\Image;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class User extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ModelsUser::class, 'user');
    }

    public function index()
    {
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
            'comprobante_domicilio' => ['required', File::types(['jpg','pdf'])->max(1024)],
            'comprobante_ine' => ['required', File::types(['jpg','pdf'])->max(1024)]
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
}
