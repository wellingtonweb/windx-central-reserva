<!doctype html>
<html lang="pt-BR">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Terminal de Pagamentos') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logox.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ asset('assets/css/fawesome.min.css') }}">
    <link rel="stylesheet"  href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cover.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">

    @hasSection('css')
        @yield('css')
    @endif
{{--    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">--}}

    <style>

    </style>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>

<body class="body" style="background: #002046 url(/assets/img/bg001.jpg) no-repeat center center fixed;">
<div class="bg-body-backdrop"></div>
<div class="progress progress-system {{ (Route::currentRouteName() === 'central.login' ? 'd-none' : '') }} animate__animated animate__fadeIn">
    <div class="progress-bar progress-bar-system" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="full-screen-backdrop"></div>
<div class="loading">
    <img src="{{ asset('assets/img/loading.svg') }}" alt="Carregando...">
</div>

<div class="full-screen-backdrop container-all d-flex mx-auto flex-column">
    @if (Route::currentRouteName() == 'central.login' ||Route::currentRouteName() == 'central.login2' || Route::currentRouteName() == 'central.locked')
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
    @include('include.card-contact')

</div>

{{--<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/effects.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('assets/js/libs.js') }}"></script>--}}
<script defer type="text/javascript" src="{{ asset('assets/js/pdf.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('assets/js/js.jsbarcode2.js') }}"></script>--}}
<script>
    const route_login = '{{route('central.login')}}';
    const route_logout = '{{route('central.logout')}}';
    const app_url = '{{env('APP_URL')}}';
    const base_url = '{{env('APP_BASE_URL')}}';
    {{--const contracts = '{{route('central.contracts')}}';--}}
    const release_url = `{{route('central.release')}}`;

</script>

@if(session('message') || session('error') || session('error_checkout') )

<script>
    Swal.fire({
        title: '{{ (session('message') ? 'Atenção!': (session('error') ? 'Erro!': 'Erro de pagamento!')) }}',
        icon: '{{ (session('message') ? 'warning': 'error') }}',
        html: '{{ (session('message') ? session('message') : (session('error') ? session('error'): session('error_checkout'))) }}',
        timer: 5000,
        timerProgressBar: false,
        showConfirmButton: false,
    })
</script>
@endif
@hasSection('js')
    @yield('js')
@endif
{{--<script defer> inactivitySession(); </script>--}}
</body>
</html>
