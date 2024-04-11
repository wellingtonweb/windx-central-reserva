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
    <link rel="stylesheet"  href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cover.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">

    @hasSection('css')
        @yield('css')
    @endif

    <style>
        .container-all {
            padding: .5rem;
        }
    </style>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>

<body class="body" style="background: #020f26 url(/assets/img/bg001.jpg) no-repeat center center fixed; background-size: cover; padding: 0 !important; margin: 0 !important;">
<div class="bg-body-backdrop"></div>
<div class="progress progress-system {{ (Route::currentRouteName() === 'central.login' ? 'd-none' : '') }} animate__animated animate__fadeIn">
    <div class="progress-bar progress-bar-system" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="full-screen-backdrop"></div>
<div class="loading">
    <div class="loader animate__animated animate__fadeIn">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/effects.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('assets/js/pdf.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>
<script>
    const route_login = '{{route('central.login')}}';
    const route_logout = '{{route('central.logout')}}';
    const app_url = '{{env('APP_URL')}}';
    const base_url = '{{env('APP_BASE_URL')}}';
    const release_url = `{{route('central.release')}}`;

    $('.loading').removeClass('d-none');
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
@if(session('warning'))
    <script>
        Swal.fire({
            title: 'Atenção!',
            icon: 'warning',
            html: '<b>Este cadastro possuí débitos antigos!</b><br><br>' +
                'Estaremos direcionando você<br> para nosso atendimento.<br>Escolha o menu Financeiro > Negociação de Débitos.',
            timer: 8000,
            timerProgressBar: false,
            showConfirmButton: true,
            allowOutsideClick: () => {
                const popup = Swal.getPopup()
                popup.classList.remove('swal2-show')
                setTimeout(() => {
                    popup.classList.add('animate__animated', 'animate__headShake')
                })
                setTimeout(() => {
                    popup.classList.remove('animate__animated', 'animate__headShake')
                }, 500)
                return false
            },
        }).then((result) => {
            if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                location = "{{env('WHATSAPP_FINANCIAL')}}";
            }
        });
    </script>
@endif
@hasSection('js')
    @yield('js')
@endif
</body>
</html>
