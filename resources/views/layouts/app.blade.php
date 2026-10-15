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

        /* Styling Navbar yang Selaras & Elegan */
        .navbar {
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
        }
        .navbar-brand {
            font-size: 1.15rem;
            letter-spacing: -0.2px;
        }
        .navbar-nav .nav-link {
            font-size: 14.5px;
            font-weight: 500;
            color: #4b5563;
            padding: 0.5rem 0.85rem;
            transition: color 0.15s ease-in-out;
        }
        .navbar-nav .nav-link:hover {
            color: #0d6efd;
        }
        .navbar-nav .nav-link.active {
            color: #0d6efd !important;
            font-weight: 600;
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
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
            border: none;
            width: 100%;
            max-width: 1000px;
            margin: auto;
            box-sizing: border-box;
        }

        .card:has(.form-group) {
            max-width: 500px;
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

        /* Modern Native HTML Dialog & Backdrop */
        dialog {
            max-width: 480px;
            width: 90%;
            margin: auto;
            border: none;
            background: white;
        }
        dialog::backdrop {
            background-color: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
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
