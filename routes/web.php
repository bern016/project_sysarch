<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\DepartmentController;


Route::get('/', function () {
    return redirect()->route('colleges.index');
});

Route::put('/colleges/{id}', [CollegeController::class, 'update'])->name('colleges.update');
Route::get('/colleges/create', [CollegeController::class, 'create'])->name('colleges.create');
Route::get('/colleges/deleted', [CollegeController::class, 'deleted'])->name('colleges.deleted');
Route::get('colleges/{college}', [CollegeController::class, 'show'])->name('colleges.show');
Route::resource('colleges', CollegeController::class);
Route::put('colleges/{id}/restore', [CollegeController::class, 'restore'])->name('colleges.restore'); 
Route::delete('colleges/{id}/force-delete', [CollegeController::class, 'forceDelete'])->name('colleges.forceDelete'); 

Route::resource('departments', DepartmentController::class)->except(['show']);
Route::get('departments/deleted', [DepartmentController::class, 'deleted'])->name('departments.deleted');
Route::put('departments/{id}/restore', [DepartmentController::class, 'restore'])->name('departments.restore');
Route::delete('departments/{id}/force-delete', [DepartmentController::class, 'forceDelete'])->name('departments.forceDelete');
