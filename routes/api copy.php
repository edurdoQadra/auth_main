<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\DepartmentController;

// Rutas para el controlador EmployeeController
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);
Route::get('/employeesByDepartment', [EmployeeController::class, 'EmployeesByDepartament']);
Route::get('/employeesall', [EmployeeController::class, 'all']);

// Rutas para el controlador DepartmentController
Route::get('/departments', [DepartmentController::class, 'index']);
Route::post('/departments', [DepartmentController::class, 'store']);
Route::get('/departments/{department}', [DepartmentController::class, 'show']);
Route::put('/departments/{department}', [DepartmentController::class, 'update']);
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);
use App\Http\Controllers\YourController;

Route::middleware('auth:sanctum')->group(function () {

    // Agrega más rutas protegidas aquí...
});