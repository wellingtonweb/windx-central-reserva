@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <div class="row div-title">
                    <div class="col-12">
                        <h3 class="page-title">Central do Assinante</h3>
                        <h5 class="page-subtitle">Informações de cadastro</h5>
                    </div>
                </div>
                {{--        <div class="row div-home animate__animated animate__fadeIn" style="height:60vh">--}}
                <main role="main" class="inner animate__animated animate__fadeIn">
                    <section>
                        <div class="contents">
                            <table id="table-coupons-list" class="table table-coupons table-action mt-0">
                                <thead>
                                <tr >
                                    <th>ID</th>
                                    <th>Nosso nº</th>
                                    <th>Data de pagamento</th>
                                    <th>Valor pago</th>
                                    <th>Forma de pagamento</th>
                                    <th>Status</th>
                                    <th>2ª via (download)</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td id="col_id" width="14,28%"></td>
                                        <td id="col_billets" width="14,28%"></td>
                                        <td id="col_dt_payment" width="14,28%"></td>
                                        <td id="col_amount" width="14,28%"></td>
                                        <td id="col_payment_type" width="14,28%"></td>
                                        <td id="col_status" width="14,28%"></td>
                                        <td id="col_btn_print" width="14,28%"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </main>
{{--                <div class="row animate__animated animate__fadeIn">--}}
{{--                    <div class="accordion" id="accordionExample">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header" id="headingOne">--}}
{{--                                <h2 class="mb-0">--}}
{{--                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">--}}
{{--                                        Contrato ID nº {{session('customer.id')}} - {{session('customer.full_name')}}--}}
{{--                                    </button>--}}
{{--                                </h2>--}}
{{--                            </div>--}}
{{--                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <h5>Dados pessoais</h5>--}}
{{--                                            <ul class="list-group list-group-flush">--}}
{{--                                                <li class="list-group-item"><span>Nome: </span>{{session('customer.full_name')}}</li>--}}
{{--                                                <li class="list-group-item"><span>CPF/CNPJ: </span>{{session('customer.document')}}</li>--}}
{{--                                                <li class="list-group-item"><span>RG/IE: </span>00000</li>--}}
{{--                                                <li class="list-group-item"><span>Data de Nascimento: </span>00/00/0000</li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <h5>Endereço e Contato</h5>--}}
{{--                                            <ul class="list-group list-group-flush">--}}
{{--                                                <li class="list-group-item"><span>Endereço: </span>{{session('customer.street')}} - {{session('customer.district')}} ({{session('customer.reference')}})</li>--}}
{{--                                                <li class="list-group-item"><span>Cidade: </span>{{session('customer.city')}} - {{session('customer.state')}}</li>--}}
{{--                                                <li class="list-group-item"><span>CEP: </span>{{session('customer.cep')}}</li>--}}
{{--                                                <li class="list-group-item"><span>Telefone: </span>{{session('customer.phone')}}</li>--}}
{{--                                                <li class="list-group-item"><span>Celular: </span>{{session('customer.cell')}}</li>--}}
{{--                                                <li class="list-group-item"><span>E-mail: </span>{{session('customer.email')}}</li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <h5>Dados da conta</h5>--}}
{{--                                            <ul class="list-group list-group-flush">--}}
{{--                                                <li class="list-group-item"><span>Dia de Vencimento: </span>00</li>--}}
{{--                                                <li class="list-group-item"><span>Cliente desde: </span>00/00/0000</li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </section>
    </main>
@endsection

@section('js')
    {{--    <script type="text/javascript" src="{{ asset('assets/central/js/swiper-bundle.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/central/js/swiper.custom.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/central/js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/central/js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/central/js/validate.card.js') }}"></script>
    <script>
        // inactivitySession();
        $('#loading').hide().addClass('animate__animated animate__fadeOutUp');
        $('#selectContractID').click(function () {
            // $('.contracts').addClass('animate__animated animate__fadeOutLeft d-none ');
            // $('.billetsSwiper').removeClass('d-none');
            //
            // var val = $(this).data("target");
            // console.log(val);
            // alert(val);

        });
        $('#returnContracts').click(function () {
            $('.contracts').removeClass('d-none');
            $('.billetsSwiper').addClass('animate__animated animate__fadeOutLeft d-none');
        });
    </script>
@endsection
