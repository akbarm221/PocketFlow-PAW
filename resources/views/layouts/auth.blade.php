<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PocketFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FAFAFA;
        }

        .btn-primary {
            background-color: #47ACBC !important;
            border-color: #47ACBC !important;
        }

        .btn-primary:hover {
            background-color: #379BA4 !important;
            /* Warna sedikit lebih gelap untuk efek hover */
        }
    </style>
</head>

<body>
    <nav class="navbar" style="background-color : #F5F5F5;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">PocketFlow</a>
        </div>
    </nav>
    <main class="container mt-4">
        @yield('content')
    </main>
</body>

</html>