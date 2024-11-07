<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): Response
    {
        return auth()->user()->can('EMPLEADOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Admin $admin): Response
    {
        return auth()->user()->can('EMPLEADOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): Response
    {
        return auth()->user()->can('EMPLEADOS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }


    public function edit($user): Response
    {
        return auth()->user()->can('EMPLEADOS#editar')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user): Response
    {
        return auth()->user()->can('EMPLEADOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Admin $admin): Response
    {
        return auth()->user()->can('EMPLEADOS#delete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Admin $admin): Response
    {
        return auth()->user()->can('EMPLEADOS#restore')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Admin $admin): Response
    {
        return auth()->user()->can('EMPLEADOS#forceDelete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
