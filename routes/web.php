<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\TaskController::class,'index'])->name('index');
Route::post('/create',[App\Http\Controllers\TaskController::class,'createTodo'])->name('create-todo');
Route::post('/delete/{id}',[App\Http\Controllers\TaskController::class,'deleteTodo'])->name('delete-todo');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
