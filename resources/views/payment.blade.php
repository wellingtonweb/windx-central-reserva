@extends('layouts.app')

@section('content')
    <main>
{{--        {{ dd(12.69 * 100) }}--}}
        <section>
            <div class="container-fluid container-payment">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
                        <nav id="infoCustomerActive" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pagamento</li>
                            </ol>
                        </nav>
                        <div id="infoCheckout" class="d-none col-12 pl-0 pr-0 mb-2">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div id="checkout-box" class="d-flex flex-wrap">
                                    <div class="box-info flex-fill align-items-stretch text-left">
                                        <b>Selecionadas: </b>
                                        <span
                                            class="total-count badge badge-warning px-1 py-1" style="font-size: 100%"></span>
                                    </div>
                                    <div class="box-info flex-fill align-items-stretch text-left">
                                        <b>Valor: </b>
                                        <span class="text-muted">R$
                                            <span class="text-muted total-sum"></span>
                                        </span>
                                    </div>
                                    <div class="box-info flex-fill align-items-stretch text-left">
                                        <b>Juros + Multa: </b>
                                        <span class="text-muted">R$
                                            <span class="text-muted total-fees"></span>
                                        </span>
                                    </div>
                                    <div class="box-info flex-fill align-items-stretch text-left">
                                        <b>Total à pagar:
                                            R$
                                            <span
                                                class="total-cart badge badge-warning px-1 py-1" style="font-size: 100%"></span>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: none_" class="col-12 pl-0 pr-0 mb-2">
                            <div class="content-box">
                                <div class="btn-group_ tns-controls d-none" role="group" aria-label="Basic example">
                                    <div>
                                        <button type="button" data-controls="prev"
                                                 class="btn btn-primary btn-sm px-2 slider-button-prev" aria-controls="tns1">
                                            Anterior
                                        </button>
                                    </div>
                                    <div class="px-4">
                                        <div class="swiper-pagination text-muted "></div>
                                    </div>
                                    <div>
                                        <button type="button" data-controls="next"
                                                class="btn btn-primary btn-sm px-2 slider-button-next" aria-controls="tns1">
                                            Próxima
                                        </button>
                                    </div>
                                </div>
                                <div class="billets-slider pt-3 d-none">
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                </div>
                                <div #swiperRef="" class="swiper billetsSwiper">
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                    <div class="swiper-wrapper">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="buttonsCheckout" class="d-none col-12 ">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div class="row">
                                    <div class="col-lg-2 col-md-4 col-sm-12 order-lg-1 order-md-1 order-sm-1 px-2">
                                        <div class="checkout-controls w-auto d-flex">
                                            <button type="button" id="clear-cart" class="clear-cart btn btn-danger btn-block m-0">CANCELAR</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-sm-12 order-lg-0 order-md-0 order-sm-0 px-2">
                                        <h4>Formas de pagamento: <br>Débito, Crédito, Pix e Picpay</h4>
                                        <small>Selecione a fatura desejada e escolha a forma de pagamento.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>
        <section >
            <div>
                <input type="hidden" name="authEnabled" class="bpmpi_auth" value="true" />
                <input
                    type="hidden"
                    name="authEnabledNotifyonly"
                    class="bpmpi_auth_notifyonly"
                    value="false"
                />
                <input
                    type="text"
                    name="accessToken"
                    class="bpmpi_accesstoken"
                    value=""
                />
                <div>
                    <label>Order Number:</label>
                    <input
                        type="text"
                        size="50"
                        name="orderNumber"
                        class="bpmpi_ordernumber"
                        value="123456"
                    />
                </div>
                <div>
                    <label>Currency:</label>
                    <select name="currency" class="bpmpi_currency">
                        <option value="986" selected="selected">BRL</option>
                        <option value="840">USD</option>
                        <option value="032">ARS</option>
                    </select>
                </div>
                <div>
                    <label>Amount:</label>
                    <input
                        type="text"
                        size="50"
                        name="amount"
                        class="bpmpi_totalamount"
                        value=""
                    />
                </div>
                <div>
                    <label>Installments:</label>
                    <input
                        type="text"
                        size="2"
                        name="installments"
                        class="bpmpi_installments"
                        value="1"
                    />
                </div>
                <div>
                    <label>Payment Method:</label>
                    <select name="paymentMethod" class="bpmpi_paymentmethod">
                        <option value="credit" >Credit</option>
                        <option value="debit" selected="selected">Debit</option>
                    </select>
                </div>
                <div>
                    <label>Card Number:</label>
                    <input
                        type="text"
                        size="50"
                        name="cardNumber"
                        class="bpmpi_cardnumber"
                        value=""
                    />
                </div>

                <div>
                    <label>Expiration date:</label>
                    <input
                        type="text"
                        size="50"
                        name="expMonth"
                        class="bpmpi_cardexpirationmonth"
                        value=""
                    />
                    <input
                        type="text"
                        size="50"
                        name="expYear"
                        class="bpmpi_cardexpirationyear"
                        value=""
                    />
                </div>
                <div>
                    <label>Card Alias:</label>
                    <input
                        type="text"
                        size="50"
                        class="bpmpi_cardalias"
                        value=""
                    />
                </div>





                <!-- dados de cobrança -->
                <fieldset style="width: 0">
                    <legend>Billing Address</legend>
                    <div>
                        <label>Customer ID (CPF/CNPJ):</label>
                        <input
                            type="text"
                            size="14"
                            class="bpmpi_billto_customerid"
                            value="{{ preg_replace('/[^\d]/', '',session('customer.document')) }}"
                        />
                    </div>
                    <div>
                        <label>New Customer:</label>
                        <select name="newCustomer" class="bpmpi_merchant_newcustomer">
                            <option value="credit" selected="selected">true</option>
                            <option value="debit">false</option>
                        </select>
                    </div>
                    <div>
                        <label>Name:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_name"
                            value="{{ session('customer.full_name') }}"
                        />
                    </div>
                    <div>
                        <label>Phone number:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_phonenumber"
                            value="{{ preg_replace('/[^\d]/', '',session('customer.cell')) }}"
                        />
                    </div>
                    <div>
                        <label>E-mail:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_email"
                            value="{{ session('customer.email') }}"
                        />
                    </div>
                    <div>
                        <label>Street 1:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_street1"
                            value="{{ session('customer.street') }}"
                        />
                    </div>
                    <div>
                        <label>Street 2:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_street2"
                            value="Sala 934 Centro"
                        />
                    </div>
                    <div>
                        <label>City:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_city"
                            value="{{ session('customer.city') }}"
                        />
                    </div>
                    <div>
                        <label>State:</label>
                        <input type="text" size="50" class="bpmpi_billto_state" value="{{ session('customer.state') }}" />
                    </div>
                    <div>
                        <label>Country:</label>
                        <input type="text" size="2" class="bpmpi_billto_country" value="BR" />
                    </div>
                    <div>
                        <label>Zipcode:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_billto_zipcode"
                            value="{{ preg_replace('/[^\d]/', '',session('customer.cep')) }}"
                        />
                    </div>
                </fieldset>

                <!-- dados do device (coleção) -->
                <fieldset style="width: 0">
                    <legend>Device</legend>
                    <div>
                        <label>Ip address:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_device_ipaddress"
                            value="{{ session('customer.ip_address') }}"
                        />
                    </div>
                </fieldset>

                <!-- dados do pedido -->
                <fieldset style="width: 0">
                    <legend>Order</legend>
                    <div>
                        <label>Transaction Mode:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_transaction_mode"
                            value="S"
                        />
                    </div>
                    <div>
                        <label>Merchant URL:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_merchant_url"
                            value="https://www.windx.com.br"
                        />
                    </div>

                    <div>
                        <label>Product code:</label>
                        <input
                            type="text"
                            size="50"
                            class="bpmpi_order_productcode"
                            value="QCT"
                        />
                        <!-- ver domínio no manual -->
                    </div>

                </fieldset>

                <input
                    type="button"
                    onclick="sendOrder()"
                    value="Send Order"
                    id="btnSendOrder"
                />
            </div>
        </section>
    </main>
@endsection

@section('modal')
    <div class="modal fade backdrop-modal-transparent" id="modalMessage" tabindex="-1" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 id="modalMessageText"></h4>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCard" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center" style="border-bottom: none; display: ruby">
                    <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Pagamento via CRÉDITO</h5>
                    <button id="btnCloseModalCard" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-4 pr-4 pl-4 pt-0">
                    <div id="modalCard" class="bg-white text-center justify-content-center">

                        <div class="box-price-qrcode-card pb-1">
                            <h4 class="text-danger pt-2"><b>Valor total: R$ </b><span class="font-weight-bold total-cart"></span></h4>
                            <p> Faturas selecionadas: <b class="total-count"></b></p>
                        </div>
                        <small class="pt-2 text-black-50">Preencha os campos com os dados de seu cartão</small><br>
                        <small id="timerPaymentQrCode" class="mt-2 text-danger font-weight-bold">02:00</small>
                        <div class="container-card">
                            <form id="form_checkout" method="POST" disabled="disabled"
                                  action="{{route('central.checkout')}}">
                                <div class="row">
                                    <div id="inputs-hidden" class="form-row d-none">
                                        <input id="customer" name="customer"
                                               value="{{session('customer.id')}}" type="text" hidden>
                                        <input id="cartBillets" name="billets" type="text" hidden>
                                        <input id="full_name" name="full_name" type="text"
                                               value="{{session('customer.full_name')}}" hidden>
                                        <input id="email" name="email" type="text"
                                               value="{{session('customer.email')}}" hidden>
                                        <input id="cpf_cnpj" name="cpf_cnpj" type="text"
                                               value="{{session('customer.document')}}" hidden>
                                        <input id="phone" name="phone" type="text"
                                               value="{{session('customer.phone')}}" hidden>
                                        <input id="payment_type" name="payment_type" type="text" hidden>
                                        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input id="method" name="method" type="text" hidden>
                                        <input id="installment" name="installment" type="text" hidden>
                                        <input id="company" name="company" type="text" value="{{session('customer')['company_id']}}" hidden>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-12 w-100 alert alert-danger text-display-error text-center justify-content-center font-weight-bold d-none"
                                             role="alert">
                                        </div>
                                    </div>


                                    <div class="col-12 mb-3 px-3 text-left">
                                        <label for="cc-nome">Nome no cartão</label>
                                        <input type="text" class="form-control text-uppercase" id="cc-nome"
                                               name="holder_name" placeholder="Nome como está no cartão">
                                        <small class="text-danger error-text holder_name_error"></small>
                                    </div>
                                    <div class="col-12 mb-3 px-3 text-left">
                                        <label for="cc-numero">Número do cartão</label>
                                        <input type="text" class="form-control" id="cc-numero"
                                               name="card_number" placeholder="0000 0000 0000 0000">
                                        <small class="text-danger error-text card_number_error"></small>
                                    </div>

                                    <div class="col-6 mb-3 px-3 text-left">
                                        <label for="expiration_month">Validade (Mês)</label>
{{--                                        <input type="text" class="form-control" value="12"--}}
{{--                                               id="expiration_month" name="expiration_month"--}}
{{--                                               placeholder="Ex: 12">--}}
                                        <select id="expiration_month" name="expiration_month" class="form-control">
                                            <option value="" disabled>Ex: 12</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        <small
                                            class="text-danger error-text expiration_month_error"></small>
                                    </div>
                                    <div class="col-6 mb-3 px-3 text-left">
                                        <label for="expiration_year">Validade (Ano)</label>
                                        <select id="expiration_year" name="expiration_year"
                                                class="form-control" placeholder="Ex: 2028">
                                            <option value="" disabled>Ex: 2028</option>
                                            @for ($i = 0; $i < 10; $i++)
                                                @php
                                                    $ano = now()->year + $i;
                                                @endphp
                                                <option value="{{ $ano }}">{{ $ano }}</option>
                                            @endfor
                                        </select>
                                        <small class="text-danger error-text expiration_year_error"></small>
                                    </div>
                                    <div class="col-6 mb-3 px-3 text-left">
                                        <label for="cc-bandeira">Bandeira do cartão</label>
                                        <select id="cc-bandeira" name="bandeira"
                                                class="form-control">
                                            <option value="" disabled selected>Escolher</option>
                                            <option value="American Express">American Express</option>
                                            <option value="Aura">Aura</option>
                                            <option value="Banescard">Banescard</option>
                                            <option value="Cabal">Cabal</option>
                                            <option value="Dinners">Dinners</option>
                                            <option value="Elo">Elo</option>
                                            <option value="Hipercard">Hipercard</option>
                                            <option value="Master">Master</option>
                                            <option value="Visa">Visa</option>
                                        </select>
                                        <small class="text-danger error-text bandeira_error"></small>
                                    </div>
                                    <div class="col-6 mb-3 px-3 text-left">
                                        <label for="cc-cvv">Cód. de segurança</label>
                                        <input type="text" class="form-control" id="cc-cvv" name="cvv" placeholder="Ex: 123">
                                        <small class="text-danger error-text cvv_error"></small>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <button class="btn btn-success btn-block"
                                            type="submit">Finalizar pagamento
                                    </button>
                                </div>
                            </form>
                        </div>
                        <p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* form-floating-variables */
        .btn-payment-type svg path{
            fill: white !important;
        }

        .btn-payment-type span{
            letter-spacing: 5px;
            font-weight: bold;
        }

        .form-floating {
            position: relative;
            margin-bottom: 0.625rem;
        }
        .form-floating:last-of-type {
            margin-bottom: 0;
        }
        .form-floating > .form-control,
        .form-floating > .form-select {
            height: 50px;
            padding: 1.038rem 1.038rem;
        }
        .form-floating > label {
            position: absolute;
            top: 0;
            left: 0;
            font-weight: 700;
            height: 100%;
            padding: 1.038rem 1.038rem;
            border: 1px solid transparent;
            pointer-events: none;
            transform-origin: 0 0;
            -webkit-transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
            font-size: .8em;
        }

        .form-control, .form-control:focus {
            border: none;
            background-color: whitesmoke;
            outline: none;
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .form-floating > .form-control::placeholder {
            color: transparent;
        }
        .form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        .form-floating > .form-control:-webkit-autofill {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label,
        .form-floating > .form-select ~ label {
            opacity: 0.65;
            transform: scale(0.75) translateY(-0.5rem) translateX(0.15rem);
        }
        .form-floating > .form-control:-webkit-autofill ~ label {
            opacity: 0.65;
            transform: scale(0.75) translateY(-0.5rem) translateX(0.15rem);
        }

        .form-control, .form-control:focus {
            background-color: aliceblue;
            border: 1px solid rgba(128, 128, 128, .3) !important;
        }

        div:where(.swal2-container) h2:where(.swal2-title) {
            font-size: 1.33em !important;
        }

        .box-price-qrcode-card {
            background-color: whitesmoke;
            border-radius: .3rem;
        }

        .box-price-qrcode-card p {
            font-size: .8em;
        }

        .qrcode-container {
            width: 200px !important;
            height: 200px !important;
        }

        #btnPixCopyPaste {
            cursor: pointer;
        }

        .backdrop-modal-transparent {
            background-color: transparent !important;
        }

        #modalMessage {
            z-index: 1070 !important;
        }

        #modalMessage .modal-body {
            padding: .6rem !important;
        }

        #modalMessage .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fbfafa;
            background-clip: padding-box;
            border: none !important;
            border-radius: 0.3rem;
            outline: 0;
            color: #002046;
            font-weight: bold !important;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .billetsSwiperLoading {
            opacity: .5;
            transition: all 200ms linear;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper {
            width: 100%;
            height: auto;
            /*height: 450px;*/
            margin: 10px auto;
        }

        .swiper-pagination-fraction {
            padding-top: 1.2rem;
            width: 35px !important;
        }

        .swiper-pagination {
            position: relative !important;
            font-size: .6rem !important;
        }

        /* --------  */
        .card-header {
            text-align: center;
            font-size: .8em;
        }

        .card-header div.title {
            white-space: nowrap;
            max-width: 15em;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-body .col-xl, .col-xl-auto, .col-xl-12,
        .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7,
        .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1,
        .col-lg, .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9,
        .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3,
        .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11,
        .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5,
        .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto,
        .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7,
        .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col,
        .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6,
        .col-5, .col-4, .col-3, .col-2, .col-1 {
            padding-right: 0;
            padding-left: 0;
            gap: 5px;
        }

        .letter-1 {
            letter-spacing: 1px;
        }

        .billet-link {
            font-size: 1rem;
        }

        .billet-link i {
            font-size: 1.5rem !important;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }
        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: rgba(0, 32, 70, 0.8);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }
        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }
        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }
        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(24px, 0);
            }
        }

        @keyframes round {
            0% { transform: rotate(0deg) }
            100% { transform: rotate(360deg) }
        }

        .tns-controls {
            z-index: 999 !important;
            position: relative;
            display: inline-flex;
            vertical-align: middle;
        }

        .tns-controls .btn {
            padding: 0.25rem 1.5rem !important;
            font-size: .875rem;
            line-height: 1.5;
        }

        .tns-controls > .btn:not(:first-child), .btn-group > .btn-group:not(:first-child) > .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        @media (max-width: 767.98px) {
            #infoCustomerActive {
                display: none !important;
            }
        }
        @media (max-width: 575.98px)
        {

            .btn {
                font-size: .6rem !important;
            }

            #checkout-box {
                font-size: 80%;
                font-weight: 400;
            }

            .my-slider .card .card-body
            {
                font-size: 80%;
                font-weight: 400;
            }

            #infoCustomerActive {
                display: none !important;
            }

            .tns-controls .btn {
                font-size: .6rem;
                line-height: 1.5;
            }

            .info-plus {
                display: none !important;
            }

            #timerPaymentQrCode {
                position: relative !important;
                top: 0 !important;
                left: 0 !important;
            }

            div:where(.swal2-container) h2:where(.swal2-title) {
                font-size: 1.15em !important;
            }

        }

        .content-box {
            /*width: 100%;*/
            /*display: block;*/
            border-radius: .5rem;
            background-color: #fff !important;
            padding: 1rem;
        }

        .clss {
            color: midnightblue;
        }

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
            padding: .3rem !important;
        }

        #infoCustomerActive {
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

            .col-12 {
                padding-bottom: 0 !important;
            }

            .card .card-body {
                font-size: .84rem !important;
            }

            .btn {
                padding: 8px;
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
            display: block;
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

        .checkout-controls {
            width: 100%;
            display: block;
            border-radius: .5rem;
            /*background-color: #fff !important;*/
            /*padding: 1rem;*/
        }

        .card {
            background-color: rgba(0, 0, 0, 0.03);
            /*background-color: rgba(0, 0, 0, 0.03) !important;*/
            border-radius: .5rem;
            border: 2px solid rgba(4, 149, 253, 0.3)
        }

        .card-overdue {
            border: 2px solid rgba(253, 2, 2, 0.3) !important;
        }

        .card .card-body {
            font-size: .9rem !important;
        }

        .card .card-body .row .resume{
            cursor: grab;
        }

        .card .card-header{
            background-color: rgba(4, 149, 253, 0.3);
            border-bottom: none !important;
            /*margin: 1px;*/
            border-top-right-radius: .3rem;
            border-top-left-radius: .3rem;
        }

        .card-header-overdue {
            background-color: rgba(253, 2, 2, 0.3) !important;
        }

        .card .card-footer{
            background-color: transparent !important;
            border-top: none !important;
        }

        #tns1 > .tns-item {
            padding-right: 0 !important;
            margin-left: 1rem;
        }

        #checkout-box {
            gap: 10px;
        }

        #checkout-box .box-info {
            background-color: rgba(0, 0, 0, 0.03) !important;
            padding: .25rem .5rem;
            border-radius: .25rem;
        }

        .delete-item {
            margin-top: 0 !important
        }

        .card-disabled {
            color: rgba(0,0,0, .4) !important;
        }

        #modalMessage {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endsection

@section('js')
    <script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>
    <script>
        var idCustomer = {{session('customer.id')}};
        var customerActive = @json(session('customer'));
        var maxInstallment = {{ env('MAX_INSTALLMENT') }};
        var minInstallmentValue = {{ env('MIN_INSTALLMENT_VALUE') }};
        let urlGetBillets = "{{ route('central.get.billets') }}";
        var checkoutForm = $('#form_checkout')[0];
        var checkoutButtons = `
                <div id="v-pills-tab" class="checkout-controls mt-4 px-3">
                    <div class="mt-3">
                        <button class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-debit"
                                onclick="getPaymentType(this)" type="button">
                            <span class="pl-3">DÉBITO</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-credit" type="button">
                            <span class="pl-3">CRÉDITO</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-pix"
                            data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                            role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                            <span class="pl-3">PIX</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-picpay"
                                data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                            <span class="pl-3">PICPAY</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                `;
        // $('#form_checkout').prop( "disabled", true );

        Swal.fire({
            title: "Selecione uma ou mais faturas para pagamento!",
            icon: "info"
        });

        // Swal.fire({
        //     title: `Selecione a forma <br>de depagamento`,
        //     html: checkoutButtons,
        //     confirmButtonColor: '#38c172',
        //     denyButtonColor: '#6c757d',
        //     showDenyButton: false,
        //     showCancelButton: false,
        //     showConfirmButton: false,
        //     confirmButtonText: 'Sim',
        //     cancelButtonText: `Não`,
        //     allowOutsideClick: () => {
        //         const popup = Swal.getPopup()
        //         popup.classList.remove('swal2-show')
        //         setTimeout(() => {
        //             popup.classList.add('animate__animated', 'animate__headShake')
        //         })
        //         setTimeout(() => {
        //             popup.classList.remove('animate__animated', 'animate__headShake')
        //         }, 500)
        //         return false
        //     },
        // })

        function sendOrder() {
            bpmpi_authenticate();
        }

        var getAccessToken = async () => {
            const settings = {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": 'Basic '+ window.btoa('dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e:D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag=')
                    // "Authorization": 'Basic '+ window.btoa('3d60f342-9728-47bd-9295-556a7e16e67f:CnsSGyo9IKUWiUw+v4Q1WcHwYdH2VGiyQYV2Jz0gs14=')
                },
                body: JSON.stringify({"EstablishmentCode":"1106093345","MerchantName": "PENHA DE SOUZA JAMARI","MCC": "4816"})
            };
            try {
                const fetchResponse = await fetch(`https://mpisandbox.braspag.com.br/v2/auth/token`, settings);
                // const fetchResponse = await fetch(`https://mpi.braspag.com.br/v2/auth/token`, settings);
                const data = await fetchResponse.json();
                console.log('Data: ',data);
                // $('#form_checkout').prop( "disabled", false );
                document.getElementsByClassName("bpmpi_accesstoken")[0].value = data.access_token
                return data.access_token;
            } catch (e) {
                return e;
            }
        }

        //bpmpi_cardnumber, bpmpi_cardexpirationmonth, bpmpi_cardexpirationyear, bpmpi_cardalias

        //cc-nome, cc-numero, expiration_month, expiration_year
        $('#cc-nome').blur(function(){
            $('input.bpmpi_cardalias').val($(this).val());
        });

        $('#cc-numero').blur(function(){
            $('input.bpmpi_cardnumber').val($(this).val());
        });

        $('#expiration_month').blur(function(){
            $('input.bpmpi_cardexpirationmonth').val($(this).val());
        });

        $('#expiration_year').blur(function(){
            $('input.bpmpi_cardexpirationyear').val($(this).val());
        });


    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script type="text/javascript" defer>
        inactivitySession();
    </script>
@endsection
