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
          <a class="nav-link" href="{{ route('bookings.index') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('bookings.index') }}">Jadwal Booking</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filter Status
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('bookings.index') }}">Semua Jadwal</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Menunggu</a></li>
            <li><a class="dropdown-item" href="#">Selesai</a></li>
            <li><a class="dropdown-item" href="#">Batal</a></li>
          </ul>
        </li>
      </ul>

      <!-- Form Pencarian Kanan -->
      <form class="d-flex align-items-center" role="search" onsubmit="event.preventDefault();">
        <div class="input-group input-group-sm" style="width: 220px;">
          <input class="form-control" type="search" placeholder="Cari pemesan..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>
</nav>
