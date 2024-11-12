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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('ubicacion');
            $table->time('hora_inicio', precision: 0);
            $table->time('hora_fin', precision: 0);
            $table->string('descripcion');
            $table->string('photo')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('home')->default(true);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
