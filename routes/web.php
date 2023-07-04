<?php

use App\Http\Controllers\GamesController;
use App\Http\Controllers\StandingsController;
use App\Http\Controllers\TeamController;
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

Route::get('/', function () {
    return view('dashboard',[
        'title' => 'Dashboard'
    ]);
});

Route::get('standings', [StandingsController::class, 'index']);


Route::resource('team', TeamController::class);

Route::get('/games',[GamesController::class,'index'])->name('games.index');

Route::get('/games/create',[GamesController::class,'create'])->name('games.create');

Route::post('/games',[GamesController::class,'store'])->name('games.store');

Route::get('/games/{games}/edit',[GamesController::class,'edit'])->name('games.edit');

Route::put('/games/{games}/update',[GamesController::class,'update'])->name('games.update');

Route::delete('/games/{games}/delete',[GamesController::class,'destroy'])->name('games.destroy');
