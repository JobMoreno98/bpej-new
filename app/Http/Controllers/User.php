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
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class User extends Controller
{
    public function index()
    {
        $users = ModelsUser::all();
        return view('admin.usuarios.index', compact('users'));
    }
}
