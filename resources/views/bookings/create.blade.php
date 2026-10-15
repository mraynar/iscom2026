@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 mx-auto" style="max-width: 600px;">
    <!-- Navigasi Jejak Halaman (Breadcrumb) -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a class="breadcrumb-link text-decoration-none text-muted" href="{{ route('bookings.index') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a class="breadcrumb-link text-decoration-none text-muted" href="{{ route('bookings.index') }}">Daftar Booking</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Tambah Booking</li>
        </ol>
    </nav>

    <h4 class="fw-bold mb-4">Formulir Booking Baru</h4>

    <!-- Alert Notifikasi Tepat di Atas Form -->
    @include('layouts.partials.alerts')

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf <!-- Wajib ada untuk keamanan CSRF Laravel -->

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Pemesan" required>
            <label for="nama">Nama Pemesan</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="No HP / WhatsApp" required>
            <label for="no_hp">No HP / WhatsApp</label>
        </div>

        <div class="row g-2 mb-3">
            <div class="col-6">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" placeholder="Tanggal" required>
                    <label for="tanggal">Tanggal</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam') }}" placeholder="Jam" required>
                    <label for="jam">Jam</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan" style="height: 100px;">{{ old('catatan') }}</textarea>
            <label for="catatan">Catatan (Opsional)</label>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Simpan Booking</button>
            <a href="{{ route('bookings.index') }}" class="btn btn-light text-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection