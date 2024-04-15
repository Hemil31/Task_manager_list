<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task_Controller;
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

Route::get('/register', [AuthController::class, 'showregisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerCreate'])->name('register.create');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginCheck'])->name('login.check');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/account/{id}', [AuthController::class, 'deleteAccount'])->name('account.delete');
//middle implement
Route::middleware('verification')->group(function () {
    Route::get('/', [Task_Controller::class, 'homePage'])->name('home');
    Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile');
    Route::post('/imgupload', [ProfileController::class, 'uploadimg'])->name('imgupload');
    Route::get('/add', [Task_Controller::class, 'showAddForm'])->name('add');
    Route::post('/add', [Task_Controller::class, 'addTask'])->name('add.insert');

    Route::get('/delete/{id}', [Task_Controller::class, 'deleteTask'])->name('delete');
    Route::get('/edit/{id}', [Task_Controller::class, 'editTask'])->name('edit');
    Route::post('/edit/{id}', [Task_Controller::class, 'updateTask'])->name('edit.update');
    Route::put('/update/{id}', [Task_Controller::class, 'updateStatus'])->name('tasks.update-status');
});




