<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\ArtController;



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

Route::middleware(['auth'])->group(function(){

    Route::get('/', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('artists')->group(function(){

        Route::get('/', [ArtistController::class, 'index'])->name('artists.index');
        Route::get('/show/{artist:id}', [ArtistController::class, 'show'])->name('artists.show');

    });

});


Route::prefix('admin')->middleware(['auth','auth.admin'])->group(function(){

    Route::prefix('artists')->group(function(){

        Route::get('/create', [ArtistController::class, 'create'])->name('admin.artists.create');
        Route::post('/', [ArtistController::class, 'store'])->name('admin.artists.store');
        Route::get('/edit/{artist:id}', [ArtistController::class, 'edit'])->name('admin.artists.edit');
        Route::patch('/update/{artist:id}', [ArtistController::class, 'update'])->name('admin.artists.update');
        Route::delete('/destroy/{artist:id}', [ArtistController::class, 'destroy'])->name('admin.artists.destroy');

    });
});


require __DIR__ . '/auth.php';
