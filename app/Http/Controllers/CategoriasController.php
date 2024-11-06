<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Categorias::class, 'categorias');
    }

    public function index()
    {
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
        $categoria = Categorias::find($request->categoria);
        $categoria->active = ($categoria->active) ? false : true;
        $categoria->update();
        return "Se actualizo la catgoria";
        //return redirect()->route('categorias.index');
    }
}
