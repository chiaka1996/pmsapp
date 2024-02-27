<?php


use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::name('admin.')->middleware(['auth'])->group(function (){
    Route::get('/users', [UserController::class, 'create']);
    Route::get('states', [StateController::class, 'index']);
    Route::resource('companies', CompanyController::class);
    Route::resource('sites', SiteController::class);
});

