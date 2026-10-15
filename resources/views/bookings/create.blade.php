@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width: 500px;">
    <h2>Formulir Booking Baru</h2>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf <!-- Wajib ada untuk keamanan CSRF Laravel -->
        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>No HP / WhatsApp</label>
            <input type="text" name="no_hp" required>
        </div>
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required>
        </div>
        <div class="form-group">
            <label>Jam</label>
            <input type="time" name="jam" required>
        </div>
        <div class="form-group">
            <label>Catatan (Opsional)</label>
            <textarea name="catatan" rows="3"></textarea>
        </div>
        <button type="submit">Simpan Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn-kembali">Batal</a>
    </form>
</div>
@endsection