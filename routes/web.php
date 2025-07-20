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
Route::get('/{day}', function ($day) {
    return view('day', ['day' => $day]);
})->name('show.day');


Route::post('/show-date', [DateController::class, 'showDate'])->name('show.date');
Route::post('/show-week', [DateController::class, 'showWeek'])->name('show.week');



Route::get('/entries', [EntryController::class, 'index']);
