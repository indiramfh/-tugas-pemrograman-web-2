<x-app>
    <x-slot:title>Data Karyawan</x-slot:title>

    @if (session('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <a class="btn btn-primary mb-3" href="{{ route('employees.create') }}" role="button">Tambah Karyawan</a>

    <div class="table-responsive">
        <table class="table table-bordered border-dark table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Departemen</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                    <tr>
                        <th scope="row">{{ $employees->firstItem() + $loop->index }}</th>
                        <td>{{ $employee->employee_number }}</td>
                        <td>
                            <div class="fw-semibold">{{ $employee->name }}</div>
                            @if ($employee->email)
                                <small class="text-body-secondary">{{ $employee->email }}</small>
                            @endif
                        </td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->employment_status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-body-secondary">Belum ada data karyawan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $employees->links('pagination::bootstrap-5') }}
</x-app>