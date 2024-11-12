<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoriasController extends Controller
{

    public function index()
    {
        $this->authorize('viewAny', Categorias::class);
        $categorias = Categorias::get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"  => ['required', Rule::unique('categorias')],
            'descripcion'  => 'required|max:255'
        ]);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        $categoria = Categorias::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
        ]);
        if ($request->hasfile('image')) {
            $archivo = $request->file('image');
            $nombe_archivo =  'categoria_' .  $categoria->name . "." .  $request->file('image')->getClientOriginalExtension();
            $nombe_archivo = str_replace('/', '_', $nombe_archivo);
            $nombe_archivo = str_replace(' ', '_', $nombe_archivo);
            Storage::disk('public')->put("categoria/" . $nombe_archivo, \File::get($archivo));
            $categoria->photo = "categoria/" . $nombe_archivo;
            $categoria->update();
        }

        toast('Exito, se regsitro la categoria de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function create()
    {
        $this->authorize('create', Categorias::class);
        return view('admin.categorias.create');
    }
    public function edit($id)
    {
        $this->authorize('edit', Categorias::class);
        $categoria = Categorias::find($id);


        if (!isset($categoria->name)) {
            abort(404);
        }
        return view('admin.categorias.edit', compact('categoria'));
    }


    public function update(Request $request, $id)
    {

        $this->authorize('update', Categorias::class);

        $validator = Validator::make($request->all(), [
            "name"  => ['required', Rule::unique('categorias')->ignore($id)],
            'descripcion'  => 'required|max:255'
        ]);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        $categoria = Categorias::find($id);
        if (!isset($categoria->name)) {
            abort(404);
        }
        $categoria->update([
            'name' => $request->name,
            'descripcion' => $request->descripcion
        ]);

        if ($request->hasfile('image')) {
            $archivo = $request->file('image');
            $nombe_archivo =  'categoria_' .  $categoria->name . "." .  $request->file('image')->getClientOriginalExtension();
            $nombe_archivo = str_replace('/', '_', $nombe_archivo);
            $nombe_archivo = str_replace(' ', '_', $nombe_archivo);
            Storage::disk('public')->put("categoria/" . $nombe_archivo, \File::get($archivo));
            $categoria->photo = "categoria/" . $nombe_archivo;
            $categoria->update();
        }
        toast('Exito, se actualizo la categoria de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function desactivar(Request $request)
    {
        if (!auth()->user()->can('CATEGORIAS#delete')) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos',
            ]);
        }
        $categoria = Categorias::find($request->categoria);
        $categoria->active = ($categoria->active) ? false : true;
        $categoria->update();
        return response()->json([
            'success' => true,
            'message' => 'Se actualizo con exito',
        ]);;
        //return redirect()->route('categorias.index');
    }
    public function home(Request $request)
    {
        if (!auth()->user()->can('CATEGORIAS#home')) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos',
            ]);
        }
        $categoria = Categorias::find($request->categoria);
        $categoria->home = ($categoria->home) ? false : true;
        $categoria->update();
        return response()->json([
            'success' => true,
            'message' => 'Se actualizo con exito',
        ]);
    }
    public function inicio()
    {
        if (Auth::check()) {
            $consulta = Categorias::where('active', true)->get();

            $categoriasUser = Auth::user()->categorias;

            $arr = $categoriasUser->map(function ($arreglo) {
                $arreglo->input = 'checked';
                return $arreglo;
            });

            $arreglo_permisos = collect($arr);

            $categorias = $consulta->merge($arreglo_permisos);

            return view('categorias.index', compact('categorias'));
        }
        $categorias = Categorias::where('active', 1)->paginate(5);
        return view('categorias.index', compact('categorias'));
    }
    public function addUser(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos',
            ]);
        }
        
        $user = User::find(Auth::user()->id);
        
        $state = $user->categorias()->toggle($request->id);

        return response()->json([
            'success' => true,
            'message' => 'Se actualizo con exito',
            'state' => $state
        ]);
    }
}
