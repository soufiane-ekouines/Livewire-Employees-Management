<?php

use App\Http\Livewire\Country\CountryIndex;
use App\Http\Livewire\State\StatesIndex;
use App\Http\Livewire\Users\UserIndex;
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
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
route::view('/dashboard','dashboard')->name('dashboard');
route::get('/users',UserIndex::class)->name('users.index');
route::get('/country',CountryIndex::class)->name('country.index');
Route::get('/state',StatesIndex::class)->name('state.index');
});
