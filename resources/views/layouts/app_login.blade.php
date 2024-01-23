<!doctype html>
<html lang="pt-BR">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Central do Assinante') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logox.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ asset('assets/css/fawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url(mix('assets/css/modules/login.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <style>
        .full-screen-splash {
            overflow: hidden !important;
        }
    </style>
</head>

<body class="body" style="background: #020f26 url(/assets/img/bg001.jpg) no-repeat center center fixed; background-size: cover;">
<div class="bg-body-backdrop"></div>
<div class="full-screen-backdrop"></div>
<div class="loading- d-none">
    <div class="loader animate__animated animate__fadeInUp">
        <h2>
            <span>W</span>
            <span>I</span>
            <span>N</span>
            <span>D</span>
            <span>X</span>
        </h2>
    </div>
</div>
<div class="full-screen-backdrop container-all d-flex mx-auto flex-column">
    <div id="container-logo" class="mt-2">
        <img class="logo-windx d-none" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">
    </div>

    @yield('content')

    <footer id="footer" class="mastfoot mt-auto pt-3 d-none " style="z-index: -1;">
        <small class=" d-block">&copy; {{date('Y')}} {{ getenv('APP_NAME') }}<br>
            0800 028 2309 | (28) 3532-2309
        </small>
        <small class="mb-1 d-block w-100 pl-3 pr-3">{{ getenv('WINDX_STORES') }}</small>
    </footer>
    <div class="mb-0 mr-0 contact-client button-card-contact d-none">
        <a href="{{ env('WHATSAPP_SERVICE') }}"
           target="_blank">
            <img src="{{asset('assets/img/whatsapp.svg')}}" alt="WhatsApp Windx">
        </a>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/intro.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/effects.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>

@if(session('message') || session('error') || session('error_checkout') )
    @if (session('error'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            let session = `{{session('error')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro ' + 400 + '!',
                text: session,
                timer: 7000,
                showConfirmButton: false,
            });
        </script>
    @else(session('success'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            let session = `{{session('success')}}`;
            Swal.fire({
                icon: 'success',
                title: session,
                timer: 5000,
                showConfirmButton: false,
            });
        </script>
    @endif
@endif
@hasSection('js')
    @yield('js')
@endif

</body>
</html>
