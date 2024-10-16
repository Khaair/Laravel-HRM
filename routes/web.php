<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;



Route::get('/', function () {
    return view('dashboard');
});

Route::resource('categories', BlogCategoryController::class);
Route::resource('blogs', BlogController::class);

Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);


Route::get('/employees/department/{departmentId}', [EmployeeController::class, 'employeesByDepartment'])->name('employee.employees-by-department');


Route::resource('/attendances', AttendanceController::class);


Route::resource('products', ProductController::class);



Route::resource('inventory', InventoryController::class);



