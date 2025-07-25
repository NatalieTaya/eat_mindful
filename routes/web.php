<?php

use App\Http\Controllers\DateController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ProductContoller;
use Database\Factories\ProductFactory;
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
})->name('main');

Route::post('/show-week', [DateController::class, 'showWeek'])->name('show.week');
Route::get('/day', [DateController::class, 'showDate'])->name('show.day');
Route::get('/test-route', function() {
    return 'Это тестовый маршрут';
});


Route::get('/entries', [EntryController::class, 'index']);
Route::get('/entries/create/{date}/{meal}',[EntryController::class, 'create'])
        ->where(['date' => '\d{4}-\d{2}-\d{2}', 'meal' => '\d+'])
        ->name('entries.create');
Route::post('/entries/store',[EntryController::class, 'store'])
        ->name('entries.store');
Route::get('/entries/edit/{date}/{meal}/{entry}',[EntryController::class, 'edit'])
        ->name('entries.edit');
Route::post('/entries/update',[EntryController::class, 'update'])
        ->name('entries.update');
Route::delete('/entries/{entry}/{meal}',[EntryController::class, 'destroy'])
        ->name('entries.destroy');



Route::get('/products/create',[ProductContoller::class, 'create'])
        ->name('products.create');
Route::post('/products/store',[ProductContoller::class, 'store'])
        ->name('products.store');

//Route::resource('products',ProductContoller::class);