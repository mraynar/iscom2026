<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // 1. Tampilkan semua data booking dengan pagination dan KPI metrik
    public function index()
    {
        $bookings = Booking::latest()->paginate(5);

        // Data Dinamis untuk 4 KPI Cards
        $totalBooking = Booking::count();
        $totalPelanggan = Booking::distinct('no_hp')->count('no_hp');
        $bookingHariIni = Booking::whereDate('tanggal', now()->toDateString())->count();
        $bookingSelesai = Booking::where('status', 'selesai')->count();
        $bookingMenunggu = Booking::where('status', 'menunggu')->count();
        $totalPendapatan = 'Rp '.number_format($totalBooking * 250000, 0, ',', '.');

        return view('bookings.index', compact(
            'bookings',
            'totalBooking',
            'totalPelanggan',
            'bookingHariIni',
            'bookingSelesai',
            'bookingMenunggu',
            'totalPendapatan'
        ));
    }

    // 2. Tampilkan form tambah booking
    public function create()
    {
        return view('bookings.create');
    }

    // 3. Simpan booking baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'catatan' => 'nullable|string',
        ]);

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat!');
    }

    // 4. Tampilkan form edit booking
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    // 5. Simpan perubahan edit ke database
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'status' => 'required|in:menunggu,selesai,batal',
            'catatan' => 'nullable|string',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Data booking berhasil diperbarui!');
    }

    // 6. Hapus data booking
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }
}
