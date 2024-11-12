<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin', config('jetstream.auth_session')]], function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.inicio');
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::name('admin.')->middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'
])->get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::prefix('admin')->middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session')
])->group(function () {
    Route::resource('modulos', ModulosController::class);
    Route::resource('roles', RolesController::class)->names('roles');
    Route::resource('permisos', PermisosController::class)->names('permisos');
    Route::resource('categorias', CategoriasController::class);
    Route::resource('usuarios', User::class)->names('usuarios');
    Route::resource('empleados', EmpleadosController::class)->names('empleados');
    Route::resource('servicios', ServiciosController::class)->names('servicios')->except('show');

    Route::post('/eliminar-enlace', [ModulosController::class, 'eliminar_enlace'])->name('eliminar.enlace');
    Route::post('/activar-enlace', [ModulosController::class, 'activar_enlace'])->name('activar.enlace');
    Route::post('guardar-relacion-permisos/{id}', [RolesController::class, 'guardarRelacion'])->name('guardar_relacion_permisos');
    Route::get('asignar-permisos/{id}', [RolesController::class, 'relacionar'])->name('asignar_permisos');
    Route::post('/desactivar-categoria', [CategoriasController::class, 'desactivar'])->name('desactivar-categoria');
    Route::post('/desactivar-servicio', [ServiciosController::class, 'desactivar'])->name('desactivar-servicio');
    Route::post('/home-servicio', [ServiciosController::class, 'home'])->name('home-servicio');
    Route::post('/home-categoria', [CategoriasController::class, 'home'])->name('home-categoria');

    Route::get('/user-photo/{id}', [UserDataController::class, 'getPhoto'])->name('get-photo-admin');
    Route::get('/user-file/{id}/{type}', [UserDataController::class, 'getFile'])->name('get-file-admin');
});



// Rutas de usuario Normal
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',  [HomeController::class, 'index'])->name('dashboard');
    Route::get('/mis-categorias', [UserDataController::class, 'categorias'])->name('mis-categorias');
    Route::post('/usuario-categorias', [UserDataController::class, 'saveCategorias'])->name('user.caterogiras-store');
    Route::get('/mis-datos', [UserDataController::class, 'datos'])->name('user.data');
    Route::get('/usuario/{id}/edit', [UserDataController::class, 'edit'])
        ->name('usuario.edit')
        ->middleware('auth');

    Route::put('/user-update/{id}', [UserDataController::class, 'update_user'])->name('update-user')->middleware(['auth']);

    Route::get('/user-photo/{id}', [UserDataController::class, 'getPhoto'])->name('get-photo');
});



Route::get('/servicios', [ServiciosController::class, 'inicio'])->name('servicios.inicio');
Route::get('/servicios/{servicio}', [ServiciosController::class, 'show'])->name('servicios.show');
Route::get('/categorias', [CategoriasController::class, 'inicio'])->name('categorias.inicio');

Route::post('/add-category', [CategoriasController::class, 'addUser'])->name('add-category');


//Verificación de correo
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/admin', function () {
    return redirect()->route('admin.inicio');
});


//Logout
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/user/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('user.logout');
