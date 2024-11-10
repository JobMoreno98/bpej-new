<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiciosPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('SERVICIOS#ver')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
    public function create($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('SERVICIOS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
    public function store($user)
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('SERVICIOS#crear')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
    public function edit($user): Response
    {
        if ($user === null) {
            return Response::deny(__("You don't can view this page"));
        }
        return auth()->user()->can('SERVICIOS#editar')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
    public function update($user): Response
    {
        if ($user === null) {
            return false;
        }
        return auth()->user()->can('SERVICIOS#update')
            ? Response::allow()
            : Response::deny(__("You don't can view this page"));
    }
}
