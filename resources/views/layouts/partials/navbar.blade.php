<!-- Navbar Bersih & Selaras (Bootstrap 5.3) -->
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top">
  <div class="container">
    <!-- Brand / Logo Aplikasi (Hanya menggunakan Icon Booking) -->
    <a class="navbar-brand fw-bold text-dark d-flex align-items-center gap-2" href="{{ route('bookings.index') }}">
      <i class="bi bi-calendar-check-fill text-primary fs-5"></i>
      <span>Booking<span class="text-primary">App</span></span>
    </a>

    <!-- Tombol Toggler Mobile -->
    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Navigasi & Form Pencarian -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-lg-1">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('bookings.index') && !request()->has('status') && !request()->has('search') ? 'active' : '' }}" href="{{ route('bookings.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">Jadwal Booking</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->has('status') ? 'active text-primary fw-semibold' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if(request('status') == 'menunggu')
              Status: Menunggu
            @elseif(request('status') == 'selesai')
              Status: Selesai
            @elseif(request('status') == 'batal')
              Status: Batal
            @else
              Filter Status
            @endif
          </a>
          <ul class="dropdown-menu shadow-sm border-0 rounded-3">
            <li>
              <a class="dropdown-item {{ !request()->has('status') ? 'active fw-medium' : '' }}" href="{{ route('bookings.index') }}">
                Semua Jadwal
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item {{ request('status') == 'menunggu' ? 'active fw-medium' : '' }}" href="{{ route('bookings.index', array_merge(request()->query(), ['status' => 'menunggu'])) }}">
                <span class="badge text-bg-warning me-1">●</span> Menunggu
              </a>
            </li>
            <li>
              <a class="dropdown-item {{ request('status') == 'selesai' ? 'active fw-medium' : '' }}" href="{{ route('bookings.index', array_merge(request()->query(), ['status' => 'selesai'])) }}">
                <span class="badge text-bg-success me-1">●</span> Selesai
              </a>
            </li>
            <li>
              <a class="dropdown-item {{ request('status') == 'batal' ? 'active fw-medium' : '' }}" href="{{ route('bookings.index', array_merge(request()->query(), ['status' => 'batal'])) }}">
                <span class="badge text-bg-danger me-1">●</span> Batal
              </a>
            </li>
          </ul>
        </li>
      </ul>

      <!-- Form Pencarian Kanan Fungsional -->
      <form class="d-flex align-items-center" method="GET" action="{{ route('bookings.index') }}" role="search">
        @if(request('status'))
          <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        <div class="input-group input-group-sm" style="width: 240px;">
          <input class="form-control" type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama / no hp..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit" title="Cari Data">
            <i class="bi bi-search"></i>
          </button>
          @if(request('search'))
            <a href="{{ route('bookings.index', request()->only('status')) }}" class="btn btn-outline-secondary" title="Reset Pencarian">
              <i class="bi bi-x-lg"></i>
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>
</nav>
