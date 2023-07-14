@extends('layouts.app')

@section('content')
    <div class="row div-title">
        {{--    <div class="alert alert-warning alert-dismissible fade show" role="alert">--}}
        {{--        <strong>Holy guacamole!</strong> You should check in on some of those fields below.--}}
        {{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--            <span aria-hidden="true">&times;</span>--}}
        {{--        </button>--}}
        {{--    </div>--}}
        <div class="col-12 text-center pb-4 fadeIn">
            <h3 class="text-light font-weight-bolder">Central do Assinante</h3>
            <h5 class="text-light">Liberação por confiança</h5>
        </div>
    </div>
    <main role="main" class="inner cover fadeIn">
        <section>
            <div id="main" class="container-fluid flex-column d-flex">
                <div class="row animate__animated animate__fadeIn w-auto justify-content-center">
                    <div class="col-12 bg-light rounded p-4 text-center">
                        <h3>Última liberação por confiança</h3>
                        <h5 id="liberation_at" class="text-danger pb-3 font-weight-bold">01/02/2022</h5>

{{--                        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                        <form name="liberation" class="form-group justify-content-center">
                            @csrf
                            {{--                            <label class="sr-only" for="inlineFormInputName2">Name</label>--}}
                            <div class="form-group d-none">
                                <label for="inputLogin">Login</label>
                                <input id="inputLogin" class="form-control text-center" name="login" type="text" value="" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mb-2 btn-lg">
                                    <i class="fas fa-unlock-alt pr-2"></i>Liberar cadastro por confiança
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')

    <script type="text/javascript" src="{{ asset('assets/central/js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/central/js/chart.min.js') }}"></script>

    <script>
        // inactivitySession();
        $('#loading').hide().addClass('animate__animated animate__fadeOutUp');

        /* chart.js chart examples */

        // chart colors
        var colors = ['#007bff', '#28a745', '#333333', '#c3e6cb', '#dc3545', '#6c757d'];

        /* large line chart */
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            datasets: [{
                data: [589, 445, 483, 503, 689, 692, 634],
                backgroundColor: 'transparent',
                borderColor: colors[0],
                borderWidth: 4,
                pointBackgroundColor: colors[0]
            },
                {
                    data: [639, 465, 493, 478, 589, 632, 674],
                    backgroundColor: colors[3],
                    borderColor: colors[1],
                    borderWidth: 4,
                    pointBackgroundColor: colors[1]
                }]
        };
    </script>
@endsection
