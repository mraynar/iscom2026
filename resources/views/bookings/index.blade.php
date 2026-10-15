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
                        <a class="breadcrumb-link text-decoration-none text-muted" href="{{ route('bookings.index') }}">Home</a>
                    </li>
                    @if(request('status') || request('search'))
                        <li class="breadcrumb-item">
                            <a class="breadcrumb-link text-decoration-none text-muted" href="{{ route('bookings.index') }}">Daftar Booking</a>
                        </li>
                        @if(request('status'))
                            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">
                                Filter: {{ ucfirst(request('status')) }}
                            </li>
                        @endif
                        @if(request('search'))
                            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">
                                Cari: "{{ request('search') }}"
                            </li>
                        @endif
                    @else
                        <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">Daftar Booking</li>
                    @endif
                </ol>
            </nav>
        </div>
        <div>
            <span class="badge bg-white text-secondary border px-3 py-2 shadow-sm rounded-3">
                <i class="bi bi-calendar3 me-1 text-primary"></i> {{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </div>

    <!-- 2. Baris 4 KPI Cards Ringkasan Metrik Dinamis (Sejajar Lurus dengan Form Tabel) -->
    <div class="row g-3 mb-4">
        <!-- 1. Total Booking -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon-box" style="background-color: #eef2ff; color: #4f46e5;">
                        <i class="bi bi-calendar3 fs-4"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="kpi-value">{{ $totalBooking }}</h4>
                        <p class="kpi-label">Total Booking</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Pelanggan -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon-box" style="background-color: #fee2e2; color: #ef4444;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="kpi-value">{{ $totalPelanggan }}</h4>
                        <p class="kpi-label">Total Pelanggan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Booking Hari Ini -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon-box" style="background-color: #dcfce7; color: #16a34a;">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="kpi-value">{{ $bookingHariIni }}</h4>
                        <p class="kpi-label">Booking Hari Ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Total Pendapatan (Wajib 1 Line) -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card card-kpi border-0 shadow-sm h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="kpi-icon-box" style="background-color: #fef3c7; color: #d97706;">
                        <i class="bi bi-currency-dollar fs-4"></i>
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="kpi-value-currency text-nowrap">{{ $totalPendapatan }}</h4>
                        <p class="kpi-label">Total Pendapatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Pembungkus Kartu Tabel Utama (Ukuran Konsisten & Tetap Sama pada Data < 5 Maupun 5 Data) -->
    <div class="card border-0 shadow-sm rounded-4 p-4 w-100 d-flex flex-column" style="min-height: 580px;">
        <!-- Header Tabel & Tombol Tambah Data -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <h4 class="fw-bold mb-0 text-dark">Daftar Booking</h4>
                @if(request('status') || request('search'))
                    <a href="{{ route('bookings.index') }}" class="badge bg-light text-secondary border text-decoration-none py-1 px-2 small">
                        Reset Filter <i class="bi bi-x-circle ms-1"></i>
                    </a>
                @endif
            </div>
            <a href="{{ route('bookings.create') }}" class="btn btn-primary px-3 py-2">+ Tambah Booking</a>
        </div>

        <!-- Alert Notifikasi Tepat di Atas Tabel -->
        @include('layouts.partials.alerts')

        <!-- Tabel Data Booking (Bootstrap 5.3: Striped, Hover, Borderless) dengan Min-Height Konsisten -->
        <div class="table-responsive flex-grow-1" style="min-height: 380px;">
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            Belum ada data booking yang sesuai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Komponen Pagination Bootstrap 5 Terintegrasi dengan Laravel Eloquent (Selalu Terkunci Rapi di Bawah) -->
        <div class="mt-auto pt-3 border-top">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection