<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = Role::all();
        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('store', Role::class, Auth::user());

        $message = [
            'rol.unique' => 'El rol ya existe'
        ];
        $request->validate([
            'name' => 'required|unique:roles,name',

        ], $message);

        try {
            Role::create($request->all());
            $roles = Role::all();
            DB::commit();
            toast('Se creo el Rol','success');
            return redirect()->route('roles.index');
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return view('roles.create')->withErrors("Error al guardar el Rol.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    # AGARRE PARA ELIMINAR
    public function show($id)
    {
        $role = Role::findOrFail($id);

        if (! $role) {
            return view('roles.index')->withErrors("El no existe.");
        }

        return view('roles.show')->with('rol', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        if (! $role) {
            return view('roles.index')->withErrors("El no existe.");
        }

        return view('roles.edit')->with('rol', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'rol' => 'unique:roles,name'
        ];
        $message = [
            'rol.unique' => 'El rol ya existe'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return view('roles.create')->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $role = new Role();
            $role->fill($request->all());
            $role->save();
            $roles = Role::all();
            DB::commit();
            return view('roles.index')
                ->withSuccess("Rol guardado con éxito.")
                ->with('roles', $roles);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            return view('roles.create')->withErrors("Error al guardar el Rol.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Role::destroy($id);
            DB::commit();
            $roles = Role::all();
            return view('roles.index')
                ->withSuccess("Rol Eliminado con éxito.")
                ->with('roles', $roles);
        } catch (Exception $e) {
            Log::error($e);
            DB::rollBack();
            $roles = Role::all();
            return view('roles.index')
                ->withErrors("Error al eliminar el Rol.")
                ->with('roles', $roles);
        }
    }

    public function relacionar($id)
    {
        $permisosID = DB::table('roles_permisos')->select('permiso_id', 'nombre_permiso', 'modulo_nombre')->where('role_id', $id);

        $permisosSi = with($permisosID)->get()->groupBy('modulo_nombre');
        $permisos_id = with($permisosID)->get()->toArray();
        $permisos_id = Arr::pluck($permisos_id, 'permiso_id');
        $permidosNot = DB::table('roles_permisos')->select('permiso_id', 'nombre_permiso', 'modulo_nombre')->whereNotIn('permiso_id', $permisos_id)->orderBy('role_id')->get()->groupBy('modulo_nombre');

        $permisos = $permidosNot->map(function ($item, $key) {
            $item->input = '';
            return $item->unique('nombre_permiso')->all();
        });

        $arreglo_permisos = collect(Arr::collapse($permisos));
        $permisosID = collect(Arr::collapse($permisosSi));

        $arr = $permisosID->map(function ($arreglo) {
            $arreglo->input = 'checked';
            return $arreglo;
        });

        //$array = array_merge(Arr::collapse($permisos), Arr::collapse($permisosID));
        $permisos = array_merge_recursive($arr->groupBy('modulo_nombre')->toArray(), $arreglo_permisos->groupBy('modulo_nombre')->toArray());
        $rol = Role::findOrFail($id);

        return view('roles.relacionar', compact('permisos', 'rol'));
    }

    public function guardarRelacion(Request $request, $id)
    {
        //$permisos = base64_decode($request->get('permisos_seleccionados'));
        $role = Role::findOrFail($id);
        //$role->givePermissionTo($permisos);
        //dd($request->permisos_seleccionados);

        $role->syncPermissions(collect($request->permisos_seleccionados)->map(fn($val) => (int)$val));
        Alert::success('exito', 'exito');
        return redirect()->route('roles.index');
    }
}
