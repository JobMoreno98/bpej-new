<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::create(['guard_name' => 'admin', 'name' => 'MODULOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'MODULOS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'MODULOS#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'MODULOS#update']);
        Permission::create(['guard_name' => 'admin', 'name' => 'MODULOS#delete']);
        //USUARIOS
        Permission::create(['guard_name' => 'admin', 'name' => 'USUARIOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'USUARIOS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'USUARIOS#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'USUARIOS#update']);
        //ROLES
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#update']);
        //PERMISOS
        Permission::create(['guard_name' => 'admin', 'name' => 'PERMISOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'PERMISOS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'PERMISOS#delete']);

        Permission::create(['guard_name' => 'admin', 'name' => 'ESTADISTICAS#ver']);


        //SERVICIOS
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#update']);
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#delete']);
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#home']);

        // Categorias
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#delete']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#update']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#home']);

        //Empleados
        Permission::create(['guard_name' => 'admin', 'name' => 'EMPLEADOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'EMPLEADOS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'EMPLEADOS#editar']);
        Permission::create(['guard_name' => 'admin', 'name' => 'EMPLEADOS#update']);

        Permission::create(['guard_name' => 'web', 'name' => 'DATOS#ver']);
        Permission::create(['guard_name' => 'web', 'name' => 'uCATEGORIAS#ver']);


        //super admin
        $role = Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->get());


        //usuario admin

        $role = Role::create(['guard_name' => 'admin', 'name' => 'admin']);

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->whereNot('name', 'like', 'MODULOS%')
        ->whereNot('name', 'like', 'ROLES%')->whereNot('name', 'like', 'PERMISOS%')->whereNot('name', 'like', '%delete%')->get());

        //usuario general

        $rol = Role::create(['guard_name' => 'web', 'name' => 'general']);

        $rol->givePermissionTo(Permission::where('guard_name', 'web')->get());

        $user = Admin::create([
            'name' => 'super admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('Super Admin');

        $user = Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Job Moreno',
            'email' => 'job@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);
        $user->assignRole('general');
    }
}
