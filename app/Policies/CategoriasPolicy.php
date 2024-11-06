<?php

namespace App\Policies;

use App\Models\Categorias;
use Illuminate\Auth\Access\Response;

class CategoriasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): Response
    {
        return auth()->user()->can('CATEGORIAS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Categorias $categorias): Response
    {
        return auth()->user()->can('CATEGORIAS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): Response
    {
        return auth()->user()->can('CATEGORIAS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Categorias $categorias): Response
    {
        return auth()->user()->can('CATEGORIAS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Categorias $categorias): Response
    {
        return auth()->user()->can('CATEGORIAS#delete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, Categorias $categorias): Response
    {
        return auth()->user()->can('CATEGORIAS#restore')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, Categorias $categorias): Response
    {
        return auth()->user()->can('CATEGORIAS#forceDelete')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
