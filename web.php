<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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

Route::get('employee',[EmployeeController::class, 'index'])->name('employee');
Route::post('emplpoyee/store',[EmployeeController::class,'store'])->name('store');
Route::get('emplpoyee/edit',[EmployeeController::class,'edit'])->name('edit');
Route::post('emplpoyee/update',[EmployeeController::class,'update'])->name('update');
Route::post('emplpoyee/delete',[EmployeeController::class,'delete'])->name('delete');
