<div class="mb-3">
    <label for="employee_number" class="form-label">NIP</label>
    <input type="text" class="form-control @error('employee_number') is-invalid @enderror" id="employee_number"
        name="employee_number" value="{{ old('employee_number', $employee?->employee_number) }}" required>
    @error('employee_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Nama lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $employee?->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email', $employee?->email) }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="phone" class="form-label">Nomor telepon</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
            value="{{ old('phone', $employee?->phone) }}">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="position" class="form-label">Jabatan</label>
        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position"
            value="{{ old('position', $employee?->position) }}" required>
        @error('position')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="department" class="form-label">Departemen</label>
        <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department"
            value="{{ old('department', $employee?->department) }}" required>
        @error('department')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="employment_status" class="form-label">Status karyawan</label>
        <select class="form-select @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status" required>
            <option value="">Pilih status</option>
            @foreach (['Aktif', 'Kontrak', 'Masa Percobaan', 'Nonaktif'] as $status)
                <option value="{{ $status }}" @selected(old('employment_status', $employee?->employment_status) === $status)>{{ $status }}</option>
            @endforeach
        </select>
        @error('employment_status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="joined_at" class="form-label">Tanggal masuk</label>
    <input type="date" class="form-control @error('joined_at') is-invalid @enderror" id="joined_at" name="joined_at"
        value="{{ old('joined_at', $employee?->joined_at?->format('Y-m-d')) }}" required>
    @error('joined_at')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>