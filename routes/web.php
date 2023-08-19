<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\List_magazineController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('PDFadmin',function (){
//     return view('/admins/index');
// });
Route::get('PDFadmin/create',function (){
    return view('/admins/create');
});
Route::resource('PDFadmin',List_magazineController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
