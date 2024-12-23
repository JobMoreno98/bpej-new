<?php

namespace Database\Seeders;

use App\Models\EnlaceModulo;
use App\Models\Modulos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $modulo = Modulos::create([
            'nombre' => 'MODULOS',
            'permiso' => 'MODULOS',
            'icono' => 'settings',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver modulos',
            'enlace' => 'modulos.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'MODULOS#ver'
        ]);

        $modulo = Modulos::create([
            'nombre' => 'USUARIOS',
            'permiso' => 'USUARIOS',
            'icono' => 'person',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver usuarios',
            'enlace' => 'usuarios.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'USUARIOS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'PERMISOS',
            'permiso' => 'PERMISOS',
            'icono' => 'folder_managed',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver permisos',
            'enlace' => 'permisos.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'PERMISOS#ver'
        ]);

        $modulo = Modulos::create([
            'nombre' => 'ROLES',
            'permiso' => 'ROLES',
            'icono' => 'folder_supervised',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver roles',
            'enlace' => 'roles.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'ROLES#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'MI INFORMACIÓN',
            'permiso' => 'USER_DATA',
            'icono' => 'category',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Mi información',
            'enlace' => 'user.data',
            'modulo_id' => $modulo->id,
            'permiso' => 'DATOS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'MIS CATEGORIAS',
            'permiso' => 'USER_CATEGORIAS',
            'icono' => 'category',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Mis categorias',
            'enlace' => 'mis-categorias',
            'modulo_id' => $modulo->id,
            'permiso' => 'uCATEGORIAS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'EMPLEADOS',
            'permiso' => 'EMPLEADOS',
            'icono' => 'badge',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver Empleados',
            'enlace' => 'empleados.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'EMPLEADOS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'CATEGORIAS LITERARIAS',
            'permiso' => 'CATEGORIAS',
            'icono' => 'category',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver categorias',
            'enlace' => 'categorias.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'CATEGORIAS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'SERVICIOS BPEJ',
            'permiso' => 'SERVICIOS',
            'icono' => 'linked_services',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver servicios',
            'enlace' => 'servicios.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'SERVICIOS#ver'
        ]);
    }
}
