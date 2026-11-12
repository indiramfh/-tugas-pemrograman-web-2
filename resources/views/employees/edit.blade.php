<x-app>
    <x-slot:title>Edit Karyawan</x-slot:title>

    <form method="POST" action="{{ route('employees.update', $employee) }}">
        @csrf
        @method('PUT')
        @include('employees._form')

        <a class="btn btn-warning" href="{{ route('employees.index') }}" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</x-app>