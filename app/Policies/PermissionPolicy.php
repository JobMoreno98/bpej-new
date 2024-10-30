<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
     /**
      * Determine whether the user can view any models.
      */
     public function viewAny($user): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#ver')
               ? Response::allow()
               : Response::deny( "You don't can view this page.");
     }

     /**
      * Determine whether the user can view the model.
      */
     public function view($user, ?Permission $permission): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#ver')
               ? Response::allow()
               : Response::deny("You don't can view this page.");
     }

     /**
      * Determine whether the user can create models.
      */
     public function create($user): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#crear')
               ? Response::allow()
               : Response::deny('You don´t can view this page.');
     }

     /**
      * Determine whether the user can update the model.
      */
     public function update($user, ?Permission $permission): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#update')
               ? Response::allow()
               : Response::deny('You don´t can view this page.');
     }

     /**
      * Determine whether the user can delete the model.
      */
     public function delete($user, ?Permission $permission): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#delete')
               ? Response::allow()
               : Response::deny('You don´t can view this page.');
     }

     /**
      * Determine whether the user can restore the model.
      */
     public function restore($user, ?Permission $permission): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#restore')
               ? Response::allow()
               : Response::deny('You don´t can view this page.');
     }

     /**
      * Determine whether the user can permanently delete the model.
      */
     public function forceDelete($user, ?Permission $permission): Response
     {
          if ($user === null) {
               return false;
          }
          return auth()->user()->can('PERMISOS#forceDelete')
               ? Response::allow()
               : Response::deny('You don´t can view this page.');
     }
}
