<?php
/* Rutas para visualizar y descargar los documentos PDF de la información de los empleados y sus registros de incapacidades. */

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IncapacityController;
use Illuminate\Support\Facades\Route;

Route::get('/employees/{employee}/pdf', [EmployeeController::class, 'generatePDF'])->name('employees.pdf');

Route::get('/incapacities/{incapacity}/pdf', [IncapacityController::class, 'generatePDF'])
    ->name('incapacities.pdf');
