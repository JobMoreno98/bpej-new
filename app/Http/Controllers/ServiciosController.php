<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'nombre' => 'required',
            'ubicacion' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }

        Servicios::create($request->except('_token'));
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
            'nombre' => 'required',
            'ubicacion' => 'required',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'descripcion' => 'required',
        ]);
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->persistent(true, false);
            return redirect()->back()->withInput();
        }
        $servicio->update($request->except('_token'));
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
}
