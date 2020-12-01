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

Route::get('/test', [StudyController::class, 'test']);

Route::get('study', [StudyController::class, 'index'])->name('study');
Route::get('api/study/get', [StudyController::class, 'get']);
Route::get('api/study/get/{name}', [StudyController::class, 'search']);
Route::post('api/study/create', [StudyController::class, 'create']);
Route::put('api/study/{id}', [StudyController::class, 'update']);
Route::delete('api/study/{id}', [StudyController::class, 'delete']);

Route::get('school', [SchoolController::class, 'index'])->name('school');
Route::get('api/school/get', [SchoolController::class, 'get']);
Route::post('api/school/create', [SchoolController::class, 'create']);
Route::put('api/school/{id}', [SchoolController::class, 'update']);
Route::delete('api/school/{id}', [SchoolController::class, 'delete']);

Route::get('bugdet', [BudgetController::class, 'index'])->name('budget');
Route::get('api/bugdet/get', [BudgetController::class, 'get']);
Route::post('api/bugdet/create', [BudgetController::class, 'create']);
Route::put('api/bugdet/{id}', [BudgetController::class, 'update']);
Route::delete('api/bugdet/{id}', [BudgetController::class, 'delete']);

Route::get('organization', [OrganizationController::class, 'index'])->name('organization');
Route::get('api/organization/get', [OrganizationController::class, 'get']);
Route::post('api/organization/create', [OrganizationController::class, 'create']);
Route::put('api/organization/{id}', [OrganizationController::class, 'update']);
Route::delete('api/organization/{id}', [OrganizationController::class, 'delete']);
