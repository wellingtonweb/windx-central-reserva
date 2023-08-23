@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid ">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn p-sm-0 p-md-0">
                        <div id="infoCustomerActive"  class="d-flex col-12 order-0 py-2 px-lg-0 px-md-1 mb-2 text-windx">
                            <a href="javascript:void(0)" class="d-lg-none pr-1" onclick="toggleLineClamp()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                     class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93
                                     4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105
                                     1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275
                                      0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </a>
                            <p id="infoText" class="text-uppercase space-1 clamped px-lg-3 text-justify">
                                Contrato Nº: {{session('customer')->id}} |
                                {{session('customer')->full_name}} |
                                {{session('customer')->street}}, {{session('customer')->district}},
                                {{session('customer')->city}}
                            </p>
                        </div>
{{--                        checkout--}}
{{--                        {{count(session('customer')->billets)}}--}}
                        <div id="colCheckout" class="{{count(session('customer')->billets) == 0 ? 'd-none': ''}} col-lg-4 order-lg-2
                        col-md-6 order-md-2 col-sm-6 order-sm-2 pl-lg-0 pl-md-0
{{--                        py-2 px-lg-0 pl-md-3 pr-md-3 px-sm-0 --}}
                        mb-4">
                            <h4 class="d-flex font-weight-bold justify-content-center align-items-center mb-3">
                                Checkout
                            </h4>
                            <ul class="list-group mb-3" style="border-radius: .5rem">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h4 class="my-0 font-weight-bold">Faturas selecionadas</h4>
                                    </div>
                                    <span
                                        class="total-count badge badge-secondary badge-pill px-3 py-0 d-flex
                                        justify-content-center align-items-center"></span>
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
                                                <div class="py-2">
                                                    <h5>Leia o qrcode com seu app</h5>
                                                    <p id="timerPayment" class="text-danger mb-0" style="letter-spacing: 1px; font-size: 1.2em"></p>
                                                </div>

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
                                                <div id="boxQrString" class="p-2 d-none rounded" style="border: 2px solid rgba(0,32,70,0.6)">
                                                    <p class="py-1 qrcodestring" style="word-wrap: break-word;"></p>
                                                </div>
                                                <a id="copyPix" href="javascript:pixCopyPaste()" type="button"
                                                   class="text-primary p-2 d-none"
                                                >
                                                    <p class="py-1 font-weight-bold" style="letter-spacing: 1px">PIX COPIA E COLA</p>
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
                                                            <label for="cc-numero">Número do cartão</label>
                                                            <input type="text" class="form-control"
                                                                   value="5226069490151810" id="cc-numero"
                                                                   name="card_number" placeholder="0000 0000 0000 0000">
                                                            <small
                                                                class="text-danger error-text card_number_error"></small>
                                                        </div>

                                                        <div class="col-6 mb-3 text-left">
                                                            <label for="cc-expiracao">Validade (Mês)</label>
                                                            <input type="text" class="form-control" value="07"
                                                                   id="expiration_month" name="expiration_month"
                                                                   placeholder="Ex: 12">
                                                            <small
                                                                class="text-danger error-text expiration_month_error"></small>
                                                        </div>
                                                        <div class="col-6 mb-3 text-left">
                                                            <label for="cc-expiracao">Validade (Ano)</label>
                                                            <input type="text" class="form-control" value="2023"
                                                                   id="expiration_year" name="expiration_year"
                                                                   placeholder="Ex: 2028">
                                                            <small
                                                                class="text-danger error-text expiration_year_error"></small>
                                                        </div>
                                                        <div class="col-6 mb-3 text-left">
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
                                                        <div class="col-6 mb-3 text-left">
                                                            <label for="cc-cvv">Cód. de segurança</label>
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
                                        <div class="nav flex-lg-column_ flex-row nav-pills" id="v-pills-tab" role="tablist"
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
                                        <button id="authenticate" type="button" style="width: calc(100% - 3%);"
                                                class="btn btn-warning mt-2 btn-radius-50"
                                                >Autenticar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        faturas--}}
                        <div id="colInvoices" class="{{count(session('customer')->billets) == 0 ? 'col-lg-12': 'col-lg-8'}}
                            order-lg-1 col-md-6 order-md-1 col-sm-6 order-sm-1
{{--                            py-2 pr-lg-3 px-0--}}
">
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

        #infoCustomerActive {
            background: white;
            border-top-right-radius: .5rem;
            border-top-left-radius: .5rem;
        }

        #infoCustomerActive p {
            font-size: 80%;
            margin: 0 auto
        }

        .clamped  {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            cursor: pointer;
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
            .contents {
                padding: 0;
            }

        }
        @media (max-width: 575px) {
            .sideMenu{
                max-width: 80%;
            }
            h4, .h4 {
                font-size: 1rem;
            }
            #colCheckout .list-group-item{
                padding: 0.5rem 1.25rem;
            }

            /*.checkout-controls .btn {*/
            /*    padding: .5rem;*/
            /*}*/
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
            /*margin-bottom: 40px;*/
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        async function pixCopyPaste(){
            let code = $('p.qrcodestring').text()
            console.log(code);
            await navigator.clipboard.writeText(code)
                .then(() => {
                    notify('Copiado para área de transferência!')
                })
                .catch((err) => {
                    notify('Falha ao copiar: '+ err);
                    setTimeout(() => {
                        location.reload()
                    }, 1000)
                });
        }

        function toggleLineClamp() {
            var paragraph = document.getElementById('infoText');
            paragraph.classList.toggle('clamped');

            var link = event.target;
            if (paragraph.classList.contains('clamped')) {
                link.innerText = 'Mostrar mais';
            } else {
                link.innerText = 'Mostrar menos';
            }
        }

        function getTokenCielo(){
            let url = "https://mpi.braspag.com.br/v2/auth/token";
            let _data = {
                EstablishmentCode: "1106093345",
                MerchantName: "PENHA DE SOUZA JAMARI",
                MCC:"5733"
            }

            fetch(url, {
                method: "POST",
                headers: {
                    'Content-type': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept'
                },
                body: JSON.stringify(_data)
            })
                .then(response => response.json())
                .then(json => console.log(json))
                .catch(err => console.log(err));
        }

        //getTokenCielo()


    </script>
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>--}}
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



