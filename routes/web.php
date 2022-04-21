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

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/artists', 'ArtistController@index')->name('artists.index');
    Route::get('/artists/artist/{artist:id}', 'ArtistController@show')->name('artists.show');

    Route::view('/', 'dashboard')->name('dashboard');

    Route::middleware('auth.admin')
        ->prefix('admin/artists')
        ->name('admin.artists.')
        ->group(function () {
            Route::get('/create', [ArtistController::class, 'create'])->name('create');
            Route::post('/', [ArtistController::class, 'store'])->name('store');
            Route::get('/{artist:id}/edit', [ArtistController::class, 'edit'])->name('edit');
            Route::patch('/{artist:id}/update', [ArtistController::class, 'update'])->name('update');
            Route::delete('/{artist:id}/destroy', [ArtistController::class, 'destroy'])->name('destroy');
        });
});

require __DIR__ . '/auth.php';
