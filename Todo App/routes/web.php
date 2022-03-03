<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\todoController;

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




Route::get('User/',[userController::class,'index']);
Route::get('User/Register',[userController::class,'create']);
Route::post('User/Store',[userController::class,'Store']);
Route::get('User/delete/{id}',[userController::class,'delete']);
Route::get('User/edit/{id}',[userController::class,'edit']);
Route::put('User/update/{id}',[userController::class,'update']);
Route::get("User/LogOut",[userController::class,'LogOut']);



Route::get("User/Login",[userController::class,'login']);
Route::post("User/doLogin",[userController::class,'doLogin']);


Route::middleware(['checkLogin'])->group(function () {

    Route::resource('Todo', todoController::class);
});
