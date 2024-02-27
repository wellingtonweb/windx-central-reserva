@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
            </div>
        </section>
    </main>
@endsection

@section('css')

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script>
        $(document).ready(function() {
            Swal.fire('Pagamento realizado com sucesso!')
        });
    </script>

@endsection
