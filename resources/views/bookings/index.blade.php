@extends('layouts.app')

@section('content')
<!-- Pembungkus Kartu Putih Bersih SaaS Modern -->
<div class="card border-0 shadow-sm rounded-4 p-4">
    <!-- Header Halaman & Tombol Tambah Data -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Daftar Jadwal Booking</h4>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">+ Tambah Booking</a>
    </div>

    <!-- Alert Notifikasi Tepat di Atas Tabel -->
    @include('layouts.partials.alerts')

    <!-- Tabel Data Booking (Bootstrap 5.3: Striped, Hover, Borderless) -->
    <div class="table-responsive">
        <table class="table table-hover table-striped table-borderless align-middle mb-0">
            <thead>
                <tr class="border-bottom">
                    <th scope="col" class="py-3">Nama Pemesan</th>
                    <th scope="col" class="py-3">No HP</th>
                    <th scope="col" class="py-3">Tanggal</th>
                    <th scope="col" class="py-3">Jam</th>
                    <th scope="col" class="py-3">Status</th>
                    <th scope="col" class="py-3 text-center" style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td class="fw-medium text-dark">{{ $booking->nama }}</td>
                    <td class="text-secondary">{{ $booking->no_hp }}</td>
                    <td class="text-secondary">{{ $booking->tanggal }}</td>
                    <td class="text-secondary">{{ $booking->jam }}</td>
                    <td>
                        @if($booking->status == 'menunggu')
                            <span class="badge text-bg-warning px-3 py-2">Menunggu</span>
                        @elseif($booking->status == 'selesai')
                            <span class="badge text-bg-success px-3 py-2">Selesai</span>
                        @elseif($booking->status == 'batal')
                            <span class="badge text-bg-danger px-3 py-2">Batal</span>
                        @else
                            <span class="badge text-bg-secondary px-3 py-2">{{ ucfirst($booking->status) }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Tombol Pemicu Modal Dialog Detail -->
                        <button type="button" class="btn btn-success btn-sm me-1" commandfor="detailDialog-{{ $booking->id }}" command="show-modal">
                            Detail
                        </button>

                        <!-- Modal Detail Informasi Booking (<dialog>) -->
                        <dialog class="dialog border-0 shadow-lg rounded-4 p-4 text-start" id="detailDialog-{{ $booking->id }}">
                            <div class="dialog-header d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <h5 class="fw-bold mb-0 text-dark">Detail Informasi Booking</h5>
                                <button type="button" class="btn-close" commandfor="detailDialog-{{ $booking->id }}" command="close" aria-label="Close"></button>
                            </div>
                            <div class="dialog-body pb-3">
                                <div class="bg-light p-3 rounded-3 mb-2">
                                    <div class="row g-2 text-start">
                                        <div class="col-4 text-muted small">Nama Pemesan</div>
                                        <div class="col-8 fw-semibold text-dark">{{ $booking->nama }}</div>

                                        <div class="col-4 text-muted small">No HP / WhatsApp</div>
                                        <div class="col-8 fw-medium text-dark">{{ $booking->no_hp }}</div>

                                        <div class="col-4 text-muted small">Tanggal</div>
                                        <div class="col-8 fw-medium text-dark">{{ $booking->tanggal }}</div>

                                        <div class="col-4 text-muted small">Jam</div>
                                        <div class="col-8 fw-medium text-dark">{{ $booking->jam }}</div>

                                        <div class="col-4 text-muted small">Status</div>
                                        <div class="col-8">
                                            @if($booking->status == 'menunggu')
                                                <span class="badge text-bg-warning px-3 py-1">Menunggu</span>
                                            @elseif($booking->status == 'selesai')
                                                <span class="badge text-bg-success px-3 py-1">Selesai</span>
                                            @elseif($booking->status == 'batal')
                                                <span class="badge text-bg-danger px-3 py-1">Batal</span>
                                            @else
                                                <span class="badge text-bg-secondary px-3 py-1">{{ ucfirst($booking->status) }}</span>
                                            @endif
                                        </div>

                                        <div class="col-4 text-muted small">Catatan</div>
                                        <div class="col-8 text-dark">{{ $booking->catatan ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="dialog-footer d-flex justify-content-end pt-2">
                                <button type="button" class="btn btn-secondary px-4" commandfor="detailDialog-{{ $booking->id }}" command="close">
                                    Tutup
                                </button>
                            </div>
                        </dialog>

                        <!-- Tombol Edit -->
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm text-dark me-1">Edit</a>
                        
                        <!-- Tombol Pemicu Modal Dialog Hapus -->
                        <button type="button" class="btn btn-danger btn-sm" commandfor="deleteDialog-{{ $booking->id }}" command="show-modal">
                            Hapus
                        </button>

                        <!-- Modal Konfirmasi Hapus Modern (<dialog>) -->
                        <dialog class="dialog border-0 shadow-lg rounded-4 p-4 text-center" id="deleteDialog-{{ $booking->id }}">
                            <div class="dialog-header d-flex justify-content-end mb-1">
                                <button type="button" class="btn-close" commandfor="deleteDialog-{{ $booking->id }}" command="close" aria-label="Close"></button>
                            </div>
                            <div class="dialog-body pb-3">
                                <i class="bi bi-exclamation-circle text-warning display-5 mb-3 d-block"></i>
                                <h5 class="fw-bold mb-2">Konfirmasi Hapus Data</h5>
                                <p class="text-muted mb-0">
                                    Apakah Anda yakin ingin menghapus data pemesan <strong>"{{ $booking->nama }}"</strong>? Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                            <div class="dialog-footer d-flex justify-content-center gap-2 pt-2">
                                <button type="button" class="btn btn-light px-4" commandfor="deleteDialog-{{ $booking->id }}" command="close">
                                    Batal
                                </button>
                                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger px-4">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </dialog>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data booking.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Komponen Pagination Bootstrap 5 Terintegrasi dengan Laravel Eloquent -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $bookings->links() }}
    </div>
</div>
@endsection