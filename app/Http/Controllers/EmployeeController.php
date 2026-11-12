<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(): View
    {
        return view('employees.index', [
            'employees' => Employee::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Employee::create($this->validatedData($request));

        return to_route('employees.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee): View
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $employee->update($this->validatedData($request, $employee));

        return to_route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    private function validatedData(Request $request, ?Employee $employee = null): array
    {
        return $request->validate([
            'employee_number' => ['required', 'string', 'max:30', Rule::unique('employees')->ignore($employee?->getKey())],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'position' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'employment_status' => ['required', Rule::in(['Aktif', 'Kontrak', 'Masa Percobaan', 'Nonaktif'])],
            'joined_at' => ['required', 'date'],
        ], [
            'employee_number.required' => 'NIP wajib diisi.',
            'employee_number.unique' => 'NIP sudah digunakan.',
            'name.required' => 'Nama karyawan wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'position.required' => 'Jabatan wajib diisi.',
            'department.required' => 'Departemen wajib diisi.',
            'employment_status.required' => 'Status karyawan wajib dipilih.',
            'joined_at.required' => 'Tanggal masuk wajib diisi.',
            'joined_at.date' => 'Tanggal masuk tidak valid.',
        ]);
    }
}