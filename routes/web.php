<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\MagazineController;
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
// define route untuk visitor
Route::controller(VisitorController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/pdf/{id}', 'show')->name('pages.baca');
    Route::get('/deskripsi/{id}','deskripsi')->name('pages.deskripsi');
    Route::get('/fetch-sorted-data', 'fetchSortedData');
});
// Route::get('/fetch-sorted-data', 'MagazineController@fetchSortedData');

// define route untuk admin
Route::controller(AdminController::class)->group(function () {
    Route::any('/admin', 'index')->name('admins.index');
    Route::any('/admin/create','create')->name('admins.create');
    Route::any('/admin/store','store');
    Route::any('/admin/edit/{id}', 'edit')->name('admins.edit');
    Route::any('/admin/delete/{id}','destroy');
    Route::get('/admin/deskripsi/{id}','deskripsi')->name('admin.deskripsi');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
