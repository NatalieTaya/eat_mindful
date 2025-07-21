<?php

use App\Http\Controllers\DateController;
use App\Http\Controllers\EntryController;
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
    return view('week');
});

Route::post('/show-week', [DateController::class, 'showWeek'])->name('show.week');
Route::post('/day',[DateController::class, 'showDate'])->name('show.day');



Route::get('/entries', [EntryController::class, 'index']);
Route::get('/entries/create/{date}/{meal}',[EntryController::class, 'create'])
        ->where(['date' => '\d{4}-\d{2}-\d{2}', 'meal' => '\d+'])
        ->name('entries.create');
Route::post('/entries/store',[EntryController::class, 'store'])->name('entries.store');
