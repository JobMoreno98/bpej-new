<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /*
     * Determine whether the user can view any models.
     */
    public function viewAny($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('USUARIOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, User $model): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('USUARIOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }

        return auth()->user()->can('USUARIOS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }


    public function edit($user): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }

        return $user->can('USUARIOS#editar')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, $model): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        if ($user->id == $model->id) {
            return Response::allow();
        }

        return auth()->user()->can('USUARIOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, User $model): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('USUARIOS#delete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, User $model): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('USUARIOS#restore')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, User $model): Response
    {
        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('USUARIOS#forceDelete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    public function photo($user, $model)
    {

        if ($user === null) {
            return  Response::deny(__("You don't can view this page"));
        }

        if ($user->id == $model->id) {
            return Response::allow();
        }

        return auth()->user()->can('USUARIOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
    public function file($user, $model)
    {

        if ($user === null || $model === null) {
            return  Response::deny(__("You don't can view this page"));
        }

        if ($user->id == $model->id) {
            return Response::allow();
        }

        return auth()->user()->can('USUARIOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
