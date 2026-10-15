@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 mx-auto" style="max-width: 600px;">
    <h4 class="fw-bold mb-4">Edit Data Booking</h4>

    <!-- Alert Notifikasi Tepat di Atas Form -->
    @include('layouts.partials.alerts')

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Mengubah request POST menjadi PUT untuk Update -->

        <div class="mb-3">
            <label for="nama" class="form-label fw-semibold">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $booking->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label fw-semibold">No HP / WhatsApp</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $booking->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label fw-semibold">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $booking->tanggal) }}" required>
        </div>

        <div class="mb-3">
            <label for="jam" class="form-label fw-semibold">Jam</label>
            <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam', substr($booking->jam, 0, 5)) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label fw-semibold">Status Booking</label>
            <select class="form-select" id="status" name="status">
                <option value="menunggu" {{ old('status', $booking->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="selesai" {{ old('status', $booking->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ old('status', $booking->status) == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label fw-semibold">Catatan (Opsional)</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan', $booking->catatan) }}</textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Update Booking</button>
            <a href="{{ route('bookings.index') }}" class="btn btn-light text-secondary ms-2">Batal</a>
        </div>
    </form>
</div>
@endsection