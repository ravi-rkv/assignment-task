<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Carbon\Carbon;

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

Route::get('/', [TaskController::class, 'index'])->name('index');
Route::post('/uploadBulkFile', [TaskController::class, 'uploadBulkFile'])->name('uploadBulkFile');
Route::get('/downloadAllData', [TaskController::class, 'downloadAllData']);

Route::get('/addSingle', [TaskController::class, 'addSingleDataView'])->name('addSingle');


Route::post('/addData', [TaskController::class, 'addData'])->name('addData');
Route::get('/editData/{index}', [TaskController::class, 'editData'])->name('editData');
Route::post('/updateData/{index}', [TaskController::class, 'updateData'])->name('updateData');
Route::delete('/deleteData{index}', [TaskController::class, 'deleteData'])->name('deleteData');

Route::post('/finalSubmit', [TaskController::class, 'finalSubmit'])->name('finalSubmit');
