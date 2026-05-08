<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
</head>
@auth
    @php
        if (Auth::user()->role == 'Admin'){
            $colors = '#f00c, #ff0';
        } else {
            $colors = '#00cc,#0f0';
        }
    @endphp
@else
    @php
        $colors = '#000c,#0000';
    @endphp
@endauth
<body class="min-h-dvh flex flex-col gap-2 justify-center items-center bg-no-repeat bg-center bg-cover bg-fixed pt-14"
    style="background-image: linear-gradient(to top, #000a, #000a), url('{{ asset('images/bg-welcome.jpg') }}');">

    <main>
        @yield('content')
    </main>
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
        @yield('js')
</body>
</html>