<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'showLoginForm']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::middleware('role:superadmin|admin')->group(function () {
        // ADMIN ROUTE
        Route::get('/home', [PageController::class, 'index'])->name('admin.dashboard');
        Route::get('chart', [PageController::class, 'chart'])->name('admin.chart');
        Route::get('tables', [PageController::class, 'tables'])->name('admin.tables');

        // STUDENTS
        Route::get('student', [StudentController::class, 'index'])->name('student.index');
        Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
        Route::get('student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');

        Route::post('student', [StudentController::class, 'store'])->name('student.store');
        Route::put('student/{id}', [StudentController::class, 'update'])->name('student.update');
        Route::delete('student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
        Route::get('student/export', [StudentController::class, 'export']);
    });

    Route::middleware('role:superadmin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
