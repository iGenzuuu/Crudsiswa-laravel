<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DatatableController;

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
    return view('auth.login');
})->name('/');

//auth
Route::post('login',[LoginController::class,'authenticate'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('storeregister',[RegisterController::class,'register'])->name('store.register');

//after login
Route::resource('/students', StudentController::class);
Route::resource('/users', UserController::class);

Route::get('/search',[StudentController::class,'searchStudent'])->name('search');

//profile
Route::get('my-profile', [ProfileController::class, 'profile'])->name('my-profile');
Route::put('update-profile', [ProfileController::class, 'update'])->name('update-profile');
Route::put('change-password', [ProfileController::class, 'changePassword'])->name('change-password');

//datatable
Route::get('/getstudent',[DatatableController::class,'getStudent'])->name('getstudent');
Route::get('/getuser',[DatatableController::class,'getUser'])->name('getuser');
