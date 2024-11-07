<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            "name"  => 'required|unique:categorias',
            'descripcion'  => 'required|max:255'
        ]);
        Categorias::create([
            'name' => $request->name,
            'descripcion' => $request->descripcion,
        ]);
        alert()->success('Exito', 'Se registro de forma exitosa la categoria');
        return redirect()->route('categorias.index');
    }

    public function desactivar(Request $request)
    {
        if(!auth()->user()->can('CATEGORIAS#delete')){
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
}
