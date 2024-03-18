@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row mt-4_ contents inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <nav id="infoCustomerActive" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contrato</li>
                        </ol>
                    </nav>
                    <div class="header-app col-12 font-weight-bolder d-lg-none d-flex justify-content-between" >
                        <a href="javascript:history.back();"><i class="fas fa-arrow-left pr-3"></i></a>
                        <span>{{$header}}</span>
                        <span class="px-3"></span>
                    </div>
                    {{$name = "GEMILSE LEONARDO HAUTEQUESTT (PITY)"}}
                    {{$first_name = strtok($name, ' ')}}
                    {{$last_name = substr(strstr($name, ' '),1)}}
                    {{dd($name, $first_name, $last_name)}}
                    <div class="contract-info col-12">
                        <div id="accordion" class="row row-cols-1 row-cols-md-3 accordion">
                            <div class="col pl-0 pr-0">
                                <div class="card h-100 ">
                                    <div class="card-body">
                                        <a href="#" class="help-link d-flex collapsed" data-toggle="collapse" data-target="#collapsePersonalData" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="card-title font-weight-bold">Dados Pessoais</h4>
                                            <span class="accordion-icon fa-stack fa-sm">
                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        <ul id="collapsePersonalData" class="list-group collapse show" data-parent="#accordion">
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Nome:
                                                <span class="text-black-50 text-right">{{ $customer['full_name'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                CPF/CNPJ:
                                                <div>
                                                    <span id="cpf" class="text-black-50 text-right" onclick="toggleCPF()">{{ $customer['document'] }}</span>
                                                    <i id="toggleBtn" class="fa fa-eye text-primary" ></i>
                                                </div>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Data de nascimento:
                                                <span class="text-black-50 text-right">{{ date("d/m/Y", strtotime($customer['dt_trust'])) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-lg-0 mt-3 ">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <a href="#" class="help-link d-flex collapsed" data-toggle="collapse" data-target="#collapseAddress" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="card-title font-weight-bold">Endereço e Contato</h4>
                                            <span class="accordion-icon fa-stack fa-sm">
                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        <ul id="collapseAddress" class="list-group collapse" data-parent="#accordion">
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Endereço:
                                                <span class="text-black-50 text-right">{{ $customer['street'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Referência:
                                                <span class="text-black-50 text-right">{{ trim($customer['reference']) == '' ? 'SEM REFERÊNCIAS' : $customer['reference']}}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Cidade:
                                                <span class="text-black-50 text-right">{{ $customer['city'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                CEP:
                                                <span class="text-black-50 text-right">{{ $customer['cep'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Telefone:
                                                <span class="text-black-50 text-right">{{ $customer['phone'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Celular:
                                                <span class="text-black-50 text-right">{{ $customer['cell'] }}</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                E-mail:
                                                <span class="text-black-50 text-right">{{ $customer['email'] }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-lg-0 mt-3 pl-0 pr-0">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <a href="#" class="help-link d-flex collapsed" data-toggle="collapse" data-target="#collapseAccountData" aria-expanded="true" aria-controls="collapseOne">
                                            <h4 class="card-title font-weight-bold">Dados da Conta</h4>
                                            <span class="accordion-icon fa-stack fa-sm">
                                                <i class="fas fa-circle fa-stack-2x"></i>
                                                <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                                            </span>
                                        </a>
                                        <ul id="collapseAccountData" class="list-group collapse" data-parent="#accordion">
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Plano contratado:
                                                @foreach($customer['plans'] as $plan)
                                                <span class="text-black-50 text-right">{{ $plan['descricao'] }} (R$ {{ number_format($plan['valor'],2,",",".")}})</span>
                                                @endforeach
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Dia de Vencimento:
                                                <span class="text-black-50 text-right">15</span>
                                            </li>
                                            <li class="contract list-group-item d-flex justify-content-between align-items-center">
                                                Status:
                                                @switch(session('customer.status'))
                                                    @case('B')
                                                    <span class="badge badge-pill badge-danger">BLOQUEADO</span>
                                                    @break
                                                    @case('L')
                                                    <span class="badge badge-pill badge-primary">LIBERADO</span>
                                                    @break
                                                    @case('X')
                                                    <span class="badge badge-pill badge-secondary">DESATIVADO</span>
                                                    @break
                                                @endswitch
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/contract.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script>
        $(document).ready(function() {
            var isHidden = true;
            var toggleBtn = $('#toggleBtn');
            var cpfElement = $('#cpf');

            toggleCPF(isHidden);

            toggleBtn.click(function() {
                isHidden = !isHidden;
                toggleBtn.toggleClass('fa-eye fa-eye-slash');
                toggleCPF(isHidden);
            });

            function toggleCPF(hidden) {
                var cpf = '{{ session('customer.document') }}';
                cpfElement.text(hidden ? cpf.substring(0, 5) + '...' : cpf);
            }

            $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
                $(e.target)
                    .prev()
                    .find("i:last-child")
                    .toggleClass("fa-plus fa-minus");
            });

            if (window.innerWidth <= 600) {
                $('#collapseAddress, #collapseAccountData').removeClass('show')
            } else {
                $('#collapsePersonalData, #collapseAddress, #collapseAccountData').addClass('show')
            }

        });
    </script>

@endsection
