<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\BudgetController;

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

Route::get('/', function(){
    return redirect()->route('study');
});

Route::get('study', [StudyController::class, 'index'])->name('study');
Route::get('api/study/get', [StudyController::class, 'get']);
Route::get('api/study/get/{name}', [StudyController::class, 'search']);
Route::post('api/study/create', [StudyController::class, 'create']);
Route::put('api/study/{id}', [StudyController::class, 'update']);
Route::delete('api/study/{id}', [StudyController::class, 'delete']);

Route::get('school', [SchoolController::class, 'index'])->name('school');

Route::get('bugdet', [BudgetController::class, 'index'])->name('budget');

Route::get('organization', [OrganizationController::class, 'index'])->name('organization');

