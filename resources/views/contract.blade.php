@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-5 mt-md-0">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
{{--                        checkout--}}
{{--                        {{count(session('customer')->billets)}}--}}
                        <div class="{{count(session('customer')->billets) == 0 ? 'd-none': ''}} col-lg-3 order-lg-2 col-md-6 order-md-2 col-sm-6 order-sm-2 py-2 px-lg-0 px-md-1 mb-4">
                            <h4 class="d-flex font-weight-bold justify-content-center align-items-center mb-3">
                                Checkout
                            </h4>
                            <ul class="list-group mb-3" style="border-radius: .5rem">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h4 class="my-0 font-weight-bold">Faturas selecionadas</h4>
                                    </div>
                                    <span
                                        class="total-count badge badge-secondary badge-pill px-3 py-0 d-flex justify-content-center align-items-center "></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Valor:</h6>
                                        {{--                                            <small class="text-muted">Brief description</small>--}}
                                    </div>
                                    <span class="text-muted">R$
                                        <span class="text-muted total-sum"></span>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Juros + Multa:</h6>
                                        {{--                                            <small class="text-muted">Brief description</small>--}}
                                    </div>
                                    <span class="text-muted">R$
                                        <span class="text-muted total-fees"></span>
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between" style="font-size: 1.1rem">
                                    <strong>Valor total: </strong>
                                    <strong>R$<span class="total-cart pl-1"></span></strong>
                                </li>
                            </ul>
                            <div class="checkout-controls">
                                <div class="row flex flex-column">
                                    <div class="col-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="w-100">
                                                <h5 id="methodTitle" class=" font-weight-bold p-1">Escolha a forma de pagamento</h5>
                                            </div>
                                            <div class="tab-pane fade justify-content-center" id="v-pills-qrcode"
                                                 role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="py-2"><h5>Leia o qrcode com seu app</h5></div>

                                                <div id="container-qrcode">
                                                    <div class="body-popup-qrcode">
                                                        <div class="qrcode-container">
                                                            <img width="80%"
                                                                 alt="qrcode"
                                                                 id="qrcode-img"
                                                                 src="{{ asset('assets/img/loading2.svg') }}"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="javascript:void(0)" type="button" class="text-primary p-2">
                                                    <p class="py-3">PIX COPIA E COLA</p>
                                                </a>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-card" role="tabpanel"
                                                 aria-labelledby="v-pills-messages-tab">
                                                <form id="form_checkout" method="POST"
                                                      action="{{route('central.checkout')}}">
                                                    <div class="row">
                                                        <div class="pl-3 justify-content-center text-black-50"><span>Preencha com dados do cartão</span>
                                                        </div>

                                                        <div id="inputs-hidden" class="form-row d-none">
                                                            <input id="customer" name="customer"
                                                                   value="{{session('customer')->id}}"
                                                                   type="text" hidden>
                                                            <input id="cartBillets" name="billets" type="text" hidden>
                                                            <input id="ip_address" value="1.1.1.1" name="ip_address"
                                                                   type="text" hidden>
                                                            <input id="full_name" name="full_name" type="text"
                                                                   value="{{session('customer')->full_name}}" hidden>
                                                            <input id="email" name="email" type="text"
                                                                   value="{{session('customer')->email}}" hidden>
                                                            <input id="cpf_cnpj" name="cpf_cnpj" type="text"
                                                                   value="{{session('customer')->document}}" hidden>
                                                            <input id="phone" name="phone" type="text"
                                                                   value="{{session('customer')->phone}}" hidden>
                                                            <input id="payment_type" name="payment_type" type="text"
                                                                   hidden>
                                                            {{--                                                        <input id="cpf_cnpj_type" name="cpf_cnpj_type" type="text" hidden>--}}
                                                            <input id="token" type="hidden" name="_token"
                                                                   value="{{ csrf_token() }}"/>
                                                            <input id="method" name="method" type="text" hidden>
                                                            {{--                                                        <input id="terminal_id" name="terminal_id" type="text" value="{{Cookie::get('terminal_id')}}" hidden>--}}
                                                        </div>
                                                        <div
                                                            class="col-12 alert alert-danger text-display-error text-center justify-content-center w-100 font-weight-bold d-none"
                                                            role="alert">
                                                        </div>
                                                        <div class="col-12 mb-3 text-left">
                                                            <label for="cc-nome">Nome no cartão</label>
                                                            <input type="text" class="form-control text-uppercase"
                                                                   value="WELLINGTON FERREIRA" id="cc-nome"
                                                                   name="holder_name"
                                                                   placeholder="Nome como está no cartão">
                                                            <small
                                                                class="text-danger error-text holder_name_error"></small>
                                                        </div>
                                                        <div class="col-12 mb-3 text-left">
                                                            <label for="cc-numero">Nº do cartão</label>
                                                            <input type="text" class="form-control"
                                                                   value="5226069490151810" id="cc-numero"
                                                                   name="card_number" placeholder="0000 0000 0000 0000">
                                                            <small
                                                                class="text-danger error-text card_number_error"></small>
                                                        </div>
                                                        <div class="col-12 mb-3 text-left">
                                                            <label for="cc-bandeira">Bandeira do cartão</label>
                                                            <select id="cc-bandeira" name="bandeira"
                                                                    class="form-control">
                                                                <option disabled>Selecionar</option>
                                                                <option value="American Express">American Express
                                                                </option>
                                                                <option value="Aura">Aura</option>
                                                                <option value="Banescard">Banescard</option>
                                                                <option value="Cabal">Cabal</option>
                                                                <option value="Dinners">Dinners</option>
                                                                <option value="Elo">Elo</option>
                                                                <option value="Hipercard">Hipercard</option>
                                                                <option selected value="Master">Master</option>
                                                                <option value="Visa">Visa</option>
                                                            </select>
                                                            <small
                                                                class="text-danger error-text bandeira_error"></small>
                                                        </div>
                                                        <div class="col-4 mb-3 text-left">
                                                            <label for="cc-expiracao">Val. Mês</label>
                                                            <input type="text" class="form-control" value="07"
                                                                   id="expiration_month" name="expiration_month"
                                                                   placeholder="Ex: 12">
                                                            <small
                                                                class="text-danger error-text expiration_month_error"></small>
                                                        </div>
                                                        <div class="col-4 mb-3 text-left">
                                                            <label for="cc-expiracao">Val. Ano</label>
                                                            <input type="text" class="form-control" value="2023"
                                                                   id="expiration_year" name="expiration_year"
                                                                   placeholder="Ex: 2028">
                                                            <small
                                                                class="text-danger error-text expiration_year_error"></small>
                                                        </div>
                                                        <div class="col-4 mb-3 text-left">
                                                            <label for="cc-cvv">Cód. seg</label>
                                                            <input type="text" class="form-control" value="271"
                                                                   id="cc-cvv" name="cvv" placeholder="Ex: 123">
                                                            <small class="text-danger error-text cvv_error"></small>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-success" style="width: calc(100% - 3%);"
                                                                type="submit">Finalizar pagamento
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                             aria-orientation="vertical">
                                            <button class="btn btn-windx mb-1 btn-payment-type" id="btn-pix"
                                                    data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                                    role="tab" aria-controls="v-pills-qrcode" aria-selected="false">PIX
                                            </button>
                                            <button class="btn btn-windx mb-1 btn-payment-type" id="btn-picpay"
                                                    data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                                    role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                                                PICPAY
                                            </button>
                                            <button class="btn btn-windx mb-1 btn-payment-type" id="btn-credit"
                                                    data-toggle="pill" data-target="#v-pills-card" type="button"
                                                    role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                CRÉDITO
                                            </button>
                                            <button class="btn btn-windx mb-1 btn-payment-type" id="btn-debit"
                                                    data-toggle="pill" data-target="#v-pills-card" type="button"
                                                    role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                DÉBITO
                                            </button>
                                        </div>
                                        <button type="button" id="clear-cart" style="width: calc(100% - 3%);"
                                                class="btn btn-danger clear-cart mt-2 btn-radius-50"
                                                disabled>Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        faturas--}}
                        <div class="{{count(session('customer')->billets) == 0 ? 'col-lg-12': 'col-lg-9'}} order-lg-1 col-md-6 order-md-1 col-sm-6 order-sm-1 py-2 pl-lg-0 pl-md-1">
                            <h4 class="mb-3">Selecione a fatura a pagar</h4>
{{--                            {{ dd(\App\Helpers\WorkingDays::checkDate('2022-01-01T00:00:00'), session('customer')->billets) }}--}}

                            <div class="table-responsive">
                                <table id="table-invoices" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="padding: .3rem !important;">Nosso Nº</th>
                                        <th style="padding: .3rem !important;">Referência</th>
                                        <th style="padding: .3rem !important;">Vencimento</th>
                                        <th style="padding: .3rem !important;">Valor</th>
                                        <th style="padding: .3rem !important;">Juros + Multa</th>
                                        <th style="padding: .3rem !important;">Total</th>
                                        <th style="padding: .3rem !important;">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count(session('customer')->billets) != 0)
                                        @foreach(session('customer')->billets as $key => $billet)
                                            <tr id="invoice-{{$key}}" data-id="{{ $billet->Id }}" class="{{ ($billet->Vencimento < date('Y-m-d\TH:i:s')) ? 'text-red-50' : '' }}">
                                                <td hidden>{{ $billet->Id }}</td>
                                                <td hidden>{{ $fees = \App\Services\Functions::calcFees($billet->Vencimento, $billet->Valor) }}</td>
                                                <td data-label="Nosso Nº">{{ $billet->NossoNumero }}</td>
                                                <td data-label="Referência">{{ $billet->Referencia != '' ? $billet->Referencia : 'SEM REFERÊNCIA' }}</td>
                                                <td data-label="Vencimento">{!! $dueDate = \App\Services\Functions::dateToPt($billet->Vencimento) !!}</td>
                                                <td data-label="Valor">
                                                    R$ {{ number_format($billet->Valor, 2, ',', '') }}</td>
                                                <td data-label="Juros + Multa">{{ number_format($fees, 2, '.', '') }}</td>
                                                <td data-label="Total">{{ number_format($fees + $billet->Valor, 2, '.', '') }}</td>
                                                <td class="btnInvoiceAction">
                                                    <a href="#" id="copy-barcode-{{$key}}" class="btn btn-primary btn-sm click" data-id="{{ $billet->Id }}"
                                                       onclick="copyBarcode3(this)" data-code="{{$billet->LinhaDigitavel}}">
                                                        <i class="fa fa-barcode" aria-hidden="true"></i> <span class="action-name">copiar</span>
                                                    </a>
                                                    <a target="_blank" href="{{ env('API_URL_VIGO_PROD').$billet->Link }}"
                                                       id="print-billet-{{$key}}"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        <span class="action-name">baixar</span>
                                                    </a>
                                                    <a href="#" id="select-billet-{{$key}}"
                                                       class="add-to-cart btn btn-success btn-sm"
                                                       data-reference="{{ $billet->NossoNumero }}" data-value="{{ $billet->Valor }}"
                                                       data-duedate="{!! $dueDate !!}"
                                                       data-id="{{ strval($billet->Id) }}" data-discount="{{ 0 }}"

{{--                                                       @if(\App\Helpers\WorkingDays::hasFees('2023-09-07T00:00:00'))--}}
{{--                                                       @if(\App\Helpers\WorkingDays::hasFees('2023-07-15T00:00:00'))--}}
                                                       @if(\App\Helpers\WorkingDays::hasFees($billet->Vencimento))
                                                       data-price="{{ number_format($billet->Valor, 2, '.', '') }}"
                                                       data-addition="{{ number_format(0, 2, '.', '') }}"
                                                       @else
                                                       data-price="{{ number_format($fees + $billet->Valor, 2, '.', '') }}"
                                                       data-addition="{{ number_format($fees, 2, '.', '') }}"
                                                       @endif

{{--                                                        onclick="loadingAddInvoice()"--}}
                                                    >
                                                        <i class="fa fa-check" aria-hidden="true"></i>
{{--                                                        <i class="fas fa-spinner fa-pulse d-none"></i>--}}
                                                        <span class="action-name">pagar</span>
                                                    </a>
                                                    <a href="#" id="remove-billet-{{$key}}"
                                                       class="btn btn-danger btn-sm delete-item d-none"
                                                       data-reference="{{ $billet->NossoNumero }}" data-id="{{ $billet->Id }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        <span class="action-name">remover</span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <h4 style="color: #002046; padding: 1rem">Não existem faturas pendentes!<br><br>
                                                    Obrigado pela pontualidade
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-emoji-wink" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm1.757-.437a.5.5 0 0 1 .68.194.934.934 0 0 0 .813.493c.339 0 .645-.19.813-.493a.5.5 0 1 1 .874.486A1.934 1.934 0 0 1 10.25 7.75c-.73 0-1.356-.412-1.687-1.007a.5.5 0 0 1 .194-.68z"/>
                                                    </svg>
                                                </h4>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .owl-item {
            margin-top: -15px;
        }

        .invoice-content .btn {
            display: block
        }

        .checkout-controls .btn {
            margin: 5px !important
        }

        .checkout-controls .list-group-item {
            padding: 0;
            border: 0;
        }

        #table-invoices {
            border-radius: .5rem;
        }

        #table-invoices .btn {
            border-radius: .4rem;
            margin: 10px 5px;
            padding: 8px 10px;
            font-size: 12px;
        }

        #table-invoices tr {
            color: #5a6268;
        }
        #table-invoices tr td {
            background-color: white;
        }

        .table thead th {
            padding: .3rem;
        !important;
        }

        @media (max-width: 1250px) {
            .btnInvoiceAction {
                display: flex;
                justify-content: end;
            }

            .btnInvoiceAction .btn {
                display: block;
                width: 100%;
            }

        }

        @media (max-width: 850px) {
            .sideMenu{
                max-width: 50%;
            }

            h4, .h4 {
                font-size: 1.15rem;
            }

        }
        @media (max-width: 575px) {
            .sideMenu{
                max-width: 80%;
            }
            h4, .h4 {
                font-size: 1rem;
            }
        }

        @media (max-width: 1100px) {
            .container-fluid {
                margin-top: 0 !important;
            }

            h4, .h4 {
                font-size: 1.15rem;
            }

            .header-page {
                display: none;
            }

            .sideMenu{
                max-width: 40%;
            }

            .action-name {
                display: none
            }

            table thead {
                display: none;
            }

            table tr {
                display: flex;
                flex-direction: column;
                /*border: 3px solid white;*/
                padding: 2px;
            }


            table td[data-label] {
                display: flex;
                font-weight: bold;
            }

            table td[data-label]::before {
                content: attr(data-label);
                color: #002046;
                font-weight: bold;
                width: 50%;
                text-align: left;
                padding: .2rem .4rem;
            }


        }

        .flex-container {
            padding: 0.5rem;
            margin: 2rem auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .flex-item {
            background: grey;
            color: white;
            font-weight: bold;
            font-size: 2rem;
            text-align: center;
            padding: 0.5rem;
            margin: 0.5rem;
            flex: 1 1 auto;

        }

        .flex-item .btn {
            border-radius: .4rem;
        }

        @media screen and (min-width: 320px) {
            .flex-item {
                width: 100%
            }
        }

        @media screen and (min-width: 640px) {
            .flex-item {
                width: calc(50% - 1rem)
            }
        }

        @media screen and (min-width: 1100px) {
            .flex-item {
                width: calc(25% - 1rem)
            }
        }


        .payment-container {
            /*display: block;*/
            margin: 0 auto;
            padding: 40px 20px;
            width: 100%;
        }

        .payment-container header {
            margin-bottom: 40px;
            text-align: center;
        }

        .payment-container header h2 {
            font-size: 24px;
            line-height: 24px;
        }

        .payment-container header h3 {
            font-size: 16px;
            font-weight: 300;
        }

        .payment-container .payment-item {
            /*background: linear-gradient(#fbfbfb 0%, #f0f0f0 100%);*/
            /*border: 1px solid #dcdcdc;*/
            /*border-radius: 5px;*/
            display: block;
            /*margin: 0 0 20px;*/
            /*padding: 40px;*/
            width: 100%;
        }

        .payment-container .payment-item:after {
            clear: both;
            content: '';
            display: table;
        }

        .payment-container .payment-item .item-title,
        .payment-container .payment-item .item-options {
            display: block;
            width: 100%;
            margin-right: -4px;
            position: relative;
            vertical-align: top;
        }

        .payment-container .payment-item .item-title {
            font-weight: 600;
            /*width: 40%;*/
        }

        .payment-container .payment-item .item-title span {
            color: #d0021b;
        }

        .payment-container .payment-item .item-options {
            width: 100%;
        }

        .payment-container .payment-item .item-options .selection {
            cursor: pointer;
            display: block;
            position: relative;
            width: 100%;
        }

        .payment-container .payment-item .item-title {
            margin-bottom: 20px;
        }

        .payment-container .payment-item .item-options .selection .check,
        .payment-container .payment-item .item-options .selection label {
            transition: 250ms ease all;
        }

        .payment-container .payment-item .item-options .selection .check {
            background: #fff;
            border: 1px solid #d2d2d2;
            border-radius: 100px;
            content: '';
            height: 14px;
            left: 10px;
            position: absolute;
            top: 18px;
            width: 14px;
        }

        .payment-container .payment-item .item-options .selection label {
            background: #f7f7f7;
            border: 1px solid #d2d2d2;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 0 10px 0;
            padding: 10px 10px 10px 30px;
            position: relative;
            width: 100%;
        }

        .payment-container .payment-item .item-options .selection label:hover {
            background: #fff;
        }

        .payment-container .payment-item .item-options .selection span {
            float: right;
        }

        .payment-container .payment-item .item-options input {
            display: none;
        }

        .payment-container .payment-item .item-options input[type=radio]:checked ~ .check {
            border-color: #000;
        }

        .payment-container .payment-item .item-options input[type=radio]:checked ~ .check:before {
            background: #000;
            border-radius: 100px;
            content: '';
            height: 6px;
            left: 3px;
            position: absolute;
            top: 3px;
            width: 6px;
        }

        .payment-container .payment-item .item-options input[type=radio]:checked ~ label {
            background: linear-gradient(#8e8e8e 0%, #555 100%);
            border-color: #000;
            color: #fff;
        }

        /*@media (max-width: 600px) {*/
        /*    .payment-container .payment-item .item-title,*/
        /*    .payment-container .payment-item .item-options {*/
        /*        display: block;*/
        /*        width: 100%;*/
        /*    }*/
        /*    */
        /*}*/


        .checkout-controls {
            width: 100%;
            display: block;
            border-radius: .5rem;
            background-color: #fff !important;
            padding: 1rem;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
@endsection

@section('js')
    <script>
        var idCustomer = {{session('customer')->id}};
        var customerActive = @json(session('customer'));
        const holidays = {
            "2023-01-01": "Confraternização Universal",
            "2023-02-21": "Carnaval",
            "2023-04-07": "Paixão de Cristo",
            "2023-04-21": "Tiradentes",
            "2023-05-01": "Dia do Trabalho",
            "2023-06-08": "Corpus Christi",
            "2023-08-13": "Dia dos Pais",
            "2023-09-07": "Independência do Brasil",
            "2023-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2023-11-02": "Finados",
            "2023-11-15": "Proclamação da República",
            "2023-12-25": "Natal",
            "2024-01-01": "Confraternização Universal",
            "2024-02-13": "Carnaval",
            "2024-03-29": "Paixão de Cristo",
            "2024-04-21": "Tiradentes",
            "2024-05-01": "Dia do Trabalho",
            "2024-05-30": "Corpus Christi",
            "2024-08-11": "Dia dos Pais",
            "2024-09-07": "Independência do Brasil",
            "2024-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2024-11-02": "Finados",
            "2024-11-15": "Proclamação da República",
            "2024-12-25": "Natal",
            "2025-01-01": "Confraternização Universal",
            "2025-03-04": "Carnaval",
            "2025-04-18": "Paixão de Cristo",
            "2025-04-21": "Tiradentes",
            "2025-05-01": "Dia do Trabalho",
            "2025-06-19": "Corpus Christi",
            "2025-08-10": "Dia dos Pais",
            "2025-09-07": "Independência do Brasil",
            "2025-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2025-11-02": "Finados",
            "2025-11-15": "Proclamação da República",
            "2025-12-25": "Natal",
            "2026-01-01": "Confraternização Universal",
            "2026-02-17": "Carnaval",
            "2026-04-03": "Paixão de Cristo",
            "2026-04-21": "Tiradentes",
            "2026-05-01": "Dia do Trabalho",
            "2026-06-04": "Corpus Christi",
            "2026-08-09": "Dia dos Pais",
            "2026-09-07": "Independência do Brasil",
            "2026-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2026-11-02": "Finados",
            "2026-11-15": "Proclamação da República",
            "2026-12-25": "Natal",
            "2027-01-01": "Confraternização Universal",
            "2027-02-09": "Carnaval",
            "2027-03-26": "Paixão de Cristo",
            "2027-04-21": "Tiradentes",
            "2027-05-01": "Dia do Trabalho",
            "2027-05-27": "Corpus Christi",
            "2027-08-08": "Dia dos Pais",
            "2027-09-07": "Independência do Brasil",
            "2027-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2027-11-02": "Finados",
            "2027-11-15": "Proclamação da República",
            "2027-12-25": "Natal",
            "2028-01-01": "Confraternização Universal",
            "2028-02-29": "Carnaval",
            "2028-04-14": "Paixão de Cristo",
            "2028-04-21": "Tiradentes",
            "2028-05-01": "Dia do Trabalho",
            "2028-06-15": "Corpus Christi",
            "2028-09-07": "Independência do Brasil",
            "2028-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2028-11-02": "Finados",
            "2028-11-15": "Proclamação da República",
            "2028-12-25": "Natal",
            "2029-01-01": "Confraternização Universal",
            "2029-02-13": "Carnaval",
            "2029-03-30": "Paixão de Cristo",
            "2029-04-21": "Tiradentes",
            "2029-05-01": "Dia do Trabalho",
            "2029-05-31": "Corpus Christi",
            "2029-09-07": "Independência do Brasil",
            "2029-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2029-11-02": "Finados",
            "2029-11-15": "Proclamação da República",
            "2029-12-25": "Natal",
            "2030-01-01": "Confraternização Universal",
            "2030-03-05": "Carnaval",
            "2030-04-19": "Paixão de Cristo",
            "2030-04-21": "Tiradentes",
            "2030-05-01": "Dia do Trabalho",
            "2030-06-20": "Corpus Christi",
            "2030-09-07": "Independência do Brasil",
            "2030-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2030-11-02": "Finados",
            "2030-11-15": "Proclamação da República",
            "2030-12-25": "Natal",
            "2031-01-01": "Confraternização Universal",
            "2031-02-25": "Carnaval",
            "2031-04-11": "Paixão de Cristo",
            "2031-04-21": "Tiradentes",
            "2031-05-01": "Dia do Trabalho",
            "2031-06-12": "Corpus Christi",
            "2031-09-07": "Independência do Brasil",
            "2031-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2031-11-02": "Finados",
            "2031-11-15": "Proclamação da República",
            "2031-12-25": "Natal",
            "2032-01-01": "Confraternização Universal",
            "2032-02-10": "Carnaval",
            "2032-03-26": "Paixão de Cristo",
            "2032-04-21": "Tiradentes",
            "2032-05-01": "Dia do Trabalho",
            "2032-05-27": "Corpus Christi",
            "2032-09-07": "Independência do Brasil",
            "2032-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2032-11-02": "Finados",
            "2032-11-15": "Proclamação da República",
            "2032-12-25": "Natal",
            "2033-01-01": "Confraternização Universal",
            "2033-03-01": "Carnaval",
            "2033-04-15": "Paixão de Cristo",
            "2033-04-21": "Tiradentes",
            "2033-05-01": "Dia do Trabalho",
            "2033-06-16": "Corpus Christi",
            "2033-09-07": "Independência do Brasil",
            "2033-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2033-11-02": "Finados",
            "2033-11-15": "Proclamação da República",
            "2033-12-25": "Natal",
            "2034-01-01": "Confraternização Universal",
            "2034-02-21": "Carnaval",
            "2034-04-07": "Paixão de Cristo",
            "2034-04-21": "Tiradentes",
            "2034-05-01": "Dia do Trabalho",
            "2034-06-08": "Corpus Christi",
            "2034-09-07": "Independência do Brasil",
            "2034-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2034-11-02": "Finados",
            "2034-11-15": "Proclamação da República",
            "2034-12-25": "Natal",
            "2035-01-01": "Confraternização Universal",
            "2035-02-06": "Carnaval",
            "2035-03-23": "Paixão de Cristo",
            "2035-04-21": "Tiradentes",
            "2035-05-01": "Dia do Trabalho",
            "2035-05-24": "Corpus Christi",
            "2035-09-07": "Independência do Brasil",
            "2035-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2035-11-02": "Finados",
            "2035-11-15": "Proclamação da República",
            "2035-12-25": "Natal",
            "2036-01-01": "Confraternização Universal",
            "2036-02-26": "Carnaval",
            "2036-04-11": "Paixão de Cristo",
            "2036-04-21": "Tiradentes",
            "2036-05-01": "Dia do Trabalho",
            "2036-06-12": "Corpus Christi",
            "2036-09-07": "Independência do Brasil",
            "2036-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2036-11-02": "Finados",
            "2036-11-15": "Proclamação da República",
            "2036-12-25": "Natal",
            "2037-01-01": "Confraternização Universal",
            "2037-02-17": "Carnaval",
            "2037-04-03": "Paixão de Cristo",
            "2037-04-21": "Tiradentes",
            "2037-05-01": "Dia do Trabalho",
            "2037-06-04": "Corpus Christi",
            "2037-09-07": "Independência do Brasil",
            "2037-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2037-11-02": "Finados",
            "2037-11-15": "Proclamação da República",
            "2037-12-25": "Natal",
            "2038-01-01": "Confraternização Universal",
            "2038-03-09": "Carnaval",
            "2038-04-21": "Tiradentes",
            "2038-04-23": "Paixão de Cristo",
            "2038-05-01": "Dia do Trabalho",
            "2038-06-24": "Corpus Christi",
            "2038-09-07": "Independência do Brasil",
            "2038-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2038-11-02": "Finados",
            "2038-11-15": "Proclamação da República",
            "2038-12-25": "Natal",
            "2039-01-01": "Confraternização Universal",
            "2039-02-22": "Carnaval",
            "2039-04-08": "Paixão de Cristo",
            "2039-04-21": "Tiradentes",
            "2039-05-01": "Dia do Trabalho",
            "2039-06-09": "Corpus Christi",
            "2039-09-07": "Independência do Brasil",
            "2039-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2039-11-02": "Finados",
            "2039-11-15": "Proclamação da República",
            "2039-12-25": "Natal",
            "2040-01-01": "Confraternização Universal",
            "2040-02-14": "Carnaval",
            "2040-03-30": "Paixão de Cristo",
            "2040-04-21": "Tiradentes",
            "2040-05-01": "Dia do Trabalho",
            "2040-05-31": "Corpus Christi",
            "2040-09-07": "Independência do Brasil",
            "2040-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2040-11-02": "Finados",
            "2040-11-15": "Proclamação da República",
            "2040-12-25": "Natal",
            "2041-01-01": "Confraternização Universal",
            "2041-03-05": "Carnaval",
            "2041-04-19": "Paixão de Cristo",
            "2041-04-21": "Tiradentes",
            "2041-05-01": "Dia do Trabalho",
            "2041-06-20": "Corpus Christi",
            "2041-09-07": "Independência do Brasil",
            "2041-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2041-11-02": "Finados",
            "2041-11-15": "Proclamação da República",
            "2041-12-25": "Natal",
            "2042-01-01": "Confraternização Universal",
            "2042-02-18": "Carnaval",
            "2042-04-04": "Paixão de Cristo",
            "2042-04-21": "Tiradentes",
            "2042-05-01": "Dia do Trabalho",
            "2042-06-05": "Corpus Christi",
            "2042-09-07": "Independência do Brasil",
            "2042-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2042-11-02": "Finados",
            "2042-11-15": "Proclamação da República",
            "2042-12-25": "Natal",
            "2043-01-01": "Confraternização Universal",
            "2043-02-10": "Carnaval",
            "2043-03-27": "Paixão de Cristo",
            "2043-04-21": "Tiradentes",
            "2043-05-01": "Dia do Trabalho",
            "2043-05-28": "Corpus Christi",
            "2043-09-07": "Independência do Brasil",
            "2043-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2043-11-02": "Finados",
            "2043-11-15": "Proclamação da República",
            "2043-12-25": "Natal",
            "2044-01-01": "Confraternização Universal",
            "2044-03-01": "Carnaval",
            "2044-04-15": "Paixão de Cristo",
            "2044-04-21": "Tiradentes",
            "2044-05-01": "Dia do Trabalho",
            "2044-06-16": "Corpus Christi",
            "2044-09-07": "Independência do Brasil",
            "2044-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2044-11-02": "Finados",
            "2044-11-15": "Proclamação da República",
            "2044-12-25": "Natal",
            "2045-01-01": "Confraternização Universal",
            "2045-02-21": "Carnaval",
            "2045-04-07": "Paixão de Cristo",
            "2045-04-21": "Tiradentes",
            "2045-05-01": "Dia do Trabalho",
            "2045-06-08": "Corpus Christi",
            "2045-09-07": "Independência do Brasil",
            "2045-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2045-11-02": "Finados",
            "2045-11-15": "Proclamação da República",
            "2045-12-25": "Natal",
            "2046-01-01": "Confraternização Universal",
            "2046-02-06": "Carnaval",
            "2046-03-23": "Paixão de Cristo",
            "2046-04-21": "Tiradentes",
            "2046-05-01": "Dia do Trabalho",
            "2046-05-24": "Corpus Christi",
            "2046-09-07": "Independência do Brasil",
            "2046-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2046-11-02": "Finados",
            "2046-11-15": "Proclamação da República",
            "2046-12-25": "Natal",
            "2047-01-01": "Confraternização Universal",
            "2047-02-26": "Carnaval",
            "2047-04-12": "Paixão de Cristo",
            "2047-04-21": "Tiradentes",
            "2047-05-01": "Dia do Trabalho",
            "2047-06-13": "Corpus Christi",
            "2047-09-07": "Independência do Brasil",
            "2047-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2047-11-02": "Finados",
            "2047-11-15": "Proclamação da República",
            "2047-12-25": "Natal",
            "2048-01-01": "Confraternização Universal",
            "2048-02-18": "Carnaval",
            "2048-04-03": "Paixão de Cristo",
            "2048-04-21": "Tiradentes",
            "2048-05-01": "Dia do Trabalho",
            "2048-06-04": "Corpus Christi",
            "2048-09-07": "Independência do Brasil",
            "2048-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2048-11-02": "Finados",
            "2048-11-15": "Proclamação da República",
            "2048-12-25": "Natal",
            "2049-01-01": "Confraternização Universal",
            "2049-03-02": "Carnaval",
            "2049-04-16": "Paixão de Cristo",
            "2049-04-21": "Tiradentes",
            "2049-05-01": "Dia do Trabalho",
            "2049-06-17": "Corpus Christi",
            "2049-09-07": "Independência do Brasil",
            "2049-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2049-11-02": "Finados",
            "2049-11-15": "Proclamação da República",
            "2049-12-25": "Natal",
            "2050-01-01": "Confraternização Universal",
            "2050-02-22": "Carnaval",
            "2050-04-08": "Paixão de Cristo",
            "2050-04-21": "Tiradentes",
            "2050-05-01": "Dia do Trabalho",
            "2050-06-09": "Corpus Christi",
            "2050-09-07": "Independência do Brasil",
            "2050-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2050-11-02": "Finados",
            "2050-11-15": "Proclamação da República",
            "2050-12-25": "Natal",
            "2051-01-01": "Confraternização Universal",
            "2051-02-14": "Carnaval",
            "2051-03-31": "Paixão de Cristo",
            "2051-04-21": "Tiradentes",
            "2051-05-01": "Dia do Trabalho",
            "2051-06-01": "Corpus Christi",
            "2051-09-07": "Independência do Brasil",
            "2051-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2051-11-02": "Finados",
            "2051-11-15": "Proclamação da República",
            "2051-12-25": "Natal",
            "2052-01-01": "Confraternização Universal",
            "2052-03-05": "Carnaval",
            "2052-04-19": "Paixão de Cristo",
            "2052-04-21": "Tiradentes",
            "2052-05-01": "Dia do Trabalho",
            "2052-06-20": "Corpus Christi",
            "2052-09-07": "Independência do Brasil",
            "2052-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2052-11-02": "Finados",
            "2052-11-15": "Proclamação da República",
            "2052-12-25": "Natal",
            "2053-01-01": "Confraternização Universal",
            "2053-02-18": "Carnaval",
            "2053-04-04": "Paixão de Cristo",
            "2053-04-21": "Tiradentes",
            "2053-05-01": "Dia do Trabalho",
            "2053-06-05": "Corpus Christi",
            "2053-09-07": "Independência do Brasil",
            "2053-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2053-11-02": "Finados",
            "2053-11-15": "Proclamação da República",
            "2053-12-25": "Natal",
            "2054-01-01": "Confraternização Universal",
            "2054-02-10": "Carnaval",
            "2054-03-27": "Paixão de Cristo",
            "2054-04-21": "Tiradentes",
            "2054-05-01": "Dia do Trabalho",
            "2054-05-28": "Corpus Christi",
            "2054-09-07": "Independência do Brasil",
            "2054-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2054-11-02": "Finados",
            "2054-11-15": "Proclamação da República",
            "2054-12-25": "Natal",
            "2055-01-01": "Confraternização Universal",
            "2055-03-02": "Carnaval",
            "2055-04-16": "Paixão de Cristo",
            "2055-04-21": "Tiradentes",
            "2055-05-01": "Dia do Trabalho",
            "2055-06-17": "Corpus Christi",
            "2055-09-07": "Independência do Brasil",
            "2055-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2055-11-02": "Finados",
            "2055-11-15": "Proclamação da República",
            "2055-12-25": "Natal",
            "2056-01-01": "Confraternização Universal",
            "2056-02-15": "Carnaval",
            "2056-03-31": "Paixão de Cristo",
            "2056-04-21": "Tiradentes",
            "2056-05-01": "Dia do Trabalho",
            "2056-06-01": "Corpus Christi",
            "2056-09-07": "Independência do Brasil",
            "2056-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2056-11-02": "Finados",
            "2056-11-15": "Proclamação da República",
            "2056-12-25": "Natal",
            "2057-01-01": "Confraternização Universal",
            "2057-03-06": "Carnaval",
            "2057-04-20": "Paixão de Cristo",
            "2057-04-21": "Tiradentes",
            "2057-05-01": "Dia do Trabalho",
            "2057-06-21": "Corpus Christi",
            "2057-09-07": "Independência do Brasil",
            "2057-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2057-11-02": "Finados",
            "2057-11-15": "Proclamação da República",
            "2057-12-25": "Natal",
            "2058-01-01": "Confraternização Universal",
            "2058-02-26": "Carnaval",
            "2058-04-12": "Paixão de Cristo",
            "2058-04-21": "Tiradentes",
            "2058-05-01": "Dia do Trabalho",
            "2058-06-13": "Corpus Christi",
            "2058-09-07": "Independência do Brasil",
            "2058-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2058-11-02": "Finados",
            "2058-11-15": "Proclamação da República",
            "2058-12-25": "Natal",
            "2059-01-01": "Confraternização Universal",
            "2059-02-11": "Carnaval",
            "2059-03-28": "Paixão de Cristo",
            "2059-04-21": "Tiradentes",
            "2059-05-01": "Dia do Trabalho",
            "2059-05-29": "Corpus Christi",
            "2059-09-07": "Independência do Brasil",
            "2059-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2059-11-02": "Finados",
            "2059-11-15": "Proclamação da República",
            "2059-12-25": "Natal",
            "2060-01-01": "Confraternização Universal",
            "2060-03-02": "Carnaval",
            "2060-04-16": "Paixão de Cristo",
            "2060-04-21": "Tiradentes",
            "2060-05-01": "Dia do Trabalho",
            "2060-06-17": "Corpus Christi",
            "2060-09-07": "Independência do Brasil",
            "2060-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2060-11-02": "Finados",
            "2060-11-15": "Proclamação da República",
            "2060-12-25": "Natal",
            "2061-01-01": "Confraternização Universal",
            "2061-02-22": "Carnaval",
            "2061-04-08": "Paixão de Cristo",
            "2061-04-21": "Tiradentes",
            "2061-05-01": "Dia do Trabalho",
            "2061-06-09": "Corpus Christi",
            "2061-09-07": "Independência do Brasil",
            "2061-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2061-11-02": "Finados",
            "2061-11-15": "Proclamação da República",
            "2061-12-25": "Natal",
            "2062-01-01": "Confraternização Universal",
            "2062-02-07": "Carnaval",
            "2062-03-24": "Paixão de Cristo",
            "2062-04-21": "Tiradentes",
            "2062-05-01": "Dia do Trabalho",
            "2062-05-25": "Corpus Christi",
            "2062-09-07": "Independência do Brasil",
            "2062-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2062-11-02": "Finados",
            "2062-11-15": "Proclamação da República",
            "2062-12-25": "Natal",
            "2063-01-01": "Confraternização Universal",
            "2063-02-27": "Carnaval",
            "2063-04-13": "Paixão de Cristo",
            "2063-04-21": "Tiradentes",
            "2063-05-01": "Dia do Trabalho",
            "2063-06-14": "Corpus Christi",
            "2063-09-07": "Independência do Brasil",
            "2063-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2063-11-02": "Finados",
            "2063-11-15": "Proclamação da República",
            "2063-12-25": "Natal",
            "2064-01-01": "Confraternização Universal",
            "2064-02-19": "Carnaval",
            "2064-04-04": "Paixão de Cristo",
            "2064-04-21": "Tiradentes",
            "2064-05-01": "Dia do Trabalho",
            "2064-06-05": "Corpus Christi",
            "2064-09-07": "Independência do Brasil",
            "2064-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2064-11-02": "Finados",
            "2064-11-15": "Proclamação da República",
            "2064-12-25": "Natal",
            "2065-01-01": "Confraternização Universal",
            "2065-02-10": "Carnaval",
            "2065-03-27": "Paixão de Cristo",
            "2065-04-21": "Tiradentes",
            "2065-05-01": "Dia do Trabalho",
            "2065-05-28": "Corpus Christi",
            "2065-09-07": "Independência do Brasil",
            "2065-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2065-11-02": "Finados",
            "2065-11-15": "Proclamação da República",
            "2065-12-25": "Natal",
            "2066-01-01": "Confraternização Universal",
            "2066-02-23": "Carnaval",
            "2066-04-09": "Paixão de Cristo",
            "2066-04-21": "Tiradentes",
            "2066-05-01": "Dia do Trabalho",
            "2066-06-10": "Corpus Christi",
            "2066-09-07": "Independência do Brasil",
            "2066-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2066-11-02": "Finados",
            "2066-11-15": "Proclamação da República",
            "2066-12-25": "Natal",
            "2067-01-01": "Confraternização Universal",
            "2067-02-15": "Carnaval",
            "2067-04-01": "Paixão de Cristo",
            "2067-04-21": "Tiradentes",
            "2067-05-01": "Dia do Trabalho",
            "2067-06-02": "Corpus Christi",
            "2067-09-07": "Independência do Brasil",
            "2067-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2067-11-02": "Finados",
            "2067-11-15": "Proclamação da República",
            "2067-12-25": "Natal",
            "2068-01-01": "Confraternização Universal",
            "2068-03-06": "Carnaval",
            "2068-04-20": "Paixão de Cristo",
            "2068-04-21": "Tiradentes",
            "2068-05-01": "Dia do Trabalho",
            "2068-06-21": "Corpus Christi",
            "2068-09-07": "Independência do Brasil",
            "2068-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2068-11-02": "Finados",
            "2068-11-15": "Proclamação da República",
            "2068-12-25": "Natal",
            "2069-01-01": "Confraternização Universal",
            "2069-02-26": "Carnaval",
            "2069-04-12": "Paixão de Cristo",
            "2069-04-21": "Tiradentes",
            "2069-05-01": "Dia do Trabalho",
            "2069-06-13": "Corpus Christi",
            "2069-09-07": "Independência do Brasil",
            "2069-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2069-11-02": "Finados",
            "2069-11-15": "Proclamação da República",
            "2069-12-25": "Natal",
            "2070-01-01": "Confraternização Universal",
            "2070-02-11": "Carnaval",
            "2070-03-28": "Paixão de Cristo",
            "2070-04-21": "Tiradentes",
            "2070-05-01": "Dia do Trabalho",
            "2070-05-29": "Corpus Christi",
            "2070-09-07": "Independência do Brasil",
            "2070-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2070-11-02": "Finados",
            "2070-11-15": "Proclamação da República",
            "2070-12-25": "Natal",
            "2071-01-01": "Confraternização Universal",
            "2071-03-03": "Carnaval",
            "2071-04-17": "Paixão de Cristo",
            "2071-04-21": "Tiradentes",
            "2071-05-01": "Dia do Trabalho",
            "2071-06-18": "Corpus Christi",
            "2071-09-07": "Independência do Brasil",
            "2071-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2071-11-02": "Finados",
            "2071-11-15": "Proclamação da República",
            "2071-12-25": "Natal",
            "2072-01-01": "Confraternização Universal",
            "2072-02-23": "Carnaval",
            "2072-04-08": "Paixão de Cristo",
            "2072-04-21": "Tiradentes",
            "2072-05-01": "Dia do Trabalho",
            "2072-06-09": "Corpus Christi",
            "2072-09-07": "Independência do Brasil",
            "2072-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2072-11-02": "Finados",
            "2072-11-15": "Proclamação da República",
            "2072-12-25": "Natal",
            "2073-01-01": "Confraternização Universal",
            "2073-02-07": "Carnaval",
            "2073-03-24": "Paixão de Cristo",
            "2073-04-21": "Tiradentes",
            "2073-05-01": "Dia do Trabalho",
            "2073-05-25": "Corpus Christi",
            "2073-09-07": "Independência do Brasil",
            "2073-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2073-11-02": "Finados",
            "2073-11-15": "Proclamação da República",
            "2073-12-25": "Natal",
            "2074-01-01": "Confraternização Universal",
            "2074-02-27": "Carnaval",
            "2074-04-13": "Paixão de Cristo",
            "2074-04-21": "Tiradentes",
            "2074-05-01": "Dia do Trabalho",
            "2074-06-14": "Corpus Christi",
            "2074-09-07": "Independência do Brasil",
            "2074-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2074-11-02": "Finados",
            "2074-11-15": "Proclamação da República",
            "2074-12-25": "Natal",
            "2075-01-01": "Confraternização Universal",
            "2075-02-19": "Carnaval",
            "2075-04-05": "Paixão de Cristo",
            "2075-04-21": "Tiradentes",
            "2075-05-01": "Dia do Trabalho",
            "2075-06-06": "Corpus Christi",
            "2075-09-07": "Independência do Brasil",
            "2075-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2075-11-02": "Finados",
            "2075-11-15": "Proclamação da República",
            "2075-12-25": "Natal",
            "2076-01-01": "Confraternização Universal",
            "2076-03-03": "Carnaval",
            "2076-04-17": "Paixão de Cristo",
            "2076-04-21": "Tiradentes",
            "2076-05-01": "Dia do Trabalho",
            "2076-06-18": "Corpus Christi",
            "2076-09-07": "Independência do Brasil",
            "2076-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2076-11-02": "Finados",
            "2076-11-15": "Proclamação da República",
            "2076-12-25": "Natal",
            "2077-01-01": "Confraternização Universal",
            "2077-02-23": "Carnaval",
            "2077-04-09": "Paixão de Cristo",
            "2077-04-21": "Tiradentes",
            "2077-05-01": "Dia do Trabalho",
            "2077-06-10": "Corpus Christi",
            "2077-09-07": "Independência do Brasil",
            "2077-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2077-11-02": "Finados",
            "2077-11-15": "Proclamação da República",
            "2077-12-25": "Natal",
            "2078-01-01": "Confraternização Universal",
            "2078-02-15": "Carnaval",
            "2078-04-01": "Paixão de Cristo",
            "2078-04-21": "Tiradentes",
            "2078-05-01": "Dia do Trabalho",
            "2078-06-02": "Corpus Christi",
            "2078-09-07": "Independência do Brasil",
            "2078-10-12": "Nossa Sr.a Aparecida - Padroeira do Brasil",
            "2078-11-02": "Finados",
            "2078-11-15": "Proclamação da República",
            "2078-12-25": "Natal"
        }

        // console.log('Holidays', holidays)

        function checkHoliday() {
            const dataFeriado = '2000-01-01';

            Object.entries(holidays).forEach(([key, value]) => {
                // dataFeriado = new Date(key)
                console.log(dataFeriado + ": " + value);
            });
            // // Obtém a data atual
            // const dataAtual = new Date();
            //
            // // Obtém a primeira chave do objeto (primeira data)
            // const primeiraData = Object.keys(holidays)[0];
            //
            //
            // // Converte a primeira data para um objeto Date
            // const dataFeriado = new Date(primeiraData);
            // console.log(dataFeriado)
            //
            // // Compara a data atual com a data do primeiro feriado
            // if (dataAtual.getTime() === dataFeriado.getTime()) {
            //     console.log(dataFeriado.getTime())
            //     console.log("A data atual coincide com o primeiro feriado!");
            // } else {
            //     console.log("A data atual não coincide com o primeiro feriado.");
            // }
        }


        $('.checkoutBtn').on('click', function () {
            const paymentType = $(this).attr('id')
            // console.log(paymentType)

            switch (paymentType) {
                case 'btn-pix':
                    console.log('Deu pix')
                    break;
                case 'btn-picpay':
                    console.log('Deu picpay')
                    break;
                case 'btn-credit':
                    console.log('Deu credito')
                    break;
                default:
                    console.log('Deu debito')
                    break;
            }

            $('#methodTitle').text($(this).text())

            $('#v-pills-tab').addClass('d-none')
            $('#v-pills-tabContent').removeClass('d-none')
        });



        // $('a.add-to-cart').on('click', function () {
        //     // $(this).children('i').removeClass('fa-check').addClass('fa-spinner fa-spin')
        //     // Swal.fire('Verificando boleto')
        //
        //     setTimeout(() => {
        //         alert('Verificando fatura!')
        //         // $(this).children('i').removeClass('fa-spinner fa-spin').addClass('fa-check')
        //     }, 5000)
        // })
        //
        // function loadingAddInvoice(thisBtn){
        //     cart = JSON.parse(sessionStorage.getItem('billetsCart'));
        //     console.log(cart)
        //     // $(thisBtn).children('i').removeClass('fa-check').addClass('fa-spinner fa-spin')
        //     // console.log('Clicou!')
        // }

        cart2 = JSON.parse(sessionStorage.getItem('billetsCart'));
        console.log(cart2)


    </script>
{{--    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>--}}
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



