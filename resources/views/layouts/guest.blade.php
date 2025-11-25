<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ESTILOS -->
    <style>
        .container {
            display: grid;
            grid-template-columns: 25% 75%;
            height: 100vh;
            width: 200vh;
            background-color: white; /* ALTERADO AQUI */
        }

        .image-side {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: white;
        }
        
        html, body {
            height: 100%;
            background-color: white;
        }

        .image-side img,
        .image-side svg {
            max-width:130%;
            max-height: 130vh;
            object-fit: contain;
        }

        .form-side {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            width: 120%;
            padding: 24px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="container">

        <div class="image-side">
            <x-styled-image />
        </div>

        <div class="form-side">
            <div>

                <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 16px;">
                    <a href="/" style="display: flex; justify-content: center;">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>

                <div class="form-card">
                    {{ $slot }}
                </div>

            </div>
        </div>

    </div>
</body>
</html>
