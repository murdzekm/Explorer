<?php

use App\Http\Controllers\ExplorerController;
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

//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', [ExplorerController::class, 'index'])->name('explorer.index');

Route::post('/store', [ExplorerController::class, 'store'])->name('explorer.store');
Route::put('/update', [ExplorerController::class, 'updateName'])->name('explorer.update');
Route::put('/move', [ExplorerController::class, 'move'])->name('explorer.move');
Route::delete('/delete', [ExplorerController::class, 'delete'])->name('explorer.delete');
