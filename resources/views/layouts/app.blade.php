<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Booking</title>

    <!-- Bootstrap 5.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* CSS Dasar Materi Peserta & Posisi Tengah */
        body {
            font-family: sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Styling Navbar yang Selaras & Elegan */
        .navbar {
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
        }
        .navbar-brand {
            font-size: 1.15rem;
            letter-spacing: -0.2px;
        }
        .navbar-nav .nav-link,
        .navbar-nav .nav-link:visited {
            font-size: 14.5px;
            font-weight: 500;
            color: #64748b !important;
            padding: 0.5rem 0.85rem;
            transition: color 0.15s ease-in-out;
            text-decoration: none;
        }
        .navbar-nav .nav-link:hover {
            color: #0d6efd !important;
        }
        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link.active:visited {
            color: #0d6efd !important;
            font-weight: 600;
        }

        /* Styling Breadcrumb Elegan & Bebas Warna Ungu */
        .breadcrumb-item a,
        .breadcrumb-item a:visited {
            color: #64748b !important;
            text-decoration: none;
            transition: color 0.15s ease-in-out;
        }
        .breadcrumb-item a:hover {
            color: #0d6efd !important;
            text-decoration: underline;
        }
        .breadcrumb-item.active {
            color: #475569 !important;
            font-weight: 500;
        }
        .dropdown-menu {
            font-size: 14px;
            border: 1px solid #e9ecef;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
            padding: 6px;
        }
        .dropdown-item {
            border-radius: 4px;
            padding: 6px 12px;
        }
        .dropdown-item:hover {
            background-color: #f1f5f9;
        }

        /* Kontainer Utama Ditengah secara Vertikal & Horizontal */
        main.container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        /* Kotak Card Tabel & Form */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
            border: none;
            box-sizing: border-box;
        }

        .card:has(.form-group) {
            max-width: 600px;
            margin: auto;
            padding: 24px;
        }

        /* Modern SaaS KPI Cards */
        .card-kpi {
            padding: 18px 20px !important;
            border-radius: 16px !important;
            border: 1px solid #f1f5f9 !important;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            background: white;
        }
        .card-kpi:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.06) !important;
        }
        .kpi-icon-box {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .kpi-value {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1px;
            line-height: 1.2;
            white-space: nowrap !important;
        }
        .kpi-value-currency {
            font-size: 1.15rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1px;
            line-height: 1.2;
            white-space: nowrap !important;
            letter-spacing: -0.3px;
        }
        .kpi-label {
            font-size: 0.8125rem;
            color: #64748b;
            font-weight: 500;
            margin: 0;
            white-space: nowrap !important;
        }

        /* Style Tabel Legacy (hanya berlaku jika tidak memakai class .table Bootstrap) */
        table:not(.table) { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table:not(.table) th, table:not(.table) td { border: 1px solid #ddd !important; padding: 10px !important; text-align: left; }
        table:not(.table) th { background-color: #f2f2f2 !important; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; font-size: 14px; }
        .btn-tambah { background: #007bff !important; color: white !important; margin-bottom: 15px; }
        .btn-edit { background: #ffc107 !important; color: black !important; }
        .btn-hapus { background: #dc3545 !important; color: white !important; border: none !important; cursor: pointer; padding: 6px 12px !important; border-radius: 4px !important; }
        .alert:not([class*="alert-"]) { background: #d4edda !important; color: #155724 !important; padding: 10px !important; margin-bottom: 15px !important; border-radius: 4px !important; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        .card form input:not(.form-control):not([type="checkbox"]):not([type="radio"]),
        .card form select:not(.form-select):not(.form-control),
        .card form textarea:not(.form-control) { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .card form > button[type="submit"]:not(.btn) { background: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        .card form:has(input[value="PUT"]) > button[type="submit"]:not(.btn) { background: #ffc107; color: black; padding: 9px 16px; font-weight: bold; }
        .btn-kembali { color: #666; text-decoration: none; margin-left: 10px; }

        /* Modern Native HTML Dialog - Ukuran Lebar & Tinggi Seragam (520px x 580px) */
        dialog {
            width: 95%;
            max-width: 520px;
            height: 580px;
            max-height: 90vh;
            margin: auto;
            border: none;
            background: white;
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }
        dialog::backdrop {
            background-color: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        .dialog-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 24px;
            box-sizing: border-box;
        }
        .dialog-header {
            flex-shrink: 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 16px;
        }
        .dialog-header .btn-close {
            padding: 6px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }
        .dialog-header .btn-close:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }
        .dialog-body {
            flex: 1 1 auto;
            overflow-y: auto;
            padding-right: 4px;
        }
        .dialog-footer {
            flex-shrink: 0;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
        }

        /* Modern Pagination SaaS Styling */
        nav:has(.pagination) {
            width: 100%;
        }
        .pagination {
            margin-bottom: 0;
            gap: 4px;
        }
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link,
        .pagination .page-link {
            border-radius: 6px !important;
            padding: 6px 12px;
            font-size: 14px;
            color: #4b5563;
            border-color: #e5e7eb;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #f8fafc;
            color: #9ca3af;
            border-color: #e5e7eb;
        }

        /* Invisible spacer rows to keep under-5 data tables perfectly matched to 5-data height */
        .placeholder-row, .placeholder-row td {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body class="bg-light">
    @include('layouts.partials.navbar') <!-- Panggil Navbar -->

    <main class="container py-4">
        @yield('content') <!-- Lubang untuk isi halaman -->
    </main>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Progressive Enhancement untuk HTML Invoker Commands API (commandfor / command) -->
    <script>
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('button[commandfor]');
            if (!trigger) return;
            const targetId = trigger.getAttribute('commandfor');
            const command = trigger.getAttribute('command');
            const dialog = document.getElementById(targetId);
            if (!dialog || typeof dialog.showModal !== 'function') return;

            if (command === 'show-modal' && !dialog.open) {
                try { dialog.showModal(); } catch (err) {}
            } else if (command === 'close' && dialog.open) {
                try { dialog.close(); } catch (err) {}
            }
        });

        // Tutup dialog secara elegan saat pengguna mengklik area backdrop di luar modal
        document.addEventListener('click', (e) => {
            if (e.target.tagName === 'DIALOG' && e.target.open) {
                const rect = e.target.getBoundingClientRect();
                const isInDialog = (rect.top <= e.clientY && e.clientY <= rect.top + rect.height &&
                                    rect.left <= e.clientX && e.clientX <= rect.left + rect.width);
                if (!isInDialog) {
                    try { e.target.close(); } catch (err) {}
                }
            }
        });
    </script>
</body>
</html>
