@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="max-width: 500px;">
    <h2>Edit Data Booking</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Mengubah request POST menjadi PUT untuk Update -->

        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="nama" value="{{ $booking->nama }}" required>
        </div>

        <div class="form-group">
            <label>No HP / WhatsApp</label>
            <input type="text" name="no_hp" value="{{ $booking->no_hp }}" required>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $booking->tanggal }}" required>
        </div>

        <div class="form-group">
            <label>Jam</label>
            <input type="time" name="jam" value="{{ substr($booking->jam, 0, 5) }}" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="menunggu" {{ $booking->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="selesai" {{ $booking->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ $booking->status == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>

        <div class="form-group">
            <label>Catatan (Opsional)</label>
            <textarea name="catatan" rows="3">{{ $booking->catatan }}</textarea>
        </div>

        <button type="submit">Update Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn-kembali">Batal</a>
    </form>
</div>
@endsection