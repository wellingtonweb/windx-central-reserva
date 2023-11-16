@extends('errors::illustrated-layout')

@section('content')
    <h1 style="color: #ffffff">Desculpe, servidor em manutenção! @section('code', '423')</h1>
    <h2 style="color: #ffffff; padding-left: 1rem">Hora atual: <span id="hour"></span></h2>
    <h2 style="color: #ffffff; padding-left: 1rem">Previsão de retorno: {{ session('backupLimitTime')['timeLimit'] }}</h2>
    <script>
        var miliseconds = {{ session('backupLimitTime')['miliseconds'] }};
        console.log(miliseconds)
        setTimeout(function(){
            window.location = `{{Route('central.logout')}}`;
        }, miliseconds)

        function updateTime() {
            var today = new Date();
            var hour = ('0' + today.getHours()).slice(-2) + ':' +
                ('0' + today.getMinutes()).slice(-2) + ':' +
                ('0' + today.getSeconds()).slice(-2);

            document.getElementById('hour').textContent = hour;
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>
@endsection
