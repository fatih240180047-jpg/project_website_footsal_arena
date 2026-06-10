<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul', 'Futsal Arena')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; color: #333; line-height: 1.6; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 16px; }
        nav { background: #1a73e8; color: #fff; padding: 12px 0; }
        nav .container { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
        nav .brand { font-size: 1.2em; font-weight: bold; text-decoration: none; color: #fff; }
        nav .menu { display: flex; gap: 16px; align-items: center; flex-wrap: wrap; }
        nav .menu a { color: #fff; text-decoration: none; font-size: 0.95em; }
        nav .menu a:hover { text-decoration: underline; }
        nav .menu form { display: inline; }
        nav .menu button { background: none; border: 1px solid #fff; color: #fff; padding: 4px 12px; cursor: pointer; border-radius: 4px; }
        .alert { padding: 12px 16px; border-radius: 4px; margin-bottom: 16px; }
        .alert-sukses { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .content { padding: 24px 0; }
        .card { background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 16px; }
        .card h3 { margin-bottom: 8px; }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 4px; text-decoration: none; border: none; cursor: pointer; font-size: 0.9em; }
        .btn-primer { background: #1a73e8; color: #fff; }
        .btn-sukses { background: #28a745; color: #fff; }
        .btn-bahaya { background: #dc3545; color: #fff; }
        .btn-peringatan { background: #ffc107; color: #333; }
        .btn:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; margin-bottom: 4px; font-weight: bold; font-size: 0.9em; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 0.95em; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 0.8em; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-dikonfirmasi { background: #d4edda; color: #155724; }
        .badge-dibatalkan { background: #f8d7da; color: #721c24; }
        .badge-selesai { background: #d1ecf1; color: #0c5460; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
        .text-center { text-align: center; }
        .mt-2 { margin-top: 8px; }
        .mt-4 { margin-top: 16px; }
        .mb-2 { margin-bottom: 8px; }
    </style>
</head>
<body>
    <nav>
        <div class="container">
            <a href="/" class="brand">Futsal Arena</a>
            <div class="menu">
                @auth
                    @if(auth()->user()->peran === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a href="{{ route('admin.lapangan.index') }}">Lapangan</a>
                        <a href="{{ route('admin.reservasi.index') }}">Reservasi</a>
                    @else
                        <a href="{{ route('pelanggan.lapangan.index') }}">Cari Lapangan</a>
                        <a href="{{ route('pelanggan.reservasi.index') }}">Reservasi Saya</a>
                    @endif
                    <span>Halo, {{ auth()->user()->nama }}</span>
                    <form action="{{ route('autentikasi.keluar') }}" method="POST">
                        @csrf
                        <button type="submit">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('autentikasi.masuk') }}">Masuk</a>
                    <a href="{{ route('autentikasi.daftar') }}">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            @if(session('sukses'))
                <div class="alert alert-sukses">{{ session('sukses') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('konten')
        </div>
    </div>

    @stack('skrip')
</body>
</html>
