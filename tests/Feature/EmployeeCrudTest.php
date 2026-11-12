<?php

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function employeePayload(array $overrides = []): array
{
    return array_merge([
        'employee_number' => 'EMP-001',
        'name' => 'Siti Aminah',
        'email' => 'siti@example.test',
        'phone' => '08123456789',
        'position' => 'Analis Data',
        'department' => 'Operasional',
        'employment_status' => 'Aktif',
        'joined_at' => '2024-06-15',
    ], $overrides);
}

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

test('a new employee can be added from the form', function () {
    $this->get(route('employees.create'))
        ->assertOk()
        ->assertSee('Tambah Karyawan');

    $this->post(route('employees.store'), employeePayload())
        ->assertRedirect(route('employees.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('employees', [
        'employee_number' => 'EMP-001',
        'name' => 'Siti Aminah',
    ]);
});

test('duplicate employee numbers are rejected', function () {
    Employee::factory()->create(['employee_number' => 'EMP-001']);

    $this->from(route('employees.create'))
        ->post(route('employees.store'), employeePayload())
        ->assertSessionHasErrors('employee_number');
});

test('an employee can be updated from the edit form', function () {
    $employee = Employee::factory()->create(['employee_number' => 'EMP-002']);

    $this->get(route('employees.index'))
        ->assertOk()
        ->assertSee('Edit');

    $this->get(route('employees.edit', $employee))
        ->assertOk()
        ->assertSee('Edit Karyawan');

    $this->put(route('employees.update', $employee), employeePayload([
        'employee_number' => 'EMP-002',
        'name' => 'Siti Aminah Putri',
    ]))
        ->assertRedirect(route('employees.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('employees', [
        'id' => $employee->id,
        'employee_number' => 'EMP-002',
        'name' => 'Siti Aminah Putri',
    ]);
});

test('an employee cannot take another employee number', function () {
    $employee = Employee::factory()->create(['employee_number' => 'EMP-002']);
    Employee::factory()->create(['employee_number' => 'EMP-003']);

    $this->put(route('employees.update', $employee), employeePayload([
        'employee_number' => 'EMP-003',
    ]))
        ->assertSessionHasErrors('employee_number');
});

test('an employee can be deleted from the list', function () {
    $employee = Employee::factory()->create();

    $this->get(route('employees.index'))
        ->assertOk()
        ->assertSee('Hapus');

    $this->delete(route('employees.destroy', $employee))
        ->assertRedirect(route('employees.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
});