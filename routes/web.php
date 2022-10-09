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

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.index');
    // });
    Route::get('/contact', [App\Http\Controllers\Admin\PhoneBookController::class, 'index'])->name('contact');
    Route::get('/contact/create', [App\Http\Controllers\Admin\PhoneBookController::class, 'create'])->name('contact.create');
    Route::post('/contact', [App\Http\Controllers\Admin\PhoneBookController::class, 'store'])->name('contact.store');
    Route::post('/contact/filter', [App\Http\Controllers\Admin\PhoneBookController::class, 'filter']);
    Route::delete('/contact/edit/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'edit'])->name('contact.edit');
    Route::delete('/contact/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}', [App\Http\Controllers\Admin\PhoneBookController::class, 'destroy'])->name('contact.destroy');

});

//seal
Route::post('admin/seal/filter/', 'PhoneBookController@filter');
// Route::get('admin/seal', 'PhoneBookController@index')->name('seal.index');
Route::get('admin/seal/create', 'SealController@create')->name('seal.create');
Route::post('admin/seal', 'SealController@store')->name('seal.store');

Route::get('admin/seal/{id}/edit', 'SealController@edit')->name('seal.edit');
Route::post('admin/seal/{id}', 'SealController@update')->name('seal.update');
Route::delete('admin/seal/{id}', 'SealController@destroy')->name('seal.destroy');
