@extends('errors::illustrated-layout')

@section('content')
    <h1 style="color: #ffffff">ERRO @section('code', '406')</h1>
    <h2 style="color: #ffffff">Desculpe, token inválido!</h2>
    <script>
        setTimeout(function(){
            window.location = `{{Route('central.login')}}`;
        },4000)
    </script>
@endsection
