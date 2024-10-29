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
        Permission::create(['guard_name' => 'admin','name' => 'MODULOS#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'USUARIOS#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'ROLES#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'PERMISOS#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'ESTADISTICAS#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'CATEGORIAS#ver']);
        Permission::create(['guard_name' => 'admin','name' => 'SERVICIOS#ver']);

        $role = Role::create(['guard_name' => 'admin','name' => 'admin']);

        $role->givePermissionTo(Permission::all());

        Role::create(['guard_name' => 'web','name' => 'general']);

        $user = Admin::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole('admin');
    }
}
