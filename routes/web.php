<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/artists', 'ArtistController@index')->middleware('auth')->name('artists.index');
Route::get('/artists/artist/{artist:id}', 'ArtistController@ show')->middleware('auth')->name('artists.show');


Route::get('/admin/artists/create', [\App\Http\Controllers\Admin\ArtistController::class, 'create'])->middleware(['auth', 'auth.admin'])->name('admin.artists.create');
Route::post('/admin/artists', [\App\Http\Controllers\Admin\ArtistController::class, 'store'])->middleware(['auth', 'auth.admin'])->name('admin.artists.store');
Route::get('/admin/artists/{artist:id}/edit', [\App\Http\Controllers\Admin\ArtistController::class, 'edit'])->middleware(['auth', 'auth.admin'])->name('admin.artists.edit');
Route::patch('/admin/artists/{artist:id}/update', [\App\Http\Controllers\Admin\ArtistController::class, 'update'])->middleware(['auth', 'auth.admin'])->name('admin.artists.update');
Route::delete('/admin/artists/{artist:id}/destroy', [\App\Http\Controllers\Admin\ArtistController::class, 'destroy'])->middleware(['auth', 'auth.admin'])->name('admin.artists.destroy');


require __DIR__ . '/auth.php';
