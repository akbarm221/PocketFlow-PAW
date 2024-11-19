<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
        }
        .sidebar a {
            text-decoration: none;
            font-size: 16px;
            color: #333;
            display: block;
            padding: 15px;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
        }
        .sidebar .active {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="text-center my-3">
            <img src="https://via.placeholder.com/100x50" alt="Logo" class="img-fluid">
            <h4>PocketFlow</h4>
        </div>
        <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('pemasukan.index') }}">Data Pemasukan</a>
        <a href="{{ route('pengeluaran.index') }}">Data Pengeluaran</a>
        <a href="{{ route('goals.index') }}">Goals</a>

        <!-- Form Logout -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-link text-start d-block w-100" style="padding: 15px; color: #333; text-decoration: none;">
                Logout
            </button>
        </form>
    </div>
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
