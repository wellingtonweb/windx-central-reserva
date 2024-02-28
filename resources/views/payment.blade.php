@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid container-payment d-none">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
                        <nav id="infoCustomerActive" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pagamento</li>
                            </ol>
                        </nav>
                        <div class="header-app col-12 font-weight-bolder d-flex justify-content-between" style="display: none">
                            <a href="javascript:history.back();"><i class="fas fa-arrow-left pr-3"></i></a>
                            <span>{{$header}}</span>
                            <span class="px-3"></span>
                        </div>
                        <div id="buttonsCheckout" class=" col-12 ">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div class="row">
                                    <div class="col order-lg-0 order-md-0 order-sm-0 px-2">
                                        <div id="infoCheckout" class="content-box col-12 mb-2">
                                            <div id="checkout-box-web" class="row row-cols-2 row-cols-sm-2 row-cols-md-5">
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
                                            <div id="checkout-box-mobile" class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex pl-2">
                                                        <i id="trashIcon" class="fas fa-trash-alt text-danger fa-2x clear-cart" style="cursor: pointer"></i>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span class="infoText" style="letter-spacing: 1px;">Formas de pagamento: Crédito, Pix e Picpay</span>
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
        <section class="teste d-none_">
            <div>
                <h2>3DS v2 CIELO</h2>
                <input type="hidden" name="authEnabled" class="bpmpi_auth" value="true" />
                <input type="hidden" name="authEnabledNotifyonly" class="bpmpi_auth_notifyonly" value="false" />
                <input type="hidden" name="bpmpi_auth_suppresschallenge" class="bpmpi_auth_suppresschallenge" value="false" />
                    <input type="text" placeholder="bpmpi_accesstoken" name="accessToken" id="accessToken" class="bpmpi_accesstoken" value="" />
                    <input type="text" placeholder="bpmpi_ordernumber" size="50" name="orderNumber" class="bpmpi_ordernumber" value="{{session('_token')}}" />
                    <input type="hidden" placeholder="bpmpi_currency" size="50" name="currency" class="bpmpi_currency" value="986" />
                    <input type="text" placeholder="bpmpi_totalamount" size="50" name="amount" class="bpmpi_totalamount" value="" />
                    <input type="text" placeholder="bpmpi_installments" size="2" name="installments" class="bpmpi_installments" value="1" />
                    <input type="text" placeholder="bpmpi_paymentmethod" size="50" name="paymentMethod" class="bpmpi_paymentmethod" value="" />
                    <!-- //Preencher com o payment_type
                        <select name="paymentMethod" class="bpmpi_paymentmethod">
                        <option value="credit" selected="selected">Credit</option>
                        <option value="debit">Debit</option>
                    </select>-->

                    <input type="text" placeholder="bpmpi_cardnumber" size="50" name="cardNumber" class="bpmpi_cardnumber" value="" />
                    <input type="text" placeholder="bpmpi_cardexpirationmonth" size="50" name="expMonth" class="bpmpi_cardexpirationmonth" value="" />
                    <input type="text" placeholder="bpmpi_cardexpirationyear" size="50" name="expYear" class="bpmpi_cardexpirationyear" value="" />
                    <input type="text" placeholder="bpmpi_cardalias" size="50" class="bpmpi_cardalias" value="" />
                        <input type="text" placeholder="bpmpi_billto_contactname" size="50" class="bpmpi_billto_contactname" value="{{session('customer.full_name')}}" />
                        <input type="text" placeholder="bpmpi_billto_phonenumber" size="50" class="bpmpi_billto_phonenumber" value="{{preg_replace('/[^\d]/i', '', session('customer.phone'))}}" />
                        <input type="text" placeholder="bpmpi_billto_email" size="50" class="bpmpi_billto_email" value="{{session('customer.email')}}" />
                        <input type="text" placeholder="bpmpi_billto_street1" size="50" class="bpmpi_billto_street1" value="{{session('customer.street')}}" />
                        <input type="text" placeholder="bpmpi_billto_street2" size="50" class="bpmpi_billto_street2" value="{{session('customer.district')}}" />
                        <input type="text" placeholder="bpmpi_billto_city" size="50" class="bpmpi_billto_city" value="{{session('customer.city')}}" />
                        <input type="text" placeholder="bpmpi_billto_state" size="50" class="bpmpi_billto_state" value="{{session('customer.state')}}" />
                        <input type="hidden" size="2" class="bpmpi_billto_country" value="BR" />
                        <input type="text" placeholder="bpmpi_billto_zipcode" size="50" class="bpmpi_billto_zipcode" value="{{preg_replace('/[^\d]/i', '', session('customer.cep'))}}" />
                        <input type="hidden" size="50" class="bpmpi_shipto_sameasbillto" value="true" />
                        <input type="text" placeholder="bpmpi_device_ipaddress" size="50" class="bpmpi_device_ipaddress" value="" />
                        <input type="hidden" size="7" class="bpmpi_device_channel" value="Browser" />
                        <input type="hidden" size="50" class="bpmpi_transaction_mode" value="S" />
                        <input type="hidden" size="50" class="bpmpi_merchant_url" value="https://www.windx.com.br" />
                        <input type="hidden" size="50" class="bpmpi_order_productcode" value="PHY" />
                    <input type="button" onclick="sendOrder()" value="Send Order" id="btnSendOrder" />
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
                                        <input id="customer" name="customer" value="{{session('customer.id')}}" type="hidden">
                                        <input id="cartBillets" name="billets" type="hidden">
                                        <input id="full_name" name="full_name" type="hidden" value="{{session('customer.full_name')}}">
                                        <input id="email" name="email" type="hidden" value="{{session('customer.email')}}">
                                        <input id="cpf_cnpj" name="cpf_cnpj" type="hidden" value="{{session('customer.document')}}">
                                        <input id="phone" name="phone" type="hidden" value="{{session('customer.phone')}}">
                                        <input id="payment_type" name="payment_type" type="hidden">
                                        <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                        <input id="method" name="method" type="hidden">
                                        <input id="installment" name="installment" type="hidden">
                                        <input id="company" name="company" type="hidden" value="{{session('customer')['company_id']}}">

                                    </div>
                                    <div class="col-12">
                                        <div class="col-12 w-100 alert alert-danger text-display-error text-center justify-content-center font-weight-bold d-none"
                                             role="alert">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 px-3 text-left">
                                        <input id="3dsCavv" placeholder="3ds_cavv" name="cavv" type="text">
                                        <input id="3dsEci" placeholder="3ds_eci" name="eci" type="text">
                                        <input id="3dsVersion" placeholder="3ds_version" name="version" type="text">
                                        <input id="3dsReferenceId" placeholder="3ds_reference_id" name="reference_id" type="text">
                                        <input id="cc-bandeira" type="text" class="form-control" name="bandeira">

                                        <label for="cc-nome">Nome no titular</label>
                                        <input type="text" class="form-control text-uppercase" id="cc-nome"
                                               name="holder_name" placeholder="Nome como está no cartão">
                                        <small class="text-danger error-text holder_name_error"></small>
                                    </div>
                                    <div class="col-10 mb-3 px-3 text-left">
                                        <label for="cc-numero">Número do cartão</label>
                                        <input type="text" class="form-control" id="cc-numero"
                                               name="card_number" placeholder="0000 0000 0000 0000" onblur="getBrand(this)" onchange="getBrand(this)" min="15" max="19">

{{--                                        <div class="card-number input-group mb-3 w-auto" style="background-color: transparent !important; border: none; align-items: normal;">--}}
{{--                                            <div class="input-group-prepend " style="margin-right: -6px; margin-top: -6px">--}}
{{--                                                <div class="input-group-text" id="basic-addon1" style="padding: 0; ">--}}
{{--                                                    <img id="icon_flag" class="icon-flag_" src="/assets/img/flags/card.svg" alt="card flag" width="35">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <input type="text" class="form-control" id="cc-numero"--}}
{{--                                                   name="card_number" placeholder="0000 0000 0000 0000" onblur="getBrand(this)">--}}

{{--                                        </div>--}}
                                        <small class="text-danger error-text card_number_error"></small>
                                    </div>
                                    <div class="col-2 mb-3 px-3 d-flex justify-content-end align-items-end" style="margin-bottom: .45rem !important;">
                                        <img id="icon_flag" src="/assets/img/flags/card.svg" alt="bandeira" width="55" style="margin-left: -5px">
{{--                                        <input id="cc-bandeira" type="text" class="form-control" name="bandeira">--}}
{{--                                        <input type="text" class="form-control" id="cc-bandeira" name="bandeira" readonly>--}}
{{--                                        <small class="text-danger error-text bandeira_error"></small>--}}
                                    </div>
{{--                                    <div class="col-6 mb-3 px-3 text-left">--}}
{{--                                        <label for="cc-bandeira">Bandeira do cartão</label>--}}
{{--                                        <select id="cc-bandeira" name="bandeira"--}}
{{--                                                class="form-control">--}}
{{--                                            <option value="" disabled selected>Escolher</option>--}}
{{--                                            <option value="American Express">American Express</option>--}}
{{--                                            <option value="Aura">Aura</option>--}}
{{--                                            <option value="Banescard">Banescard</option>--}}
{{--                                            <option value="Cabal">Cabal</option>--}}
{{--                                            <option value="Dinners">Dinners</option>--}}
{{--                                            <option value="Elo">Elo</option>--}}
{{--                                            <option value="Hipercard">Hipercard</option>--}}
{{--                                            <option value="Master">Master</option>--}}
{{--                                            <option value="Visa">Visa</option>--}}
{{--                                        </select>--}}
{{--                                        <small class="text-danger error-text bandeira_error"></small>--}}
{{--                                    </div>--}}
                                    <div class="col-4 mb-3 px-3 text-left">
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
                                    <div class="col-4 mb-3 px-3 text-left">
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

                                    <div class="col-4 mb-3 px-3 text-left">
                                        <label for="cc-cvv">Cód. de segurança</label>
                                        <input type="text" class="form-control" id="cc-cvv" name="cvv" placeholder="Ex: 123">
                                        <small class="text-danger error-text cvv_error"></small>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <button id="sendPayment" class="btn btn-success btn-block"
                                            type="submit" disabled>Finalizar pagamento
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
        .icon-flag {
            position:absolute;
            top:0; right:0;
            z-index:10;
            border:none;
            background:transparent;
            outline:none;
        }

        .card-number {
            position: relative;
            width: 100%;
        }

        .card-number input {
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/pages/payment.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    {{--    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>--}}

    <script>
        var idCustomer = {{session('customer.id')}};
        var customerActive = @json(session('customer'));
        var maxInstallment = {{ env('MAX_INSTALLMENT') }};
        var minInstallmentValue = {{ env('MIN_INSTALLMENT_VALUE') }};
        let urlGetBillets = "{{ route('central.get.billets') }}";
        var checkoutForm = $('#form_checkout')[0];

        document.getElementsByClassName("bpmpi_accesstoken")[0].value = '';

        // Swal.fire({
        //     icon: "info",
        //     title: `Selecione uma ou mais faturas para pagamento!`,
        //     html: `<div class="p-2 d-flex justify-content-center align-items-center">
        //                     <div class="container-screen">
        //                         <div>Fatura 4</div>
        //                         <div>Fatura 5</div>
        //                         <div>Fatura 1</div>
        //                         <div>Fatura 2</div>
        //                         <div>Fatura 3</div>
        //                         <i class="fas fa-hand-pointer fa-2x hand-icon"></i>
        //                     </div>
        //                 </div>`,
        //     showDenyButton: false,
        //     showCancelButton: false,
        //     showConfirmButton: true,
        //     confirmButtonText: 'OK',
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
    <script type="text/javascript">
        // document.getElementsByClassName("bpmpi_ordernumber")[0].value = generateOrderNumber();
        //
        // var merchantData = {};
        // var authorization = '';
        $('#modalCard').on('show.bs.modal', function (event) {
            //getToken3DSCielo(customerActive.company_id);
        })

        function getToken3DSCielo(companyId) {
            var companyData = {};
            document.getElementsByClassName("bpmpi_accesstoken")[0].value = '';

            switch(companyId){
                case 5:
                    companyData.merchantData = {"EstablishmentCode": "2893748702","MerchantName": "JDS","MCC": "4816"};
                    companyData.authorization = btoa('1b41f1b2-2027-45f2-be17-c365135effeb:zUTDqxIsLELd6SDhSWCt7bxXAsU01Y2XhSrM+oR3N/Q=');
                    break;
                case 6:
                    companyData.merchantData = {"EstablishmentCode": "2893663839","MerchantName": "ANTONIO CARLOS DE SOUZA JAMARIQUELI","MCC": "4816"};
                    companyData.authorization = btoa('aeaf4ed9-80fd-4a99-85b8-a4fd1bf837c6:nNmnLTqgPiDCjBcL+ASOHrDSJKHAgVw9twoey6a001o=');
                    break;
                default:
                    companyData.merchantData = {"EstablishmentCode": "1106093345","MerchantName": "WIDX","MCC": "4814"};
                    companyData.authorization = btoa('521ab3e1-b97d-4090-8d2f-3292c36ea26e:JeR2HoUjq4oyjOC3/nZAlZkkFKdmNP26p50swKzdRVY=');
            }

            fetch("https://mpi.braspag.com.br/v2/auth/token", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Basic ${companyData.authorization}`
                },
                body: JSON.stringify(companyData.merchantData),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        $('#modalCard').modal('hide');
                        alert(data.error_description)
                        console.log(data.error_description);

                    }else{
                        document.getElementsByClassName("bpmpi_accesstoken")[0].value = data.access_token
                    }
                })
                .catch((error) => {
                    console.error(error);
                })
                .finally(() => {
                    // console.log('Preencher os campos 3DS com os dados')
                    // console.log('Submeter o form usando a função bpmpi_authenticate()')
                    // bpmpi_authenticate();

                    // console.log('Submeter o form usando a função bpmpi_authenticate()')
                    // alert('Finalizou!')
                });
        }

        function toogleFlag(flag){
            var imgFlag = document.getElementById("icon_flag");
            var cc_brand = document.getElementById("cc-bandeira");

            switch (flag){
                case 'Visa':
                    imgFlag.src = "/assets/img/flags/visa.svg";
                    cc_brand.value = flag;
                    break;
                case 'Mastercard':
                    imgFlag.src = "/assets/img/flags/mastercard.svg";
                    cc_brand.value = flag;
                    break;
                case 'Amex':
                    imgFlag.src = "/assets/img/flags/amex.svg";
                    cc_brand.value = flag;
                    break;
                case 'Elo':
                    imgFlag.src = "/assets/img/flags/elo.svg";
                    cc_brand.value = flag;
                    break;
                case null:
                case '':
                case false:
                default:
                    imgFlag.src = "/assets/img/flags/card.svg";
                    cc_brand.value = '';
                    break;
            }
        }

        function bpmpi_config() {
            // swal.fire('Autenticando...')
            return {
                onReady: function () {
                    // Evento indicando quando a inicialização do script terminou.
                    document.getElementById("sendPayment").disabled = false;
                },
                onSuccess: function (e) {
                    // Cartão elegível para autenticação, e portador autenticou com sucesso.
                    var cavv = e.Cavv;
                    var xid = e.Xid;
                    var eci = e.Eci;
                    var version = e.Version;
                    var referenceId = e.ReferenceId;
                    console.log("Deu certo: ", cavv, xid, eci, version, referenceId, e)
                    document.getElementsById("3dsCavv").value = e.Cavv;
                    document.getElementsById("3dsEci").value = e.Eci;
                    document.getElementsById("3dsVersion").value = e.Version;
                    document.getElementsById("3dsReferenceId").value = e.ReferenceId;

                    console.log('Habilita o botão para enviar o pagamento!')

                },
                onFailure: function (e) {
                    // Cartão elegível para autenticação, porém o portador finalizou com falha.
                    var xid = e.Xid;
                    var eci = e.Eci;
                    var version = e.Version;
                    var referenceId = e.ReferenceId;
                },
                onUnenrolled: function (e) {
                    // Cartão não elegível para autenticação (não autenticável).
                    var xid = e.Xid;
                    var eci = e.Eci;
                    var version = e.Version;
                    var referenceId = e.ReferenceId;
                },
                onDisabled: function () {
                    // Loja não requer autenticação do portador (classe "bpmpi_auth" false -> autenticação desabilitada).
                },
                onError: function (e) {
                    // Erro no processo de autenticação.
                    var xid = e.Xid;
                    var eci = e.Eci;
                    var returnCode = e.ReturnCode;
                    var returnMessage = e.ReturnMessage;
                    var referenceId = e.ReferenceId;
                },
                onUnsupportedBrand: function (e) {
                    // Bandeira não suportada para autenticação.
                    var returnCode = e.ReturnCode;
                    var returnMessage = e.ReturnMessage;
                },
                Environment: "PRD",
                Debug: true,
            };
        }

        $(function () {
            $.getJSON("https://api.ipify.org?format=jsonp&callback=?",
                function (json) {
                    document.getElementsByClassName("bpmpi_device_ipaddress")[0].value = json.ip
                }
            );
        });

        function parseToCents(reais) {
            return Math.round(reais * 100); // Arredondando para o inteiro mais próximo
        }

        // Exemplo de uso
        // var valorEmReais = 69.90; // Substitua isso pelo valor real em reais
        // var valorEmCentavos = parseToCents(valorEmReais);
        // console.log('O valor em centavos é: ' + valorEmCentavos + ' centavos');

        function getBrand(input){
            var cardNumber = $(input).val()
            var inputCCnumero = document.getElementById('cc-numero')

            var cardFlag = {
                getCardFlag: function(cardnumber) {
                    var cardnumber = cardnumber.replace(/[^0-9]+/g, '');
                    inputCCnumero.value = cardnumber;

                    var cards = {
                        Visa      : /^4[0-9]{12}(?:[0-9]{3})/,
                        Mastercard : /^((5(([1-2]|[4-5])[0-9]{8}|0((1|6)([0-9]{7}))|3(0(4((0|[2-9])[0-9]{5})|([0-3]|[5-9])[0-9]{6})|[1-9][0-9]{7})))|((508116)\\d{4,10})|((502121)\\d{4,10})|((589916)\\d{4,10})|(2[0-9]{15})|(67[0-9]{14})|(506387)\\d{4,10})/,
                        // Mastercard : /^5[1-5][0-9]{14}/,
                        Amex      : /^3[47][0-9]{13}/,
                        Elo        : /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/,
                    };

                    for (var flag in cards) {
                        if(cards[flag].test(cardnumber)) {
                            return flag;
                        }
                    }

                    return false;
                }

            }

            var flag = cardFlag.getCardFlag(cardNumber)
            if(document.getElementById('cc-numero').value != ''){
                toogleFlag(flag)
                if(!flag && (cardNumber.length >= 16 || cardNumber.length <= 16)){
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Bandeira do cartão não suportada!",
                    });
                    inputCCnumero.value = '';
                }
                // else{
                //
                // }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form_checkout');
            const formControls = form.querySelectorAll('.formControl');
            const submitButton = form.querySelector('button');

            function validateInput(input) {
                const value = input.value.trim();
                const isValid = /^[a-zA-Z0-9]+$/.test(value);
                return isValid;
            }

            function checkFormValidity() {
                const allInputsValid = Array.from(formControls).every(validateInput);
                submitButton.disabled = !allInputsValid;
            }

            formControls.forEach(function(input) {
                input.addEventListener('blur', function() {
                    const isValid = validateInput(input);
                    if (!isValid) {
                        alert('Por favor, insira apenas números e letras.');
                        input.focus();
                    }
                    checkFormValidity();
                });
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Realizar a ação do envio do formulário aqui
                alert('Formulário enviado!');
            });
        });

        $('#modalCard').modal('show')
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/BP.Mpi.3ds20.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession()</script>--}}
@endsection
