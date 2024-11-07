<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, ModelsRole $role): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }


    public function store($user): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, ModelsRole $role): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, ModelsRole $role): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#delete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, ModelsRole $role): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#restore')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, ModelsRole $role): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('ROLES#forceDelete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
