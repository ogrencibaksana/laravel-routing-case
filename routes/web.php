<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArtistController;

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

Route::middleware('auth')->group(function () {
    Route::get('/artists', 'ArtistController@index')->name('artists.index');
    Route::get('/artists/artist/{artist:id}', 'ArtistController@show')->name('artists.show');
    
    Route::get('/admin/artists/create', [ArtistController::class, 'create'])->middleware('auth.admin')->name('admin.artists.create');
    Route::post('/admin/artists', [ArtistController::class, 'store'])->middleware('auth.admin')->name('admin.artists.store');
    Route::get('/admin/artists/{artist:id}/edit', [ArtistController::class, 'edit'])->middleware('auth.admin')->name('admin.artists.edit');
    Route::patch('/admin/artists/{artist:id}/update', [ArtistController::class, 'update'])->middleware('auth.admin')->name('admin.artists.update');
    Route::delete('/admin/artists/{artist:id}/destroy', [ArtistController::class, 'destroy'])->middleware('auth.admin')->name('admin.artists.destroy');
});

require __DIR__ . '/auth.php';
