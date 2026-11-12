<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/employees');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
