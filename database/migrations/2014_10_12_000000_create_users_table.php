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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('tipo', ['adulto', 'menor'])->default('adulto');
            $table->string('tutor')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('calle')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('estado')->nullable();
            $table->string('documento')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('terminos')->default(true);
            $table->string('clave_bpej')->nullable();
            $table->string('clave_rfid')->nullable();
            $table->boolean('aleph')->default(false);
            $table->date('fecha_impresion')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
