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
            'permiso' => 'MODULOS'
        ]);
        EnlaceModulo::create([
            'titulo' => 'Ver modulos',
            'enlace' => 'modulos.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'MODULOS#ver'
        ]);

        $modulo = Modulos::create([
            'nombre' => 'USUARIOS',
            'permiso' => 'USUARIOS'
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

        EnlaceModulo::create([
            'titulo' => 'Crear roles',
            'enlace' => 'roles.create',
            'modulo_id' => $modulo->id,
            'permiso' => 'ROLES#crear'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'MI INFORMACIÓN',
            'permiso' => 'USER_DATA',
            'icono' => 'category',
            'color' => '#000'
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
            'icono' => 'person',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver Empleados',
            'enlace' => 'empleados.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'EMPLEADOS#ver'
        ]);


        $modulo = Modulos::create([
            'nombre' => 'CATEGORIAS',
            'permiso' => 'CATEGORIAS',
            'icono' => 'category',
            'color' => '#ae8fdb'
        ]);

        EnlaceModulo::create([
            'titulo' => 'Ver Empleados',
            'enlace' => 'categorias.index',
            'modulo_id' => $modulo->id,
            'permiso' => 'CATEGORIAS#ver'
        ]);
    }
}
