<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 125vh;
            overflow: hidden;
            /* Hide scrollbars */
        }

        nav {
            background-color: #191919;
            width: 100%;
            height: 43px;
            padding: 9px 8px 5px;
        }

        .background-container {
            position: relative;
            height: 100%;
            overflow: hidden;
            background-color: #FAFAFA;
        }

        .custom-shape-divider-top-1732459513 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-top-1732459513 svg {
            position: relative;
            display: block;
            width: calc(150% + 1.3px);
            height: 335px;
        }

        .custom-shape-divider-top-1732459513 .shape-fill {
            fill: #191919;
        }

        .title {
            position: relative;
            z-index: 1;
            margin-top: 150px;
            text-align: center;
            color: #299d91;
            padding: 50px;
        }

        .title h1 {
            word-spacing: 4.5px;
            font-size: 3.21em;
        }

        .title p {
            font-size: 1.4em;
        }

        .line {
            width: 35%;
            height: 3px;
            background-color: #D9D9D9;
            margin: auto;
            justify-content: center;
        }

        .btn {
            margin: auto;
            margin-top: 8px;
            justify-content: center;
            width: 64.6%;
            background: #47ACBC;
            border: #47ACBC;
            color: white;
            text-decoration: none;
            /* Hilangkan underline */
            display: inline-block;
            /* Pastikan seperti tombol */
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .d-grid {
            margin-top: 25px;
        }

        .btn:hover {
            background-color: rgb(16, 190, 109);
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.6);
            color: white;
            /* Pastikan tetap putih */
        }
    </style>
</head>

<body>
    <nav>
        <p style="color: black; font-size: 1.11em;"><b>PocketFlow</b></p>
    </nav>
    <div class="background-container">
        <div class="custom-shape-divider-top-1732459513">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    class="shape-fill">
                </path>
            </svg>
        </div>
        <!-- title -->
        <div class="title">
            <h1><b>Selamat Datang di PocketFlow</b></h1>
            <p>Sebuah Aplikasi Pengelola Keuangan</p>
        </div>
        <!-- opsi masuk -->
        <div class="option">
            <p style="text-align: center; margin-bottom: 2px; font-size: 0.97em">Mulai Dengan</p>
            <div class="line"></div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <!-- Tombol Login -->
                <a href="/login" class="btn btn-primary text-center"><b>Login</b></a>
                <p style="margin: auto; justify-content: center; font-size: 0.83em">Atau</p>
                <!-- Tombol Register -->
                <a href="/register" class="btn btn-primary text-center"><b>Sign in</b></a>
            </div>

        </div>
    </div>
</body>
</body>

</html>