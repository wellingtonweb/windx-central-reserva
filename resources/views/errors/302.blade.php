@extends('errors::illustrated-layout')

@section('content')
    <h1 style="color: #ffffff">ERRO @section('code', '302')</h1>
    <h2 style="color: #ffffff">Desculpe, a página não está sendo redirecionada corretamente!</h2>
    <script>
        setTimeout(function(){
            history.back();
        },4000)
    </script>
@endsection
