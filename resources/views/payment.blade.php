@extends('layouts.app')

@section('content')
    <main>
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
                        <div class="header-app col-12 font-weight-bolder text-left p-2" style="display: none">
                            {{$header}}
                        </div>
                        <div id="buttonsCheckout" class=" col-12 ">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div class="d-none_ row">
                                    <div class="col order-lg-0 order-md-0 order-sm-0 px-2">
                                        <div id="infoCheckout" class="content-box d-none col-12 mb-2">
                                            <div id="checkout-box_" class="row row-cols-2 row-cols-sm-2 row-cols-md-5">
                                                <div class="col p-1">
                                                    <div class="box-info">
                                                        <b>Faturas: </b>
                                                        <span class="total-count px-1 py-1" style="font-size: 100%"></span>
                                                    </div>
                                                </div>
                                                <div class="col p-1">
                                                    <div class="box-info">
                                                        <b>Valor: </b>
                                                        <span class="text-muted pl-1">R$
                                        <span class="text-muted total-sum"></span>
                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col p-1">
                                                    <div class="box-info">
                                                        <b>Juros<span class="feesInfoBox"> + Multa</span>: </b>
                                                        <span class="text-muted pl-1">R$
                                                <span class="text-muted total-fees"></span>
                                            </span>
                                                    </div>
                                                </div>
                                                <div class="col p-1">
                                                    <div class="box-info">
                                                        <b>Total: R$
                                                            <span class="total-cart px-1 py-1" style="font-size: 100%"></span>
                                                        </b>
                                                    </div>
                                                </div>
                                                <div class="col p-1">
                                                    <div class="checkout-controls">
                                                        <button type="button" id="clear-cart" class="clear-cart btn btn-danger btn-block">
                                                            <i class="fas fa-trash pr-1"></i>CANCELAR</button>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="content-box p-lg-3 p-md-2 p-sm-2 d-none">--}}
{{--                                                <div id="checkout-box_" class="d-flex flex-wrap">--}}
{{--                                                    <div class="box-info flex-fill align-items-stretch text-left">--}}
{{--                                                        <b>Faturas: </b>--}}
{{--                                                        <span--}}
{{--                                                            class="total-count px-1 py-1" style="font-size: 100%"></span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="box-info flex-fill align-items-stretch text-left">--}}
{{--                                                        <b>Valor: </b>--}}
{{--                                                        <span class="text-muted">R$--}}
{{--                                            <span class="text-muted total-sum"></span>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="box-info flex-fill align-items-stretch text-left">--}}
{{--                                                        <b>Juros + Multa: </b>--}}
{{--                                                        <span class="text-muted">R$--}}
{{--                                            <span class="text-muted total-fees"></span>--}}
{{--                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="box-info flex-fill align-items-stretch text-left">--}}
{{--                                                        <b>Total à pagar:--}}
{{--                                                            R$--}}
{{--                                                            <span--}}
{{--                                                                class="total-cart badge badge-warning px-1 py-1" style="font-size: 100%"></span>--}}
{{--                                                        </b>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
{{--                                        <span class="infoText" style="letter-spacing: 1px;">Formas de pagamento: Débito, Crédito, Pix e Picpay</span>--}}
                                    </div>
{{--                                    <div class="col-lg-2 col-md-4 col-sm-12 order-lg-1 order-md-1 order-sm-1 px-2">--}}
{{--                                        <div class="checkout-controls w-auto d-flex">--}}
{{--                                            <button type="button" id="clear-cart" class="clear-cart btn btn-danger btn-block" style="margin-top: 1.6rem !important;">--}}
{{--                                                <i class="fas fa-trash pr-1"></i>CANCELAR</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-10 col-md-8 col-sm-12 order-lg-0 order-md-0 order-sm-0 px-2">
                                        <div id="infoCheckout" class="content-box d-none col-12 mb-2">
                                            <div id="checkout-box_" >
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex pl-2">
                                                        <i id="trashIcon" class="fas fa-trash-alt text-danger fa-2x clear-cart" style="cursor: pointer"></i>
{{--                                                        <i class="fas fa-trash text-danger fa-2x clear-cart" style="cursor: pointer"></i>--}}
                                                    </div>
                                                    <div class="checkout-controls pl-2">
                                                        <h4 class="font-weight-bold">Total: R$
                                                            <span  class="total-cart" style="font-size: 100%"></span>
                                                        </h4>
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-center" style="position: relative">
                                                        <i class="fas fa-shopping-bag" style="font-size: 2.2em"></i>
                                                        <span style="position: absolute; font-size: 90%; padding-top: 10px" class="total-count text-white font-weight-bold"></span>
                                                    </div>
{{--                                                    <div--}}
{{--                                                        style="display: flex;--}}
{{--                                                    position: relative;--}}

{{--    flex-direction: column;--}}
{{--    align-items: center;--}}
{{--    text-align: center;"--}}

{{--                                                    >--}}
{{--                                                        <svg xmlns="http://www.w3.org/2000/svg" height="28" width="30" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>--}}
{{--                                                        <span style="position: absolute; font-size: 90%; padding-top: 2px" class="total-count text-white font-weight-bold"></span>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="content-box p-lg-3 p-md-2 p-sm-2 d-none">
                                                <div id="checkout-box_" class="d-flex flex-wrap">
                                                    <div class="box-info flex-fill align-items-stretch text-left">
                                                        <b>Faturas: </b>
                                                        <span
                                                            class="total-count px-1 py-1" style="font-size: 100%"></span>
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
                                        <span class="infoText" style="letter-spacing: 1px;">Formas de pagamento: Débito, Crédito, Pix e Picpay</span>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-12 order-lg-1 order-md-1 order-sm-1 px-2 d-none">
                                        <div class="checkout-controls w-auto d-flex">
                                            <button type="button" id="clear-cart_" class="clear-cart btn btn-danger btn-block m-0">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pl-0 pr-0 mt-2">
                            <div class="content-box">
                                <div class="tns-controls d-none" role="group" aria-label="Basic example">
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
                    </div>
                </main>
            </div>
        </section>
        <section class="teste d-none">
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

                        <div class="box-price-qrcode-card">
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
    <link rel="stylesheet" href="{{ asset('assets/css/pages/payment.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endsection

@section('js')
{{--    <script src="https://mpisandbox.braspag.com.br/Scripts/BP.Mpi.3ds20.min.js" type="text/javascript"></script>--}}
    <script>
        var idCustomer = {{session('customer.id')}};
        var customerActive = @json(session('customer'));
        var maxInstallment = {{ env('MAX_INSTALLMENT') }};
        var minInstallmentValue = {{ env('MIN_INSTALLMENT_VALUE') }};
        let urlGetBillets = "{{ route('central.get.billets') }}";
        var checkoutForm = $('#form_checkout')[0];
        // var checkoutButtons =
        // $('#form_checkout').prop( "disabled", true );

        // Swal.fire({
        //     title: "Selecione uma ou mais faturas para pagamento!",
        //     icon: "info"
        // });

        Swal.fire({
            icon: "info",
            title: `Selecione uma ou mais faturas para pagamento!`,
            html: `<div class="p-2 d-flex justify-content-center align-items-center">
                            <div class="container-screen">
                                <div>Fatura 4</div>
                                <div>Fatura 5</div>
                                <div>Fatura 1</div>
                                <div>Fatura 2</div>
                                <div>Fatura 3</div>
                                <i class="fas fa-hand-pointer fa-2x hand-icon"></i>
                            </div>
                        </div>`,
            showDenyButton: false,
            showCancelButton: false,
            showConfirmButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: `Não`,
            allowOutsideClick: () => {
                const popup = Swal.getPopup()
                popup.classList.remove('swal2-show')
                setTimeout(() => {
                    popup.classList.add('animate__animated', 'animate__headShake')
                })
                setTimeout(() => {
                    popup.classList.remove('animate__animated', 'animate__headShake')
                }, 500)
                return false
            },
        })

        // function sendOrder() {
        //     bpmpi_authenticate();
        // }
        //
        // var getAccessToken = async () => {
        //     const settings = {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //             "Authorization": 'Basic '+ window.btoa('dba3a8db-fa54-40e0-8bab-7bfb9b6f2e2e:D/ilRsfoqHlSUChwAMnlyKdDNd7FMsM7cU/vo02REag=')
        //             // "Authorization": 'Basic '+ window.btoa('3d60f342-9728-47bd-9295-556a7e16e67f:CnsSGyo9IKUWiUw+v4Q1WcHwYdH2VGiyQYV2Jz0gs14=')
        //         },
        //         body: JSON.stringify({"EstablishmentCode":"1106093345","MerchantName": "PENHA DE SOUZA JAMARI","MCC": "4816"})
        //     };
        //     try {
        //         const fetchResponse = await fetch(`https://mpisandbox.braspag.com.br/v2/auth/token`, settings);
        //         // const fetchResponse = await fetch(`https://mpi.braspag.com.br/v2/auth/token`, settings);
        //         const data = await fetchResponse.json();
        //         console.log('Data: ',data);
        //         // $('#form_checkout').prop( "disabled", false );
        //         document.getElementsByClassName("bpmpi_accesstoken")[0].value = data.access_token
        //         return data.access_token;
        //     } catch (e) {
        //         return e;
        //     }
        // }

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
{{--    <script type="text/javascript" defer>--}}
{{--        inactivitySession();--}}
{{--    </script>--}}
@endsection
