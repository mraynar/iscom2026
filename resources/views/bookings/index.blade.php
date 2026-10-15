@extends('layouts.app')

@section('content')
<!-- Kontainer Utama Terpusat (Semua Elemen Pas Ditengah dan Sejajar Sempurna) -->
<div class="w-100 my-auto" style="max-width: 1060px;">

    <!-- 1. Header Dashboard & Navigasi Breadcrumb Fungsional -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1 text-dark">Dashboard</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="{{ route('bookings.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="breadcrumb-link" href="{{ route('bookings.index') }}">Dashboard</a>
                    </li>
                    @if(request('status'))
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link" href="{{ route('bookings.index') }}">Jadwal Booking</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Status: {{ ucfirst(request('status')) }}
                        </li>
                    @elseif(request('search'))
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link" href="{{ route('bookings.index') }}">Jadwal Booking</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Cari: "{{ request('search') }}"
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Booking</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div>
            <span class="badge bg-white text-secondary border px-3 py-2 shadow-sm rounded-3">
                {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    <!-- 2. Baris 4 KPI Cards Ringkasan Metrik Dinamis (Sejajar Lurus dengan Form Tabel) -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Booking -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="overflow-hidden">
                    <h4 class="kpi-value">{{ $totalBooking }}</h4>
                    <p class="kpi-label mb-0">Total Booking</p>
                </div>
            </div>
        </div>

        <!-- 2. Total Pelanggan -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="overflow-hidden">
                    <h4 class="kpi-value">{{ $totalPelanggan }}</h4>
                    <p class="kpi-label mb-0">Total Pelanggan</p>
                </div>
            </div>
        </div>

        <!-- 3. Booking Hari Ini -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="overflow-hidden">
                    <h4 class="kpi-value">{{ $bookingHariIni }}</h4>
                    <p class="kpi-label mb-0">Booking Hari Ini</p>
                </div>
            </div>
        </div>

        <!-- 4. Total Pendapatan (Wajib 1 Line) -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="overflow-hidden">
                    <h4 class="kpi-value-currency text-nowrap mb-0">{{ $totalPendapatan }}</h4>
                    <p class="kpi-label mb-0">Total Pendapatan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Pembungkus Kartu Tabel Utama (Ukuran Alami Presisi & Sejajar) -->
    <div class="card border-0 shadow-sm rounded-4 p-4 w-100" id="daftar-booking">
        <!-- Header Tabel & Tombol Tambah Data (Memicu Modal Tambah) -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <h4 class="fw-bold mb-0 text-dark">Daftar Booking</h4>
                @if(request('status') || request('search'))
                    <a href="{{ route('bookings.index') }}" class="badge bg-light text-secondary border text-decoration-none py-1 px-2 small">
                        Reset Filter
                    </a>
                @endif
            </div>
            
            <!-- Tombol Tambah Booking Memicu Modal Dialog -->
            <button type="button" class="btn btn-primary px-3 py-2" commandfor="createBookingDialog" command="show-modal">
                + Tambah Booking
            </button>
        </div>

        <!-- MODAL 1: Form Tambah Booking Baru (<dialog> Berukuran Seragam) -->
        <dialog class="dialog border-0" id="createBookingDialog">
            <form action="{{ route('bookings.store') }}" method="POST" class="dialog-container m-0">
                @csrf
                <!-- Header Dialog -->
                <div class="dialog-header d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-dark">Formulir Booking Baru</h5>
                    <button type="button" class="btn-close" commandfor="createBookingDialog" command="close" aria-label="Close"></button>
                </div>

                <!-- Body Dialog -->
                <div class="dialog-body text-start">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="create_nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Pemesan" required>
                        <label for="create_nama">Nama Pemesan</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="create_no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="No HP / WhatsApp" required>
                        <label for="create_no_hp">No HP / WhatsApp</label>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="create_tanggal" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" placeholder="Tanggal" required>
                                <label for="create_tanggal">Tanggal</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="create_jam" name="jam" value="{{ old('jam') }}" placeholder="Jam" required>
                                <label for="create_jam">Jam</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-2">
                        <textarea class="form-control" id="create_catatan" name="catatan" placeholder="Catatan" style="height: 100px;">{{ old('catatan') }}</textarea>
                        <label for="create_catatan">Catatan (Opsional)</label>
                    </div>
                </div>

                <!-- Footer Dialog -->
                <div class="dialog-footer d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light px-4" commandfor="createBookingDialog" command="close">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        Simpan Booking
                    </button>
                </div>
            </form>
        </dialog>

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
                        <td class="fw-medium">
                            <div class="d-flex align-items-center">
                                <div class="bg-light text-secondary rounded-circle d-flex align-items-center justify-content-center me-2 border" style="width: 32px; height: 32px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <span>{{ $booking->nama }}</span>
                            </div>
                        </td>
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
                            <!-- Tombol Detail (Memicu Modal Detail) -->
                            <button type="button" class="btn btn-success btn-sm me-1" commandfor="detailDialog-{{ $booking->id }}" command="show-modal">
                                Detail
                            </button>

                            <!-- MODAL 2: Detail Informasi Booking (<dialog> Berukuran Seragam) -->
                            <dialog class="dialog border-0" id="detailDialog-{{ $booking->id }}">
                                <div class="dialog-container text-start">
                                    <div class="dialog-header d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0 text-dark">Detail Informasi Booking</h5>
                                        <button type="button" class="btn-close" commandfor="detailDialog-{{ $booking->id }}" command="close" aria-label="Close"></button>
                                    </div>
                                    <div class="dialog-body py-2">
                                        <div class="row g-3 text-start align-items-center">
                                            <div class="col-5 text-secondary">Nama Pemesan</div>
                                            <div class="col-7 fw-bold text-dark">{{ $booking->nama }}</div>

                                            <div class="col-5 text-secondary">No HP / WhatsApp</div>
                                            <div class="col-7 fw-medium text-dark">{{ $booking->no_hp }}</div>

                                            <div class="col-5 text-secondary">Tanggal</div>
                                            <div class="col-7 fw-medium text-dark">{{ $booking->tanggal }}</div>

                                            <div class="col-5 text-secondary">Jam</div>
                                            <div class="col-7 fw-medium text-dark">{{ $booking->jam }}</div>

                                            <div class="col-5 text-secondary">Status</div>
                                            <div class="col-7">
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

                                            <div class="col-5 text-secondary">Catatan</div>
                                            <div class="col-7 text-dark">{{ $booking->catatan ?? '-' }}</div>
                                        </div>
                                    </div>
                                    <div class="dialog-footer d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary px-4" commandfor="detailDialog-{{ $booking->id }}" command="close">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </dialog>

                            <!-- Tombol Edit (Memicu Modal Edit) -->
                            <button type="button" class="btn btn-warning btn-sm text-dark me-1" commandfor="editDialog-{{ $booking->id }}" command="show-modal">
                                Edit
                            </button>

                            <!-- MODAL 3: Edit Data Booking (<dialog> Berukuran Seragam) -->
                            <dialog class="dialog border-0" id="editDialog-{{ $booking->id }}">
                                <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="dialog-container m-0">
                                    @csrf
                                    @method('PUT')
                                    <div class="dialog-header d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0 text-dark">Edit Data Booking</h5>
                                        <button type="button" class="btn-close" commandfor="editDialog-{{ $booking->id }}" command="close" aria-label="Close"></button>
                                    </div>
                                    <div class="dialog-body text-start">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="edit_nama_{{ $booking->id }}" name="nama" value="{{ old('nama', $booking->nama) }}" placeholder="Nama Pemesan" required>
                                            <label for="edit_nama_{{ $booking->id }}">Nama Pemesan</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="edit_no_hp_{{ $booking->id }}" name="no_hp" value="{{ old('no_hp', $booking->no_hp) }}" placeholder="No HP / WhatsApp" required>
                                            <label for="edit_no_hp_{{ $booking->id }}">No HP / WhatsApp</label>
                                        </div>

                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="edit_tanggal_{{ $booking->id }}" name="tanggal" value="{{ old('tanggal', $booking->tanggal) }}" placeholder="Tanggal" required>
                                                    <label for="edit_tanggal_{{ $booking->id }}">Tanggal</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="time" class="form-control" id="edit_jam_{{ $booking->id }}" name="jam" value="{{ old('jam', substr($booking->jam, 0, 5)) }}" placeholder="Jam" required>
                                                    <label for="edit_jam_{{ $booking->id }}">Jam</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="edit_status_{{ $booking->id }}" name="status" aria-label="Status Booking">
                                                <option value="menunggu" {{ old('status', $booking->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="selesai" {{ old('status', $booking->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="batal" {{ old('status', $booking->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                            <label for="edit_status_{{ $booking->id }}">Status Booking</label>
                                        </div>

                                        <div class="form-floating mb-2">
                                            <textarea class="form-control" id="edit_catatan_{{ $booking->id }}" name="catatan" placeholder="Catatan" style="height: 90px;">{{ old('catatan', $booking->catatan) }}</textarea>
                                            <label for="edit_catatan_{{ $booking->id }}">Catatan (Opsional)</label>
                                        </div>
                                    </div>
                                    <div class="dialog-footer d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-light px-4" commandfor="editDialog-{{ $booking->id }}" command="close">
                                            Batal
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            Update Booking
                                        </button>
                                    </div>
                                </form>
                            </dialog>
                            
                            <!-- Tombol Hapus (Memicu Modal Konfirmasi Hapus) -->
                            <button type="button" class="btn btn-danger btn-sm" commandfor="deleteDialog-{{ $booking->id }}" command="show-modal">
                                Hapus
                            </button>

                            <!-- MODAL 4: Konfirmasi Hapus Data (<dialog> Berukuran Seragam) -->
                            <dialog class="dialog border-0" id="deleteDialog-{{ $booking->id }}">
                                <div class="dialog-container text-center">
                                    <div class="dialog-header d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-0 text-dark">Konfirmasi Hapus Data</h5>
                                        <button type="button" class="btn-close" commandfor="deleteDialog-{{ $booking->id }}" command="close" aria-label="Close"></button>
                                    </div>
                                    <div class="dialog-body d-flex flex-column justify-content-center align-items-center py-4">
                                        <h5 class="fw-bold mb-2">Hapus Data Pemesan?</h5>
                                        <p class="text-muted mb-0 px-3">
                                            Apakah Anda yakin ingin menghapus data booking pemesan <strong>"{{ $booking->nama }}"</strong>? Tindakan ini tidak dapat dibatalkan.
                                        </p>
                                    </div>
                                    <div class="dialog-footer d-flex justify-content-center gap-2">
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
                                </div>
                            </dialog>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            Belum ada data booking yang sesuai.
                        </td>
                    </tr>
                    @endforelse

                    {{-- Penyeimbang Tinggi Baris: Menjaga ukuran tabel data di bawah 5 tetap presisi seukuran tabel 5 data tanpa menambah ruang kosong berlebih --}}
                    @if($bookings->count() > 0 && $bookings->count() < 5)
                        @for($i = $bookings->count(); $i < 5; $i++)
                        <tr class="placeholder-row" style="visibility: hidden; pointer-events: none; user-select: none;">
                            <td>&nbsp;</td>
                            <td class="text-secondary">&nbsp;</td>
                            <td class="text-secondary">&nbsp;</td>
                            <td class="text-secondary">&nbsp;</td>
                            <td>
                                <span class="badge px-3 py-2">&nbsp;</span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm me-1">&nbsp;</button>
                                <button type="button" class="btn btn-sm me-1">&nbsp;</button>
                                <button type="button" class="btn btn-sm">&nbsp;</button>
                            </td>
                        </tr>
                        @endfor
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Komponen Pagination Bootstrap 5 Terintegrasi dengan Laravel Eloquent -->
        <div class="mt-3 pt-3 border-top">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection