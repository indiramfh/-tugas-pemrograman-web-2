<?php

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('employee factory creates a valid employee', function () {
    $employee = Employee::factory()->create();

    $this->assertModelExists($employee);
});

test('employee list shows saved employee details', function () {
    $employee = Employee::factory()->create([
        'employee_number' => 'EMP-100',
        'name' => 'Siti Aminah',
    ]);

    $this->get(route('employees.index'))
        ->assertOk()
        ->assertSee($employee->employee_number)
        ->assertSee($employee->name)
        ->assertSee($employee->position);
});