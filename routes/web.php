<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DepartmentController;

Route::get('/', function () {
    return redirect()->route('colleges.index');
});

// College Routes
Route::get('colleges/search', [CollegeController::class, 'search'])->name('colleges.search');
Route::get('/colleges/deleted', [CollegeController::class, 'deleted'])->name('colleges.deleted');
Route::put('colleges/{college}/restore', [CollegeController::class, 'restore'])->name('colleges.restore');
Route::delete('colleges/{college}/force-delete', [CollegeController::class, 'forceDelete'])->name('colleges.forceDelete');

Route::resource('colleges', CollegeController::class)->except(['show']);
Route::get('colleges/{college}', [CollegeController::class, 'show'])->name('colleges.show');

// Department Routes
Route::resource('departments', DepartmentController::class)->except(['show']);
Route::get('departments/deleted', [DepartmentController::class, 'deleted'])->name('departments.deleted');
Route::put('departments/{department}/restore', [DepartmentController::class, 'restore'])->name('departments.restore');
Route::delete('departments/{department}/force-delete', [DepartmentController::class, 'forceDelete'])->name('departments.forceDelete');
