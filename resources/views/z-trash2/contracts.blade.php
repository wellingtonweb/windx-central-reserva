@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                {{--                <div class="row div-title">--}}
                {{--                    <div class="col-12 animate__animated animate__fadeInDown">--}}
                {{--                        <h3 class="page-title">Terminal de autoatendimento</h3>--}}
                {{--                        <h5 id="payment-title" class="page-subtitle">Pagamento (Contratos)</h5>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                {{ dd($customers) }}--}}
                <main role="main" class="inner fadeIn">
                    <section>
                        <div id="checkout" class="contents">

                            <div id="contracts-container" class="row row-invoices animate__animated animate__fadeIn">
                                <div class="col-12">
                                    <div class="row checkout {{count($customers) < 4 ? 'd-none-': ''}}">
                                        <div class="col-12 checkout-status p-2 justify-content-center text-center">
                                            <h4>Selecione o contrato desejado para pagamento!</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="contracts-slider" class="owl-carousel">

                                                {{--{{dd(count($customers))}}--}}
                                                @foreach($customers as $key => $customer)
                                                    @if(count($customers) == 1)
                                                        {{--                                                        <link rel="stylesheet" href="{{ asset('assets/css_old/animate.css_old') }}">--}}
                                                        <script type="text/javascript">
                                                            // $('#contracts-container').addClass('d-none')
                                                            // $('#invoices-container').removeClass('d-none')
                                                        </script>
                                                    @endif
                                                    <div id="invoice-{{random_int(10, 100)}}" class="invoice-slide"
                                                         data-id="{{ $customer->id }}">
                                                        <div class="card">
                                                            @switch($customer->status)
                                                                @case('L')
                                                                <div class="card-header">
                                                                    @break;
                                                                    @case('B')
                                                                    <div class="card-header text-white bg-danger">
                                                                        @break;
                                                                        @case('X')
                                                                        <div
                                                                            class="card-header text-white bg-secondary">
                                                                            @break;
                                                                            @endswitch
                                                                            <h5 class="card-title">Contrato
                                                                                Nº: {{ $customer->id }}</h5>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <p class="card-text text-left full-name"><b
                                                                                    class="title">Nome: </b>
                                                                                <span
                                                                                    class="text-windx-80 ">{{ $customer->full_name }}</span>
                                                                            </p>
                                                                            <p class="card-text text-left address"><b
                                                                                    class="title">Endereço: </b>
                                                                                <span
                                                                                    class="text-windx-80 ">{{ $customer->street }}</span>
                                                                            </p>
                                                                            <p class="card-text text-left reference-address">
                                                                                <b class="title">Referência: </b>
                                                                                <span
                                                                                    class="text-windx-80 ">{{ $customer->reference }}</span>
                                                                            </p>
                                                                            <p class="card-text text-left"><b
                                                                                    class="title">CEP: </b>
                                                                                <span
                                                                                    class="text-windx-80">{{ $customer->cep }}</span>
                                                                            </p>
                                                                            <p class="card-text text-left"><b
                                                                                    class="title">Status: </b>
                                                                                @switch($customer->status)
                                                                                    @case('L')
                                                                                    <span class="text-primary font-weight-bold">
                                                                                        LIBERADO <small>{{count($customer->billets) == 0 ? '(SEM FATURAS PENDENTES)' : ''}}</small>
                                                                                    </span>
                                                                                    @break;
                                                                                    @case('B')
                                                                                    <span class="text-danger font-weight-bold">
                                                                                        BLOQUEADO <small>{{count($customer->billets) == 0 ? '(SEM FATURAS PENDENTES)' : ''}}</small>
                                                                                    </span>
                                                                                    @break;
                                                                                    @case('X')
                                                                                    <span class="text-secondary font-weight-bold">
                                                                                        DESATIVADO <small>{{count($customer->billets) == 0 ? '(SEM FATURAS PENDENTES)' : ''}}</small>
                                                                                    </span>
                                                                                    @break;
                                                                                @endswitch
                                                                            </p>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <span id="getInvoices" class="d-none" data-invoices="{{ json_encode($customer->billets) }}"></span>
                                                                            <a href="{{route('terminal.contract', ['customerId' => $customer->id])}}"
                                                                                id="contract-selected-{{$customer->id}}"

                                                                                data-invoices="{{ json_encode($customer->billets) }}"
                                                                                class="btn btn-primary click-loader btn-radius-50">
{{--                                                                                class="btn btn-primary click-loader btn-radius-50 {{count($customer->billets) == 0 ? 'not-active disabled' : ''}}">--}}
                                                                                <i class="fas fa fa-check"
                                                                                   aria-hidden="true"></i> Selecionar
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="container-icon-move-hand {{count($customer->billets) == 1 ? 'd-none': ''}}">
                                                                        <img src="{{asset('assets/img/slide-icon.jpg')}}" width="25px" height="25px" alt="">
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </section>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/contracts.custom.min.js') }}"></script>
    <script type="text/javascript" defer>inactivitySession();</script>
@endsection



