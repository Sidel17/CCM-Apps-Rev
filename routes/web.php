<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ComponentDetailController;
use App\Http\Controllers\GroupComponentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusunitController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitModelsController;

Route::get('/', function () {
    return view('welcome');
});

//User
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware(['auth', 'user'])->group(function()
{
    Route::get('/get-brand-model/{unit_id}', [ReportController::class, 'getBrandAndModel']);
    Route::get('/get-component-details/{groupcomponent_id}', [ReportController::class, 'getComponentDetails']);
    Route::resource('/user/reports', ReportController::class);
    Route::get('/user/report/{id}', [ReportController::class, 'show']);
});


//Admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::middleware(['auth', 'admin'])->group(function()
{
    // Route::get('/admin/brands',[BrandsController::class, 'index'])->name('admin.brands');
    Route::resource('/admin/brands', BrandsController::class);
    Route::resource('/admin/unitmodels', UnitModelsController::class);
    Route::resource('/admin/locations', LocationController::class);
    Route::resource('/admin/statusunits', StatusunitController::class);
    Route::resource('/admin/manpowers', ManpowerController::class);
    Route::resource('/admin/units', UnitController::class);
    Route::get('/get-unitmodels/{brand_id}', [UnitController::class, 'getUnitModels']);
    Route::resource('/admin/groupcomponent', GroupComponentController::class);
    Route::resource('/admin/componentdetail', ComponentDetailController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
