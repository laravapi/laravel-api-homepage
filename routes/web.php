<?php

use App\Http\Livewire\Apis;
use App\Http\Livewire\Submit;
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

Route::group(['middleware' => ['demoMode']], function() {
    Route::get('submit', Submit::class)->name('submit-api');
    Route::get('apis', Apis::class)->name('apis');
    Route::view('documentation/get-started', 'documentation.get-started')->name('documentation.get-started');
    Route::view('documentation/embed-an-api', 'documentation.embed-an-api')->name('documentation.embed-an-api');
    Route::redirect('/', 'apis')->name('home');
});

Route::demoAccess('/come-in-and-find-out');
Route::get('/under-construction', fn() => 'No. Not yet.')->withoutMiddleware(\Spatie\DemoMode\DemoMode::class);
