<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::DELETE('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/task/status/{id}', [TaskController::class, 'changeStatus'])->name('tasks.change');


