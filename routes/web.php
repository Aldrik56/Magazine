<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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
//     return view('home');
// });

// Route::resource('/', HomeController::class);
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/pdf/{id}', 'show')->name('pages.test');
    Route::get('/deskripsi','deskripsi')->name('pages.deskripsi');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index');
    Route::get('/admin/create', 'create');
    Route::post('/admin', 'store');
    Route::get('/admin/{id}/edit', 'edit');
    Route::put('/admin/{id}', 'update');
    Route::delete('/admin/{id}', 'destroy');
});
// Route::get('PDFadmin/create',function (){
//     return view('/admins/create');
// });
// Route::resource('PDFadmin',AdminController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
