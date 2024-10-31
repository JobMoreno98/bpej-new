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
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Laravel\Facades\Image;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class User extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ModelsUser::class, 'modulos');
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
        if ($request->hasFile('profile_image')) {

            $filenametostore = date('Y') . "_" . Auth::user()->name . ".jpg";

            Storage::put('public/profile_images/' . $filenametostore, fopen($request->file('profile_image'), 'r+'));
            //            Storage::put('public/profile_images/crop/' . $filenametostore, fopen($request->file('profile_image'), 'r+'));
            $imgOriginal = Image::read($request->file('profile_image'));
            $img = $imgOriginal->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'))->toPng();
            return Storage::disk('local')->put("/profile_images/crop/" . $filenametostore, $img);
        }
        return $request;
    }
}
