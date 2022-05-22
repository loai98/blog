<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;


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



Route::get('/user/{name}/{id}', function ($name , $id) {
    [PageController::class ,"about"];
});


Route::get("/", [PageController::class ,"index"]);
Route::get("/about", [PageController::class ,"about"]);
Route::get("/services", [PageController::class ,"services"]);
Route::resource("posts", PostController::class);


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
