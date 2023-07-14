<!doctype html>
<html lang="pt-BR">
<head>
    {{--    <meta charset="UTF-8">--}}
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    {{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <title>{{ config('app.name', 'Terminal de Pagamentos') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logox.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ asset('assets/css/fawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="stylesheet" href="{{ url(mix('assets/css/login.css')) }}">

    {{--    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/cover.css') }}">--}}

    {{--    <link rel="stylesheet" href="{{ asset('assets/css/print.invoice.css') }}">--}}
    @hasSection('css')
        @yield('css')
    @endif

</head>

<body class="body">
<div class="progress progress-system {{ Route::currentRouteName() === 'terminal.login' ? 'd-none' : '' }} animate__animated animate__fadeIn">
    <div class="progress-bar progress-bar-system" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="full-screen-backdrop"></div>
<div class="loading">
    <img src="{{ asset('assets/img/loading.svg') }}" alt="Carregando...">
</div>
<div class="loading- d-none">
    <div class="loader animate__animated animate__fadeInUp">
        <h2>
            <span>C</span>
            <span>a</span>
            <span>r</span>
            <span>r</span>
            <span>e</span>
            <span>g</span>
            <span>a</span>
            <span>n</span>
            <span>d</span>
            <span>o</span>
        </h2>
    </div>
</div>

<div class="full-screen-backdrop container-all d-flex mx-auto flex-column">
    @if (Route::currentRouteName() == 'terminal.login' ||Route::currentRouteName() == 'terminal.login2' || Route::currentRouteName() == 'terminal.locked')
        <div class="mt-3">
            <img class="logo-windx animate__animated animate__fadeInDown" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">
        </div>
    @else
        @include('include.header')
    @endif

    @yield('content')

    @hasSection('modal')
        @yield('modal')
    @endif

    @include('include.footer')
    <div class="contact-client">
        <a href="#" id="btn-contact">
            <img src="{{asset('assets/img/whatsapp.svg')}}" alt="">
        </a>
    </div>
    <div id="card-contact" class="card card-contact animate__animated d-none">
        <button type="button" class="close" id="close-contact">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="card-img">
            <img src="{{asset('assets/img/logox.svg')}}" class="logo" alt="...">
            <h6 class="font-weight-bold">Windx Telecomunicações</h6>
            <small>Contato do WhatsApp</small>
            <img src="{{asset('assets/img/qrcontact2.jpg')}}" class="qrcode-img"  alt="">
        </div>
        <div class="card-body">
            <p class="card-text">
                Escaneie esse código usando o <b>Google Lens</b>
                ou adicione nosso <b>0800 028 2309</b><br> aos seus contatos</p>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('assets/js/libs.js') }}"></script>--}}

@if(session('message') || session('error') || session('error_checkout') )

    <script>
        Swal.fire({
            title: '{{session('message') ? 'Atenção!': session('error') ? 'Erro!': 'Erro de pagamento!' }}',
            icon: '{{session('message') ? 'warning': 'error' }}',
            html: '{{session('message') ? session('message') : session('error') ? session('error'): session('error_checkout') }}',
            timer: 5000,
            timerProgressBar: false,
            showConfirmButton: false,
        })
    </script>
@endif
@hasSection('js')
    @yield('js')
@endif

</body>
</html>
