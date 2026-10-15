@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Daftar Jadwal Booking</h2>
    <div>
        <a href="{{ route('bookings.create') }}" class="btn btn-tambah">+ Tambah Booking</a>
    </div>

    <!-- Pesan Sukses -->
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th style="white-space: nowrap;">No HP</th>
                <th style="white-space: nowrap;">Tanggal</th>
                <th style="white-space: nowrap;">Jam</th>
                <th>Status</th>
                <th style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td style="white-space: nowrap;">{{ $booking->nama }}</td>
                <td style="white-space: nowrap;">{{ $booking->no_hp }}</td>
                <td style="white-space: nowrap;">{{ $booking->tanggal }}</td>
                <td style="white-space: nowrap;">{{ $booking->jam }}</td>
                <td><b>{{ $booking->status }}</b></td>
                <td style="white-space: nowrap;">
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-edit">Edit</a>
                    
                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-hapus">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Belum ada data booking.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection