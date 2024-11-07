<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Modulos;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulosPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('MODULOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, ?Modulos $modulos): Response
    {

        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): Response
    {

        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    public function edit($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('MODULOS#edit')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Modulos $modulos): Response
    {
        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Modulos $modulos): Response
    {
        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#delete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Modulos $modulos): Response
    {
        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#restore')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Modulos $modulos): Response
    {
        if ($user === null) {
            return false;
        }
        return auth()->user()->can('MODULOS#forceDelete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
