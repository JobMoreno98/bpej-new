<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement("
        CREATE OR REPLACE VIEW roles_permisos 
            AS
        SELECT
    `bpej`.`permissions`.`id` AS `permiso_id`,
    `bpej`.`permissions`.`name` AS `nombre_permiso`,
    `bpej`.`modulos_enlace`.`modulo_nombre` AS `modulo_nombre`,
    `bpej`.`role_has_permissions`.`role_id` AS `role_id`,
    `bpej`.`permissions`.`guard_name` AS `guard_name`
FROM
    (
        (
            `bpej`.`permissions`
        LEFT JOIN `bpej`.`modulos_enlace` ON
            (
                (
                    `bpej`.`permissions`.`name` = `bpej`.`modulos_enlace`.`enlace_permiso`
                )
            )
        )
    LEFT JOIN `bpej`.`role_has_permissions` ON
        (
            (
                `bpej`.`permissions`.`id` = `bpej`.`role_has_permissions`.`permission_id`
            )
        )
    )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_permisos');
    }
};
