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

Route::get('submit', Submit::class)->name('submit-api');
Route::get('apis', Apis::class)->name('apis');
Route::get('documentation/get-started', Apis::class)->name('documentation.get-started');
Route::get('documentation/embed-an-api', Apis::class)->name('documentation.embed-an-api');
Route::view('/', 'welcome')->name('home');
