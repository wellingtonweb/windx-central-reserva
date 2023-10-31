@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid container-payment">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
{{--                        <div id="infoCustomerActive" class="d-flex d-none col-12 order-0 px-lg-0 px-md-1 mb-2">--}}
{{--                            <a href="{{route('central.home')}}" class="btn btn-secondary btn-sm">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-arrow-left" viewBox="0 0 16 16">--}}
{{--                                    <path style="fill:white !important;" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>--}}
{{--                                </svg>Voltar--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        {{dd(session('customer'))}}--}}
                        <nav id="infoCustomerActive" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pagamento</li>
                            </ol>
                        </nav>


                        <div id="infoCheckout" class="d-none col-12 pl-0 pr-0 mb-2">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div id="checkout-box" class="d-flex flex-wrap">
{{--                                <div id="checkout-box" class="d-lg-flex d-md-block d-sm-block align-items-stretch">--}}
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
                                        <button id="tyne-prev-btn_" type="button" data-controls="prev"
                                                 class="btn btn-primary btn-sm slider-button-prev" aria-controls="tns1">
                                            Fatura anterior</button>
                                    </div>
                                    <div class="px-4">
                                        <div class="swiper-pagination text-muted "></div>
                                    </div>
                                    <div>
                                        <button id="tyne-next-btn_" type="button" data-controls="next"
                                                class="btn btn-primary btn-sm slider-button-next" aria-controls="tns1">Próxima fatura</button>
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
                        <div id="buttonsCheckout" class="d-none col-12 pl-0 pr-0">


                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div class="row">
                                    <div class="col-lg-10 col-md-12 col-sm-12">
                                        <div id="v-pills-tab" class="checkout-controls d-flex flex-wrap">
                                            <button class="btn btn-windx mb-1 btn-payment-type m-md-2" id="btn-pix"
                                                    data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                                    role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                                                PIX
                                            </button>
                                            <button class="btn btn-windx mb-1 btn-payment-type mx-md-2" id="btn-picpay"
                                                    data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                                    role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                                                PICPAY
                                            </button>
                                            <button class="btn btn-windx mb-1 btn-payment-type mx-md-2" id="btn-credit"
{{--                                                    data-toggle="modal" data-target="#modalCard" --}}
                                                    type="button">
                                                CRÉDITO
                                            </button>
{{--                                            <button class="btn btn-windx mb-1 btn-payment-type mx-md-2" id="btn-debit"--}}
{{--                                                    data-toggle="pill" data-target="#v-pills-card" type="button"--}}
{{--                                                    role="tab" aria-controls="v-pills-settings" aria-selected="false">--}}
{{--                                                DÉBITO--}}
{{--                                            </button>--}}

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                        <div class="checkout-controls">
                                            <button type="button" id="clear-cart" class="clear-cart btn btn-danger">CANCELAR</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </main>
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
                    <h5 class="modal-title font-weight-bold" id="staticBackdropLabel">Pagamento nº 12345 com CRÉDITO</h5>
                    <button id="btnCloseModalCard" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-4 pr-4 pl-4 pt-0">
                    <div id="modalCard" class="bg-white text-center justify-content-center">
                        <small id="timerPaymentQrCode" class="text-danger">00:00</small>
                        <div class="box-price-qrcode-card pb-1">
                            <h4 class="text-danger pt-2"><b>Valor total: R$ </b><span class="font-weight-bold total-cart"></span></h4>
                            <p> Faturas selecionadas: <b class="total-count"></b></p>
                        </div>
                        <small class="pt-2 text-black-50">Preencha os campos com os dados de seu cartão</small>
                        <div class="container-card">
                            <form id="form_checkout" method="POST"
                                  action="{{route('central.checkout')}}">
                                <div class="row">
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
{{--                                        <input id="cpf_cnpj_type" name="cpf_cnpj_type" type="text" value=" " hidden>--}}
                                        <input id="token" type="hidden" name="_token"
                                               value="{{ csrf_token() }}"/>
                                        <input id="method" name="method" type="text" hidden>
                                        <input id="installment" name="installment" type="text" hidden>
                                        <input id="company" name="company" type="text" hidden>
                                        <input id="terminal_id" name="terminal_id" type="text" value="{{Cookie::get('terminal_id')}}" hidden>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-12 w-100 alert alert-danger text-display-error text-center justify-content-center font-weight-bold d-none"
                                             role="alert">
                                        </div>
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
                                               value="4024007153763191" id="cc-numero"
                                               name="card_number" placeholder="0000 0000 0000 0000">
                                        <small
                                            class="text-danger error-text card_number_error"></small>
                                    </div>

                                    <div class="col-6 mb-3 text-left">
                                        <label for="cc-expiracao">Validade (Mês)</label>
                                        <input type="text" class="form-control" value="12"
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
                                <div class="p-2">
{{--                                    <button class="btn btn-secondary" data-dismiss="modal"--}}
{{--                                            type="reset">Cancelar--}}
{{--                                    </button>--}}
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

        #timerPaymentQrCode {
            position: absolute;
            top: 1.5rem;
            left: 2rem;
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
            padding: 0.25rem 0.5rem !important;
            font-size: .875rem;
            line-height: 1.5;
        }

        .tns-controls > .btn:not(:first-child), .btn-group > .btn-group:not(:first-child) > .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        @media (max-width: 991.98px) {}
        @media (max-width: 767.98px) {
            #infoCustomerActive {
                display: none !important;
            }
        }
        @media (max-width: 575.98px) {
            /*.my-slider .card {*/
            /*    height: 17.5rem;*/
            /*    max-height: 17.5rem;*/
            /*}*/

            #checkout-box {
                font-size: 80%;
                font-weight: 400;
            }
            .my-slider .card .card-body
            {
                font-size: 80%;
                font-weight: 400;
            }
            /*.content-box {*/
            /*    padding: .5rem !important;*/
            /*}*/

            .checkout-controls .btn{
                padding: 0.25rem 0.5rem;
            }

            .container-payment .col-xl, .col-xl-auto, .col-xl-12,
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

            #infoCustomerActive {
                display: none !important;
            }

            .tns-controls .btn {
                padding: 0.25rem 0.5rem !important;
                font-size: .6rem;
                line-height: 1.5;
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
            padding: .3rem;
        !important;
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

        .card .card-body .row{
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


    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endsection

@section('js')
    <script>
        var idCustomer = {{session('customer')->id}};
        var customerActive = @json(session('customer'));
        var maxInstallment = {{ env('MAX_INSTALLMENT') }};
        var minInstallmentValue = {{ env('MIN_INSTALLMENT_VALUE') }};
        let urlGetBillets = "{{ route('central.get.billets') }}";
        var checkoutForm = $('#form_checkout')[0];
        console.log(checkoutForm)

        var paymentId = 12345;
        //
        var modalQrCode = `
            <div id="modal-qrcode" class="bg-white text-center justify-content-center">
                <small id="timerPaymentQrCode" class="text-danger">00:00</small>
                <div class="box-price-qrcode-card pb-1">
                    <h4 class="text-danger pt-2"><b>Valor total: R$ </b><span class="font-weight-bold">1,00</span></h4>
                    <p> Faturas selecionadas: <b class="total-count"></b></p>
                </div>
                <small class="pt-2 text-black-50">Use seu app de pagamento e leia o qrcode</small>
                <div id="container-qrcode">
                    <div class="body-popup-qrcode">
                        <div class="qrcode-container">
                            <img id="qrcode-img" class="w-50_" src="data:image\/png;base64,iVBORw0KGgoAAAANSUhEUgAABbQAAAW0CAYAAAAeooXXAAAABGdBTUEAALGPC\/xhBQAAAAFzUkdCAK7OHOkAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAIABJREFUeJzs2kGS3DqSQMHBWN7\/yphljxYt62qiPuMl3A9ACwIgSnqWa++9\/wcAAAAAAIb737cHAAAAAACA\/4SgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQMLn7QHq1lpvj0DI3vvo8247f9PX7\/R8t7ltP6Z\/v763Z7zvM9Pf97Tp6zd9vtNue9\/Tpv99Y5bb7qvp853mfeHfm36ep\/MLbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEtbee789RNla6+jzbMcs9neW0\/sx3W3n5bb9vc1t5xneNP0+PX0feN9n3M\/P3Hb+Tpu+fre57by4n\/kJ+zuLX2gDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJDweXsAftda6+0R\/lF777dH+EfZ32duW7\/p73vb93va6f29bT+mr9\/0+XjG\/j4z\/X1v29\/p73vbfP79992mnxf7O8v0++A05++7+YU2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJn7cHAPhPrbWOPm\/vffR5p51+X2Zxnp85\/b6nnzf9+50+3237wTP295np6zf978f0+aabfv5Ou+3fL74P4Lf4hTYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmftwcA\/nt777dHSFtrvT3CX922v6f34\/T6TT8v0+ebzvl75rb3ne629Zt+\/qb\/Pbd+z0yf77b74LTp38dpt53n6e8L\/Ht+oQ0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQMLn7QH4XXvvt0fgF621jj7v9HmZPt90t63fbfPdtr+n33f6+p2e7zTv+93sxzPTv4\/p8502fb7b9mP69zvd9PWbfl9NX7\/prB\/fxC+0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABI+Lw9AH9aa709AvBf2nsffd70++D0fNPX7\/R8001fv+nfx2nT12\/6fKdNX7\/Tpu+v+Z4x33ebvn7me2b634\/Tblu\/2+4r+Am\/0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIOHz9gB1e++3R4BrrLWOPs\/3+8zp9Tu9v9NNP3\/T55vO+n03+\/vM9L8f0+c7zXyzuF+emb5+t803\/X4+bfp88E38QhsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgARBGwAAAACABEEbAAAAAIAEQRsAAAAAgITP2wPwp7XW0eftvY8+77b5bjN9f0\/zvs9Mf19mue38ed9Zps833W3nebrb\/v3svDwzfX9Pm35fTd+P6d\/b9PWbznl+Zvr9chu\/0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIOHz9gB1a62jz9t7H33ebW5bv9Pn77Tp801323k+7fT6Tb\/vfW\/P3LZ+7hd+4vT3cdv3dtr09bvt75v3neW2\/Zhu+nmZ\/u\/721g\/fsIvtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASPi8PQC\/a6119Hl776PPm+70+vHdpp+X09\/v9Ptl+n5Yv2emz3eb6ftx2\/cxnf3gJ247L9P\/vzV9\/aa77TyfNv19b\/v3\/W331fT3vY1faAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkPB5ewD+tNY6+ry999HnnZ5vutPrN9308zed9ZvF\/ffM9PWb\/n1MPy\/T92P6+jl\/38338cz0+abvx\/T7hWduOy\/T74PTpu\/H9PvvtOnvO\/28TOcX2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJHzeHqBu7330eWut0c87zfo9c3r9pju9H9PXz\/l7Zvp5mX5fTd\/f06Z\/b7fNN\/38Td8P68ebnL9nps93mvPCTzgv3236\/7emn7\/b+IU2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJn7cH4Hftvd8e4a\/WWm+P8Fe3rd\/09z3N+j0z\/fu9zW3nb7rp+zH9\/pt+v0zf39Omn5fprN8z09fPffXdpq\/f9O9jOt\/vd7N+380vtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASBC0AQAAAABIELQBAAAAAEgQtAEAAAAASPi8PQC\/a6119Hl779HPO+30+vHM6fNy2\/5Ovw9u24\/b7r\/p73va9PXz\/T4zfX9Pmz7f9PN32\/pNv6+mcz\/PMn0\/bvs+ppt+Xk677X1P8\/0+4xfaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkrL33fnuIsrXW0eed3o7T891m+n5Mn+8019Uz08\/fadPP83TT7xfzPTP9+z3ttvtg+v7eth+nTd\/f6abfp76PZ+zHM7fdL+6DWW47fzzjF9oAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACR83h6A37X3fnuEv1prvT3CX52eb\/p+3Gb6+Tt9Xk4\/z\/fxjPed5bbvY\/p8p02fb7rb\/l5Of9\/b2I\/vdtv3O\/19b1u\/6ftx23zwE36hDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAwtp777eH4F\/WWkefN317T7\/vaafX77b35Znp98H0+W4z\/X45zXl5Zvp5sb+zTD8vt\/H3\/Bnv+8z088czt53n06Z\/H7ftr\/34bn6hDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAwuftAfjT3vvtEf5Rp993rTX6edPf97Tp803fj9vug9Omn7\/TnJdnpn+\/t803\/X2nm75+0+\/n6edl+v6eNv282A9+wv4+M339Trvt7y\/8hF9oAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQ8Hl7AH7XWuvtEf5q7\/32CH9123y3nZfT7zv9vEzn\/M163nS+t1mmfx884+\/lM9bvmen3y237cZr1m2X698Ysvl\/e5BfaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkrL33fnsI7rXWOvq808f59Hy3mX693La\/0\/fjNu6\/Z247z7edF\/vLTzgvz0y\/D06b\/r7Tz\/Nt+3va9PMyfX+nsx+zTN+P6ffVdH6hDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAwuftAerWWkeft\/c++rzb2A9+Yvr+nj7P001\/39Pn5fTzblu\/29x2Xqb\/PZ++ftPf133wzPT1mz7fbaZ\/v9Pv0+nrd9r0\/Z2+ftNZP76JX2gDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJAgaAMAAAAAkCBoAwAAAACQIGgDAAAAAJDweXsAmGytdfR5e++jz7ttvtNue1+esb\/P3LZ+p+8XnvH38pnbzrP94Cduuw9Om36ep89323mZ7rZ\/b9w2H7P4hTYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAlr773fHoKOtdbR5912\/G5bv9Pve9r09Ttt+vkz33e77T5wXp6Zfl5Om76\/zvMst+3Hbe873W3382nT\/70BP3Hbefb3Yxa\/0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIEHQBgAAAAAgQdAGAAAAACBB0AYAAAAAIOHz9gD8aa119Hl776PPu830\/Tg9H89MPy\/O3zPu01luO8\/T75fp63fabfeB8\/LM9PMy\/X45zfmbZfp808\/L9PU7bfp9ddt8t30f0\/f3Nn6hDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAwtp777eHKFtrvT3CP+r0cTm9ftOP8\/TzMn39TnP+npn+vqf5fp+57fxNPy+3mX5eeOa2++W06es3fb7T\/P14xvl7xvvOMn394E1+oQ0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQIKgDQAAAABAgqANAAAAAECCoA0AAAAAQMLae++3h+D3rLWOPu\/0cTk933TW75np63fbder8PeP8PTP9\/E0\/L7e5bT+m3wfuv2esHz9x233lfb\/bbffV9Pt++nyn3fa+0\/mFNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACWvvvd8egn9Za709wl9NPy6n1+\/0+962v9Pfl2em3wfTua9mcZ6\/m+\/tGd\/HM9P39zTfx3ebvh+nOc\/fbfq\/D07zvs9Mf9\/b+IU2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJgjYAAAAAAAmCNgAAAAAACYI2AAAAAAAJn7cHqFtrHX3e3vvo825zev2m7+\/p+W5jP56Z\/n2cNn1\/p8833W3rd9v3Nv2+nz7fadPnm\/59TJ\/P98FP3La\/t32\/000\/f9PPy2nWj5\/wC20AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABI+bw\/An9Zab4\/A\/7P3Pvo8+\/vM6f2Ybvr5mz7fadPf13yz3HZfTd+P287zbefvtNvO82nTz5\/vl5+47Xubfv5O78f073f6fNNZv+\/mF9oAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACSsvfd+e4iytdbR503fjtPvyyy3nb\/T73vb9zH9vJw2\/fzd5rbvbTr36Xebfl\/ddj9Pf9\/b5jvN+Ztl+nk5zX7wE7fdz6dN\/96m8wttAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAD4P3btJTeSIEmiIBzI+1\/ZZ9ldiyHADqsK1TSRAyT8T+IhAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKDC5+0B8Hedc0Z\/7947+nvp40s3vX7Tvzdt2\/lLH18665cl\/X1J5\/w9s2390u+b9\/mZbf9vpJ\/naen74b49k76\/2+7btvOcvr\/p53nbeUnnC20AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqPB5ewB0Oee8PYR\/anq+997R3+OZ6f1IPy\/p45uWvn7pptcv\/bxMmz4v2+5vOvuRZdt+pP89Sh\/ftv3dth\/p80237X5M8\/coS\/r7kr6\/6XyhDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVPm8PoN29d\/T3zjmjvzfNfHnTtvOSPl+e2XZe0sc3Lf0dSsFDAAAewUlEQVTvx\/R+pM932rb5bru\/6dL\/frgfz1i\/Z7atH1m2nb\/0v0fTtu1vOl9oAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAECFc++9bw+i2Tnn7SHAGp6r7zb9nqafl\/S\/H9Prl76\/6fsBb0q\/b8aXJX2+6eObZr7fzf2Af2fb+5LOF9oAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUOHce+\/bg2h2zhn9vfTtmJ7vtPT1m2Y\/sqTvx7T0\/U3fj23rlz5fsqSfv23vi\/34bun7se3vx7bzbH+fSV+\/9Pmm37dt+zst\/byk7286X2gDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQIVz771vD6LZOeftIfxoenun55t+\/NL3d9q287JtfNPM95n08zfNfLOkn2eybLtv2+5H+v5OSz8v6dLP8zTvQZb0+7ttf7ftR\/r92MYX2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQ4fP2APjTvXf09845o783Pb502+a7Tfr+pr8H0783zf4+Mz0+831m231L39\/08aWzfs84z9\/Nfjyzbb7p0s9z+vh4xn58N19oAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAECFz9sDaHfvfXsI\/JdzzttD+FH6eZlev\/T5kiX9vLgf3y19f6d\/L\/3vZbpt9zf9vKSPjyzb7m+69L9v\/p5nSZ9v+vlLH18665fFF9oAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUOHz9gD4u+69bw\/hR+ect4fwo+n1m55v+v5Oc16eST8v6fubbtv523ae0+ebPr5t0t\/T9PdqWvp808c3Lf29Mr5n0seXfj\/I4rw8Y\/2+my+0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKDCuffetwfR7Jwz+nvT25E+vnTT68cz287fNO9Blm3vS\/p52bYfPOP\/tSzp93fbfmyTfn\/T70c69\/eZ9PNnf5\/Z9v45L1l8oQ0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFc699749CHqcc94ewo8c52fS9zfd9Pmb3o\/08aVLX7\/09y99vunnedt8t0nf323vyzTrlyV9P6alvwfbzt8055nf2HZ\/0+e77f5O84U2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFT4vD0A\/nTOGf29e2\/0703Pd1r6fvBM+nlOPy\/p65du2\/qln2e+W\/r52\/b3I533+Zn0+aZLfw\/S9zf9\/UtfP\/iN9PvGd\/OFNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUOPfe+\/Yg2Ouc8\/YQfjR9Pabnmz6+advmO23bc29\/s3j\/sli\/Z9LXL\/09IMu2+zst\/T2Ylj7fbeNLl36et3E\/+Ca+0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACufee98eRLNzzttD+NH09k7PN31801w3fsN5fmbbe7VtP6ZZv2fS129a+v3ddl7M97ulvy\/p+7Ht\/JnvM9v+vm0bX7r0+zZt2\/5O84U2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFT4vD0A\/nTvHf29c87o76WPb9r0fOGbpL8v2+5v+nuaLn390v\/+pr8HfLdt5yX9Pdg2vmnWL0v6fNP3N\/3\/q\/T1S7dt\/dLP8za+0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACp+3B9Du3vv2EP6pc87bQ\/in0uebfv7S1y\/d9P5O70f6+SNL+nme5n48Y3+zpM9323lJn2+69PVL\/3\/N+HhT+nnhmfT76z3I4gttAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKjweXsA7c45o7937x39vW3S12\/6vJBl+vyln5f08fFM+ns6bdv9nZZ+Xqb3I\/3\/v\/TznH5e0m1bv\/T5pt+P9L9H6es3LX0\/pm07z9vYX97kC20AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqPB5ewDt7r1vD+GfSp\/vOeftIfxoev2m5zs9Puflu6Wf52nb5jst\/b3aNj6gV\/p7lS79PU3f323rt036+fNePZO+funvVfr6beMLbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACo8Hl7APxd997R3zvnjP7e9Pimf29a+vpNj29a+v5OS9\/fbec5\/X7wTPr5m2a+WdLf0222rd+287ft\/Uvf3\/Txpdu2funzTX8P4Jv4QhsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKpx77317EPzHOeftIfxo23GZ3o\/p9dt2XuxHlvT1Sx\/fNul\/P9LP37T0+W67b9Yvi\/ubxXnmN9Lf0\/T7Ns39\/W7O8zPb1m+aL7QBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoMLn7QG0O+e8PYQf3XvfHkI16\/fdpu\/vtvOS\/v6lSz8v0\/vrvDyT\/l6lj29a+nlO399ttq1f+nzT74f377ttOy\/u2zPp8902PrL4QhsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKpx77317EM3OOaO\/t207ptcv3bb93cZ78N28V8+k3w\/j+27b1i99vunj2yb979u287dtfNvYj2fS3\/v0\/UhfP\/gNX2gDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQIVz771vD4L\/OOeM\/t709k6Pb9q245x+XqZtm++09PVLf1+mbTt\/6Zy\/Z7at3zT7wZvS\/x5tO8\/p70H6+LbZdn\/T57tN+v1Nf6+c52d8oQ0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFc699749CP6ec87bQ\/jR9PEzX77Jtud523m2v1m2vc\/OH7\/hfsD\/b\/o8p5+\/bfc3fX+3jW8b+\/Hd0t\/7dL7QBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKn7cH0O6cM\/p7997o35ue77Tp+W6Tfl7Sx5cufT+mpZ+XbfvBM+n76zw\/s22+6bad5\/T5+n+N39i2fu4bv5H+9wh+wxfaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFDh3Hvv24PgP845bw\/hR9PHZXq+28Y3Lf38TbMfWdL3Y9q2\/U2X\/vdjWvp9S1+\/bdLPy7T0\/\/+M77ulr5\/xPWN8z\/j\/gG+y7e\/bNF9oAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAECFz9sD4E\/33reH8E+lzzd9fOect4fwo+n1S5\/vtPT1Sx\/ftPT3IH186fvrfny39PsxLf28pN+3dOnvy7bxTUsf3zbp7+m09Ps7bdt9S9+PadvO8za+0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACp+3B9DunPP2EChy7317CP\/U9P2wfs9Mr1\/6+5c+323j2zbfdOn3N53zl8V55jfS72\/6ed4232np7\/22\/ZiW\/r7wjP3I4gttAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKjweXsA\/One+\/YQ+C\/nnLeH8E9Nn7\/p9Zv+Pfftu6Xf3\/TznL5+6fd32\/qlz3da+vnbJn0\/0t\/79PWbZr7PeO+f8R48k37+0tdvm\/T7xjO+0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACufee98eRLNzzujvTW\/H9PjSpa+f6\/ZM+n5su2\/Ttt2P9POSvh\/p6zct\/b1KHx9ZnJcs6e\/9tPT3b1r6\/Uh\/D9LHN8155k3bzl\/6fNP5QhsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAACACoI2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKnzeHgDwvzvnvD2EH9173x7Cj6bXb3q+6eOb5jzzG\/bjmfT1Sx+f9+qZ9PXju227H+nznbZtvvAb6ffD\/wf8hi+0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKDC5+0BAP+7e+\/o751zRn8vXfr6bRtfum33Y9t52TbfdOn7YX+\/W\/rf32np921a+ny3rV+69P1IH1\/6fZuWPt\/08U1LXz+e8YU2AAAAAAAVBG0AAAAAACoI2gAAAAAAVBC0AQAAAACoIGgDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFT4vD0A\/q5779tD4C8657w9hB8Z3zPp4yNL+nuffp6n1296vunj22bb+qW\/L9Pc3yzp83VesqS\/V+n7m75+6efZ\/j5j\/fgNX2gDAAAAAFBB0AYAAAAAoIKgDQAAAABABUEbAAAAAIAKgjYAAAAAABUEbQAAAAAAKgjaAAAAAABUELQBAAAAAKggaAMAAAAAUEHQBgAAAACggqANAAAAAEAFQRsAAAAAgAqCNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQIXP2wPgT+ect4dAkXvv6O9tO3\/T6zdtej\/Sz0v6+Kalzzf9fli\/LOnzTX8PtnFentm2funv\/bT08U1LP8\/bpN\/fadPzTb+\/6eOD3\/CFNgAAAAAAFQRtAAAAAAAqCNoAAAAAAFQQtAEAAAAAqCBoAwAAAABQQdAGAAAAAKCCoA0AAAAAQAVBGwAAAP6vXTs2AQAGYBhG\/z86PaFjMUgXZDYBABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASBG0AAAAAABIEbQAAAAAAEgRtAAAAAAASzrb9HgEAAAAAAC8e2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJAjaAAAAAAAkCNoAAAAAACQI2gAAAAAAJFzH\/l+SGf+ySgAAAABJRU5ErkJggg==">
                        </div>
                    </div>
                    <div class="form-floating group-pix-copy-paste">
                        <input type="text" class="form-control" value="00020101021226890014br.gov.bcb.pix2567qrcodes.cielo.com.br\/pix-qr\/v2\/eecafa95-3012-4e1f-a1d8-ebba372192ef5204000053039865802BR5925PENHA DE SOUZA JAMARIQUEL6010MARATAIZES62070503***6304419E" />
                        <label for="pixcopypaste">Código do Pix Copia e Cola</label>
                    </div>
                    <div class="input-group d-none">
                        <label>Código do Pix Copia e Cola</label>
                        <input class="form-control" type="text" placeholder="00020101021226890014br.gov.bcb.pix2567qrcodes.cielo.com.br\/pix-qr\/v2\/eecafa95-3012-4e1f-a1d8-ebba372192ef5204000053039865802BR5925PENHA DE SOUZA JAMARIQUEL6010MARATAIZES62070503***6304419E" readonly>
                    </div>
                    <span id="btnPixCopyPaste" class="animate__animated text-primary d-none_" onclick="pixCopyPaste(this)" data-code="00020101021226890014br.gov.bcb.pix2567qrcodes.cielo.com.br\/pix-qr\/v2\/eecafa95-3012-4e1f-a1d8-ebba372192ef5204000053039865802BR5925PENHA DE SOUZA JAMARIQUEL6010MARATAIZES62070503***6304419E">
                    Copiar código do PIX
                    </span>
                </div>
                <p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none"></p>
            </div>
            `;

        var modalCard = `
            <div id="modalCard" class="bg-white text-center justify-content-center">
                <small id="timerPaymentQrCode" class="text-danger">00:00</small>
                <div class="box-price-qrcode-card pb-1">
                    <h4 class="text-danger pt-2"><b>Valor total: R$ </b><span class="font-weight-bold">1,00</span></h4>
                    <p> Faturas selecionadas: <b class="total-count"></b></p>
                </div>
                <small class="pt-2 text-black-50">Preencha os campos com os dados de seu cartão</small>
                <div class="container-card">

                </div>
                <p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none"></p>
            </div>
            `;

        // Swal.fire({
        //     title: 'Pagamento nº '+ paymentId +' com CRÉDITO',
        //     html: modalCard,
        //     showConfirmButton: false,
        //     showDenyButton: false,
        //     denyButtonText: '<i class="fas fa fa-times pr-1" aria-hidden="true"></i>CANCELAR',
        //     denyButtonColor: '#d33',
        //     // footer: '<a href="">Cancelar</a>'
        // })

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


        var ObjData = {
            "data": {
                "customer": "34258",
                "billets": [
                    {
                        "billet_id": "1246934",
                        "reference": "0088874-4",
                        "duedate": "15/05/2023",
                        "value": 5.9,
                        "addition": "2.11",
                        "discount": 0,
                        "price": 8.01,
                        "count": 1,
                        "installment": 1,
                        "total": 8.01
                    }
                ],
                "installment": 1,
                "method": "ecommerce",
                "payment_type": "credit",
                "amount": 8.01,
                "reference": "d3924e99-be88-41ed-8853-05cede4fb75e",
                "updated_at": "2023-10-31T13:19:13.000000Z",
                "created_at": "2023-10-31T13:19:13.000000Z",
                "id": 1418,
                "status": "refused",
                "terminal": null
            }
        }



    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>

{{--    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>--}}
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>--}}
        <script type="text/javascript" defer>
            // inactivitySession();
        </script>
@endsection



