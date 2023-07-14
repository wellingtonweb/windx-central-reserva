<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logox.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{ asset('assets/central/css_old/fawesome.min.css_old') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/central/css_old/style.css_old') }}">
    <link rel="stylesheet" href="{{ asset('assets/central/css_old/central.css_old') }}">
{{--    <link rel="stylesheet" href="{{ asset('assets/central/css_old/animate.min.css_old') }}">--}}
</head>
<body>
@yield('content')
<script type="text/javascript" src="{{ asset('assets/central/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/central/js/bootstrap2.bundle.min.js') }}"></script>
</body>
</html>
