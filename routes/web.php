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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\ProjectController::class, 'index']);
 Route::get('/add', [App\Http\Controllers\ProjectController::class, 'create']);
 Route::post('/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.add');
 Route::get('/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit']);
 Route::post('/update', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');
 Route::delete('/destroy', [App\Http\Controllers\ProjectController::class, 'destroy']);