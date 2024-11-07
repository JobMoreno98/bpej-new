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
        //ROLES
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'ROLES#edit']);
        //PERMISOS
        Permission::create(['guard_name' => 'admin', 'name' => 'PERMISOS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'PERMISOS#crear']);

        Permission::create(['guard_name' => 'admin', 'name' => 'ESTADISTICAS#ver']);
        
        Permission::create(['guard_name' => 'admin', 'name' => 'SERVICIOS#ver']);
        
        // Categorias
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#ver']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#crear']);
        Permission::create(['guard_name' => 'admin', 'name' => 'CATEGORIAS#delete']);

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

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->whereNot('name','like','MODULOS%')->get());

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
    }
}
