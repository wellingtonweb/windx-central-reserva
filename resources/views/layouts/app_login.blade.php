<!doctype html>
<html lang="pt-BR">
<head>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Central de Pagamentos') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logox.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="{{ asset('assets/css/fawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url(mix('assets/css/modules/login.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cover.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
</head>

<body class="body" style="background: #002046 url(/assets/img/bg001.jpg) no-repeat center center fixed;">
<div class="bg-body-backdrop"></div>
<div class="full-screen-backdrop"></div>
<div class="loading">
    <img src="{{ asset('assets/img/loading.svg') }}" alt="Carregando...">
</div>
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
{{--    @if (Route::currentRouteName() == 'terminal.login' ||Route::currentRouteName() == 'terminal.login2' || Route::currentRouteName() == 'terminal.locked')--}}
        <div class="mt-3">
            <img class="logo-windx animate__animated animate__fadeInDown" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">
        </div>
{{--    @else--}}
{{--        @include('include.header')--}}
{{--    @endif--}}

    @yield('content')

{{--    @hasSection('modal')--}}
{{--        @yield('modal')--}}
{{--    @endif--}}

    @include('include.footer')
    @include('include.card-contact')

</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/intro.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/effects.js') }}"></script>
<script>
    $('#form_login').submit(function (e){
        $('.loading').removeClass('d-none')
    })
</script>
{{--<script type="text/javascript" src="{{ asset('assets/js/libs.js') }}"></script>--}}
{{--<script defer type="text/javascript" src="{{ asset('assets/js/pdf.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/js/js.jsbarcode2.js') }}"></script>--}}
{{--<script>--}}
{{--    const route_login = '{{route('terminal.login')}}';--}}
{{--    const route_logout = '{{route('terminal.logout')}}';--}}
{{--    const app_url = '{{env('APP_URL')}}';--}}
{{--    const base_url = '{{env('APP_BASE_URL')}}';--}}
{{--    const contracts = '{{route('terminal.contracts')}}';--}}
{{--    const release_url = `{{route('terminal.release')}}`;--}}

{{--    if(window.location.href != route_login){--}}
{{--        inactivitySession();--}}
{{--    }--}}
{{--</script>--}}
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

</body>
</html>
