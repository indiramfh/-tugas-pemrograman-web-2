<x-app>
    <x-slot:title>Tambah Karyawan</x-slot:title>

    <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        @include('employees._form', ['employee' => null])

        <a class="btn btn-warning" href="{{ route('employees.index') }}" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</x-app>