<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);
        $empleados = Admin::all();

        return view('admin.empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Admin::class);
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return view('admin.empleados.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', Rule::unique('admins')],
            'role' => 'required|exists:roles,name',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);
        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
            return redirect()->back();
        }
        $empleado = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $empleado->syncRoles([$request->role]);
        toast('Exito, se registro al empelado de manera correcta', 'success');
        return redirect()->route('empleados.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit', Admin::class);
        $empleado = Admin::find($id);
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return view('admin.empleados.edit', compact('empleado', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Admin::class);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', Rule::unique('admins')->ignore($id)],
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
            return redirect()->back();
        }

        $empleado = Admin::find($id);
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            ]);
            if ($validator->fails()) {
                toast(implode("<br/>", $validator->messages()->all()), 'error')->timerProgressBar()->persistent(true, false);
                return redirect()->back();
            }
            $empleado->password = Hash::make($request->password);
        }

        $empleado->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $empleado->syncRoles([$request->role]);
        toast('Exito, se actualizo al empelado ', 'success');
        return redirect()->route('empleados.edit', $empleado->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
