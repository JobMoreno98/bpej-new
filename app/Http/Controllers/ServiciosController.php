<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiciosController extends Controller
{
    public function  index()
    {
        $servicios = Servicios::all();
        return view('admin.servicios.index', compact('servicios'));
    }
    public function create()
    {
        $this->authorize('create', Servicios::class);
        return view('admin.servicios.create');
    }

    public function store(Request $request)
    {

        $this->authorize('store', Servicios::class);

        $validator = Validator::make($request->all(), [
            'nombre' => ['required', Rule::unique('servicios')],
            'ubicacion' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        $servicio = Servicios::create($request->except(['_token', 'image']));
        $servicio->slug = Str::slug($servicio->nombre, '-');
        $servicio->update();
        if ($request->hasFile('image')) {
            $archivo = $request->file('image');
            $nombe_archivo =  'servicio_' .  $servicio->nombre . "." .  $request->file('image')->getClientOriginalExtension();
            $nombe_archivo = str_replace('/', '_', $nombe_archivo);
            $nombe_archivo = str_replace(' ', '_', $nombe_archivo);
            Storage::disk('public')->put("servicios/" . $nombe_archivo, \File::get($archivo));
            $servicio->photo = "servicios/" . $nombe_archivo;
            $servicio->update();
        }

        toast('Exito, se registro el servicio de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return redirect()->route('servicios.index');
    }
    public function edit($id)
    {
        $this->authorize('edit', Servicios::class);
        $servicio = Servicios::find($id);
        if (!isset($servicio->nombre)) {
            abort(404);
        }

        return view('admin.servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Servicios::class);
        $servicio = Servicios::find($id);
        if (!isset($servicio->nombre)) {
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', Rule::unique('servicios')->ignore($servicio->id)],
            'ubicacion' => 'required',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        $servicio->update($request->except(['_token', 'image']));
        $servicio->slug = Str::slug($servicio->nombre, '-');
        $servicio->update();

        if ($request->hasFile('image')) {
            $archivo = $request->file('image');
            $nombe_archivo =  'servicio_' .  $servicio->nombre . "." .  $request->file('image')->getClientOriginalExtension();
            $nombe_archivo = str_replace('/', '_', $nombe_archivo);
            $nombe_archivo = str_replace(' ', '_', $nombe_archivo);
            Storage::disk('public')->put("servicios/" . $nombe_archivo, \File::get($archivo));

            $servicio->photo = "servicios/" . $nombe_archivo;
            $servicio->update();
        }

        toast('Exito, se actualizo el servicio de forma correcta', 'success')->timerProgressBar()->autoClose(3000);
        return redirect()->route('servicios.edit', $servicio->id);
    }
    public function desactivar(Request $request)
    {
        if (!auth()->user()->can('SERVICIOS#delete')) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos',
            ]);
        }
        $servicio = Servicios::find($request->servicio);
        $servicio->active = ($servicio->active) ? false : true;
        $servicio->update();
        return response()->json([
            'success' => true,
            'message' => 'Se actualizo con exito',
        ]);
    }
    public function home(Request $request)
    {
        if (!auth()->user()->can('SERVICIOS#home')) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos',
            ]);
        }
        $servicio = Servicios::find($request->servicio);
        $servicio->home = ($servicio->home) ? false : true;
        $servicio->update();
        return response()->json([
            'success' => true,
            'message' => 'Se actualizo con exito',
        ]);
    }
    public function inicio()
    {
        $servicios = Servicios::where('active', 1)->paginate(10);
        return view('servicios.index', compact('servicios'));
    }

    public function show($slug)
    {
        $servicio = Servicios::where('slug',$slug)->first();
        if (!isset($servicio->nombre)) {
            abort(404);
        }
        return view('servicios.show', compact('servicio'));
    }
}
