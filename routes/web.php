<?php

use App\Http\Controllers\DictionaryController;

use App\Http\Controllers\EventsController;
use App\Http\Controllers\LocalesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TranslationsController;
use App\Http\Controllers\TypesController;
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
    return (new DictionaryController())->index('statuses');
});

// statuses
// categories
// gates
// destinations
// facilities
// materials
// interface elements
Route::prefix('dictionary')->group(function () {
    Route::get('{type}', [DictionaryController::class, 'index'])->name('dictionary.index');
    Route::get('{type}/create', [DictionaryController::class, 'create'])->name('dictionary.create');
    Route::post('{type}/create', [DictionaryController::class, 'store'])->name('dictionary.store');
    Route::get('{type}/{id}/edit', [DictionaryController::class, 'edit'])->name('dictionary.edit');
    Route::put('{type}/{id}', [DictionaryController::class, 'update'])->name('dictionary.update');
    Route::delete('{type}/{id}', [DictionaryController::class, 'destroy'])->name('dictionary.destroy');
});

Route::resource('types', TypesController::class);
Route::post('types/store', [TypesController::class, 'store'])->name('types.store');

Route::put('locales/update-all', [LocalesController::class, 'updateAll'])->name('locales.updateAll');
Route::resource('translations', TranslationsController::class);

Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('settings/{parameter}', [SettingsController::class, 'update'])->name('settings.update');

Route::resource('events', EventsController::class);
Route::post('events/store', [EventsController::class, 'store'])->name('events.store');
Route::post('events/get-filtered', 'App\Http\Controllers\EventsController@getFiltered');
Route::get('events/gate/{departure_gate_id}', 'App\Http\Controllers\EventsController@gate');
Route::get('events/next-events-for-gate/{departure_gate_id}', 'App\Http\Controllers\EventsController@nextEventsForGate');
Route::get('events/get-current-for-gate/{departure_gate_id}', 'App\Http\Controllers\EventsController@getCurrentForGate');

Route::post('/events/get-filtered', 'App\Http\Controllers\EventsController@getFiltered');
