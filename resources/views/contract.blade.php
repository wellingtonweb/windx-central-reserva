@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <nav id="infoCustomerActive" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contrato</li>
                        </ol>
                    </nav>
                    <div class="header-app col-12 font-weight-bolder text-left" style="display: none">
                        {{$header}}
                    </div>
                    <div class="col-12">
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col mt-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Dados Pessoais</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Nome:
                                                <span class="text-black-50 text-right">{{ $customer['full_name'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                CPF/CNPJ:
                                                <span class="text-black-50 text-right">{{ $customer['document'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Data de nascimento:
                                                <span class="text-black-50 text-right">{{ date("d/m/Y", strtotime($customer['dt_trust'])) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Endereço e Contato</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Endereço:
                                                <span class="text-black-50 text-right">{{ $customer['street'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Referência:
                                                <span class="text-black-50 text-right">{{ trim($customer['reference']) == '' ? 'SEM REFERÊNCIAS' : $customer['reference']}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Cidade:
                                                <span class="text-black-50 text-right">{{ $customer['city'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                CEP:
                                                <span class="text-black-50 text-right">{{ $customer['cep'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Telefone:
                                                <span class="text-black-50 text-right">{{ $customer['phone'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Celular:
                                                <span class="text-black-50 text-right">{{ $customer['cell'] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                E-mail:
                                                <span class="text-black-50 text-right">{{ $customer['email'] }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Dados da Conta</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Plano contratado:
                                                @foreach($customer['plans'] as $plan)
                                                <span class="text-black-50 text-right">{{ $plan['descricao'] }}</span>
                                                @endforeach
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Dia de Vencimento:
                                                <span class="text-black-50 text-right">15</span>
                                            </li>
{{--                                            <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                                                Cliente Desde:--}}
{{--                                                <span class="text-black-50 text-right">01/05/2004</span>--}}
{{--                                            </li>--}}
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Status:
                                                @switch($customer['status'])
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
    <style>
        h2 {
            color: #002046;
        }

        .card-info {
            background-color: white;
            border-radius: .5rem;
            gap: 5px;
        }

        @media (max-width: 575.98px) {
            .col {
                padding-right: 5px !important;
                padding-left: 5px !important;
            }

            .card-body {
                padding: .5rem !important;
            }

            .list-group-item {
                padding: .5rem !important;
            }

            .contents {
                padding: .5rem !important;
            }
        }
    </style>

@endsection

@section('js')
    <script type="text/javascript" defer>inactivitySession();</script>
@endsection
