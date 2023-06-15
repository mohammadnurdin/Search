<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // untuk mendaftarkan user controler
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\KegiatanController;


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
// mendaftarkan routes


Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('home', ['title' => 'Chart Ajax']);
        })->name('home');

        Route::get('password', [UserController::class, 'password'])->name('password');
        Route::post('password', [UserController::class, 'password_action'])->name('password.action');
        Route::get('logout', [UserController::class, 'logout'])->name('logout');
        //route position
        Route::resource('positions', PositionController::class);
        //route departement
        Route::resource('departements', DepartementController::class);
        Route::get('departement/export-pdf', [DepartementController::class, 'exportPdf'])->name('departement.export-pdf');
        Route::get('position/export-excel', [PositionController::class, 'exportExcel'])->name('position.exportExcel');

        Route::resource('user', UserController::class);
        Route::get('users/export-pdf', [UserController::class, 'exportPdf'])->name('users.export-Pdf');
        // Route::get('workshops/export-pdf', [WorkshopController::class, 'exportPdf'])->name('workshops.export-Pdf');

        Route::resource('workshops', WorkshopController::class);
        
        
        Route::get('home',[ WorkshopController::class, 'chartLine'])->name('workshops.chartLine');
        Route::get('chart-line-ajax',[ WorkshopController::class, 'chartLineAjax'])->name('workshops.chartLineAjax');


        Route::get('search/kegiatan', [KegiatanController::class, 'autocomplete'])->name('search.kegiatan');
        Route::resource('kegiatans', KegiatanController::class);
    }
);
