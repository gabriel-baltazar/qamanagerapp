<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('/users/perfil/{user}', [App\Http\Controllers\UserController::class, 'profile'])->name('users.pefil');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.delete');

    Route::resource('tasks', App\Http\Controllers\TaskController::class);
    Route::put('/tasks/getTask/{id}', [App\Http\Controllers\TaskController::class, 'getTask'])->name('tasks.getTask');
    Route::get('/tasks/myTask/{task}', [App\Http\Controllers\TaskController::class, 'myTask'])->name('tasks.myTask');
    Route::post('/tasks/finalizar', [App\Http\Controllers\TaskController::class, 'finishTask'])->name('tasks.finish');
    Route::resource('stopwatches', App\Http\Controllers\StopwatchController::class);

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
});