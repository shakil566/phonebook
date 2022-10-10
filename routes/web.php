<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\PhoneBookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[FrontendController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('contact/addMultipleEmail', [App\Http\Controllers\Admin\PhoneBookController::class, 'addMultipleEmail'])->name('contact.addMultipleEmail');
Route::post('contact/addMultiplePhone', [App\Http\Controllers\Admin\PhoneBookController::class, 'addMultiplePhone'])->name('contact.addMultiplePhone');

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.index');
    // });
    Route::get('/contact', [App\Http\Controllers\Admin\PhoneBookController::class, 'index'])->name('contact');
    Route::get('/contact/create', [App\Http\Controllers\Admin\PhoneBookController::class, 'create'])->name('contact.create');
    Route::post('/contact', [App\Http\Controllers\Admin\PhoneBookController::class, 'store'])->name('contact.store');
    Route::post('/contact/filter', [App\Http\Controllers\Admin\PhoneBookController::class, 'filter']);
    Route::get('/contact/{id}/edit', [App\Http\Controllers\Admin\PhoneBookController::class, 'edit'])->name('contact.edit');
    Route::post('/contact/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'destroy'])->name('contact.destroy');
    Route::get('add-to-favourite/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'addToFavourite'])->name('contact.addToFavourite');

    Route::get('/contact/favourite', [App\Http\Controllers\Admin\PhoneBookController::class, 'favouriteContact'])->name('contact.favouriteContact');

});
