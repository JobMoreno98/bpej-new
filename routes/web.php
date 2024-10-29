<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin', config('jetstream.auth_session')]], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});



Route::name('admin')->middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::prefix('admin')->middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('modulos', ModulosController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('permisos', PermisosController::class);

    Route::resource('usuarios', User::class)->names('usuarios');

    Route::post('/eliminar-enlace', [ModulosController::class, 'eliminar_enlace'])
        ->name('eliminar.enlace');

    Route::post('/activar-enlace', [ModulosController::class, 'activar_enlace'])
        ->name('activar.enlace');


    Route::post('guardar-relacion-permisos/{id}', [RolesController::class, 'guardarRelacion'])->name('guardar_relacion_permisos');
    Route::get('asignar-permisos/{id}', [
        'as' => 'asignar_permisos',
        'uses' => 'App\Http\Controllers\RolesController@relacionar',
    ]);
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});
