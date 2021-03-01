<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Varieties;
use App\Http\Livewire\Characteristics;
use App\Http\Controllers\Selections;
use App\Http\Controllers\DetailSelectionController;
//use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
//Route::get('varieties', Varieties::class);
Route::get('characteristics', Characteristics::class);
Route::get('selections', [Selections::class,'index'])->name('selections');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::group(['middleware' =>[
		'auth:sanctum',
		'verified'
	]], function (){
		Route::get('/dashboard', function () {
			return view('dashboard');
		})->name('dashboard');
		Route::get('/varieties', Varieties::class);
		Route::get('characteristics', Characteristics::class);
		Route::get('selections', [Selections::class,'index'])->name('selections');
		Route::get('selections.create', [Selections::class,'create'])->name('selections.create');
		Route::get('/example', [Selections::class,'example'])->name('example');
		Route::post('selections.store', [Selections::class,'store'])->name('selections.store');
		Route::post('selections.delete/{selection}', [Selections::class,'destroy'])->name('selections.delete');
		Route::get('selections', [Selections::class,'index'])->name('selections');
		Route::get('detail_selections/{selection}', [DetailSelectionController::class,'show'])->name('detail_selections');
		

});
Route::group(['middleware'=>'auth'], function(){
	Route::resource('tasks', TaskController::class);
});


