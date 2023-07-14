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
                                                @foreach($customers as $key => $customer)
                                                    <div id="invoice-{{ $customer->id }}" class="invoice-slide"
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
                                                                                    <span
                                                                                        class="text-primary font-weight-bold">LIBERADO</span>
                                                                                    @break;
                                                                                    @case('B')
                                                                                    <span
                                                                                        class="text-danger font-weight-bold">BLOQUEADO</span>
                                                                                    @break;
                                                                                    @case('X')
                                                                                    <span
                                                                                        class="text-secondary font-weight-bold">DESATIVADO</span>
                                                                                    @break;
                                                                                @endswitch
                                                                            </p>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <button
                                                                                id="contract-selected-{{$customer->id}}"
                                                                                data-invoices="{{ json_encode($customer->billets) }}"
                                                                                class="btn btn-primary btn-radius-50 btn-contract-selected">
                                                                                <i class="fas fa fa-check"
                                                                                   aria-hidden="true"></i> Selecionar
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="container-icon-move-hand {{count($customers) < 4 ? 'd-none': ''}}">
                                                                        {{--                                                    <div class="container-icon-move-hand {{count($customer[0]->billets) == 1 ? 'd-none-': ''}}">--}}
                                                                        <i class="fa fa-long-arrow-alt-left icon-arrow-left"></i>
                                                                        <i class="fa fa-hand-pointer icon-move-hand"></i>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                            @if($customer->billets != null)--}}

{{--                                    <div id="invoices-container"--}}
{{--                                         class="row row-invoices animate__animated animate__fadeIn d-none-">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="row checkout">--}}
{{--                                                <div class="col-12 checkout-status">--}}
{{--                                                    <div class="checkout-status-count">--}}
{{--                                                        <span class="text-left pr-1">Faturas selecionadas: </span>--}}
{{--                                                        <span class="total-count dynamic"></span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkout-status-total">--}}
{{--                                                        <span class="text-left pr-1">Total à pagar:</span>--}}
{{--                                                        <span class="dynamic"> R$--}}
{{--                                                            <span class="total-cart"></span>--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @foreach($customers as $key => $customer)--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-12">--}}
{{--                                                    --}}{{--                                                Invoices cards--}}
{{--                                                    --}}{{--                                                {{dd($customers[0]->id)}}--}}
{{--                                                    <div id="news-slider" class="owl-carousel" data-customer="{{$customer->id}}">--}}
{{--                                                        @foreach($customer->billets as $key => $invoice)--}}
{{--                                                            {{ $invoice->Id }}--}}

{{--                                                        @endforeach--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="row">
                                        <div class="col-12">
                                            <div id="container-btn-checkout-" class="checkout-controls">
                                                <div class="form-group-">
                                                    <button type="button" id="btn-pix"
                                                            class="btn btn-windx font-weight-bold btn-payment-type">Pix
                                                    </button>
                                                    <button type="button" id="btn-picpay"
                                                            class="btn btn-windx font-weight-bold btn-payment-type">
                                                        PicPay
                                                    </button>
                                                    <button type="button" id="btn-credit"
                                                            class="btn btn-windx font-weight-bold btn-payment-type">
                                                        Crédito
                                                    </button>
                                                    <button type="button" id="btn-debit"
                                                            class="btn btn-windx font-weight-bold btn-payment-type">
                                                        Débito
                                                    </button>
                                                </div>
                                                <div class="form-group-">
                                                    <a href="#" id="back-to-contracts" class="btn btn-primary">
                                                        <i class="fas fa fa-arrow-left pr-1" aria-hidden="true"></i>Contratos
                                                    </a>
                                                    <button type="button" id="clear-cart"
                                                            class="btn btn-danger clear-cart btn-radius-50" disabled>
                                                        <i class="fas fa fa-times pr-1" aria-hidden="true"></i>Cancelar
                                                    </button>
                                                </div>
                                            </div>
                                            {{--                                                </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            @else--}}
                            {{--                                <div class="row row-invoices animate__animated animate__fadeIn">--}}
                            {{--                                    <div class="col-12">--}}
                            {{--                                        <h4 class="font-weight-bold">Checkout</h4>--}}
                            {{--                                        <script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>--}}
                            {{--                                        <script>--}}
                            {{--                                            Swal.fire({--}}
                            {{--                                                icon: 'info',--}}
                            {{--                                                // title: 'Atenção!',--}}
                            {{--                                                title: 'Este cadastro não possuí faturas em aberto!',--}}
                            {{--                                                footer: 'Agradecemos sua pontualidade!',--}}
                            {{--                                                showConfirmButton: false,--}}
                            {{--                                                timer: 5000--}}
                            {{--                                            }).then((result) => {--}}
                            {{--                                                if (result.dismiss === Swal.DismissReason.timer) {--}}
                            {{--                                                    history.back();--}}
                            {{--                                                }--}}
                            {{--                                            })--}}
                            {{--                                            Swal.fire({--}}
                            {{--                                                imageUrl: 'http://localhost:8000/assets/img/arrastar2.gif',--}}
                            {{--                                                text: 'Arraste para os lados para navegar entre as faturas',--}}
                            {{--                                                imageAlt: 'Navegar faturas',--}}
                            {{--                                                showConfirmButton: true,--}}
                            {{--                                                showDenyButton: false,--}}
                            {{--                                                showCancelButton: false,--}}
                            {{--                                                confirmButtonText: 'Entendi',--}}
                            {{--                                            }).then((result) => {--}}
                            {{--                                                /* Read more about isConfirmed, isDenied below */--}}
                            {{--                                                if (result.isConfirmed) {--}}
                            {{--                                                    //--}}
                            {{--                                                }--}}
                            {{--                                            })--}}
                            {{--                                        </script>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            @endif--}}
                        </div>
                        {{--                                        @endforeach--}}
                    </section>
                    <section>
                        <div id="container-modal">
                            {{--                            <!-- Modal -->--}}
                            <div id="modal-payment-form" class="modal fade" data-backdrop="static" data-keyboard="false"
                                 tabindex="-1" role="dialog" aria-labelledby="cart" aria-hidden="true"
                                 data-backdrop="static">
                                <div id="payment-form-dialog" class="modal-dialog modal-dialog-centered"
                                     role="document">
                                    <form id="form_checkout" method="POST" action="{{route('terminal.checkout')}}">
                                        {{--                                        @csrf--}}
                                        <div class="modal-content p-3">
                                            <div class="modal-body bg-white">
                                                <div id="payment-card">
                                                    <div class="form-row text-center justify-content-center">
                                                        <h5>Pagamento de
                                                            <span class="total-count font-weight-bold"></span>
                                                            <span class="display-text"></span>
                                                            <span
                                                                class="payment_type_label font-weight-bold"></span><br><br>
                                                            Total à pagar: <b>R$ </b><span
                                                                class="total-cart font-weight-bold"></span>
                                                        </h5>
                                                    </div>
                                                    <div id="inputs-hidden" class="form-row d-none">
                                                        <input id="customer" name="customer" value="{{$customer->id}}"
                                                               type="text" hidden>
                                                        <input id="cartBillets" name="billets" type="text" hidden>
                                                        <input id="ip_address" value="1.1.1.1" name="ip_address"
                                                               type="text" hidden>
                                                        <input id="full_name" name="full_name" type="text"
                                                               value="{{$customer->full_name}}" hidden>
                                                        <input id="email" name="email" type="text"
                                                               value="{{$customer->email}}" hidden>
                                                        <input id="cpf_cnpj" name="cpf_cnpj" type="text"
                                                               value="{{$customer->document}}" hidden>
                                                        <input id="phone" name="phone" type="text"
                                                               value="{{$customer->phone}}" hidden>
                                                        <input id="payment_type" name="payment_type" type="text" hidden>
                                                        <input id="token" type="hidden" name="_token"
                                                               value="{{ csrf_token() }}"/>
                                                        <input id="method" name="method" type="text" hidden>
                                                    </div>
                                                    <div class="form-row mt-2">
                                                        <div
                                                            class="alert alert-danger text-display-error text-center justify-content-center w-100 font-weight-bold d-none"
                                                            role="alert">
                                                        </div>
                                                        <div class="col-md-12 mb-3 text-left">
                                                            <label for="cc-nome">Nome no cartão</label>
                                                            <input type="text" class="form-control text-uppercase"
                                                                   value="WELLINGTON FERREIRA" id="cc-nome"
                                                                   name="holder_name"
                                                                   placeholder="Nome como está no cartão">
                                                            <small
                                                                class="text-danger error-text holder_name_error"></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3 text-left">
                                                            <label for="cc-numero">Nº do cartão</label>
                                                            <input type="text" class="form-control"
                                                                   value="5226069490151810" id="cc-numero"
                                                                   name="card_number" placeholder="0000 0000 0000 0000">
                                                            <small
                                                                class="text-danger error-text card_number_error"></small>
                                                        </div>
                                                        <div class="col-md-6 mb-3 text-left">
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
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-4 mb-3 text-left">
                                                            <label for="cc-expiracao">Mês</label>
                                                            <input type="text" class="form-control" value="07"
                                                                   id="expiration_month" name="expiration_month"
                                                                   placeholder="Ex: 12">
                                                            <small
                                                                class="text-danger error-text expiration_month_error"></small>
                                                        </div>
                                                        <div class="col-4 mb-3 text-left">
                                                            <label for="cc-expiracao">Ano</label>
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
                                                    <div
                                                        class="form-row checkout-modal-controls justify-content-center mt-2">
                                                        <button type="reset" class="btn btn-danger btn-lg m-2"
                                                                data-dismiss="modal">
                                                            <i class="fas fa-times" aria-hidden="true"></i>
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                                class="btn btn-success btn-lg font-weight-bolder m-2">
                                                            <i class="fas fa-dollar-sign" aria-hidden="true"></i>
                                                            Finalizar
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('css_old')
    {{--    --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <style>

    </style>
@endsection

@section('js')


    {{--    <script type="text/javascript" src="{{ asset('assets/js/e-cart.js') }}"></script>--}}{{-- Substituiu o billets.cart e main --}}
    {{--    <script type="text/javascript" src="{{ asset('assets/js/e-cart-control.js') }}"></script>--}}{{-- Substituiu o billets.cart e main --}}
    {{--    <script type="text/javascript" src="{{ asset('assets/js/e-cart-checkout.js') }}"></script>--}}{{-- Substituiu o billets.cart e main --}}
    {{--        3 ARQUIVOS UNIFICADOS EM UM = CHECKOUT      --}}

    <script type="text/javascript"
            src="{{ asset('assets/js/payment.js') }}"></script>{{-- Substituiu o billets.cart e main --}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/swiper.js') }}"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>--}}

    {{--    <script type="text/javascript" src="{{ asset('assets/central/js/printThis.js') }}"></script>--}}
    {{--    <script type="text/javascript" src="{{ asset('assets/central/js/html2pdf.bundle.min.js') }}"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>--}}
    {{--<script src="https://cdn.jsdelivr.net/npm/canvas2image@1.0.5/canvas2image.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/js/generate-pdf.js') }}"></script>--}}



    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper_invoices", {
            slidesPerView: 3,
            centeredSlides: true,
            spaceBetween: 0,
            // pagination: {
            //     el: ".swiper-pagination",
            //     type: "fraction",
            // },
            navigation: {
                nextEl: ".swiper-btn-next",
                prevEl: ".swiper-btn-prev",
            },
        });


    </script>
    <script>

    </script>
    <script>
        $(window).on("load", function () {
            // inactivitySession();
        });

        $('.btn-contract-selected').click(function () {
            let customer_id = $(this).attr('id').replace(/\D/g, '')
            let invoices = JSON.parse($(this).attr('data-invoices'));

            // console.log(invoices.length)

            if (invoices.length != 0) {
                // if (invoices.length != 0 || typeof (invoices) != "undefined") {

                console.log($(this).attr('data-invoices'), invoices.length, invoices)
                loadInvoices(customer_id, $(this).attr('data-invoices'));
                $('#payment-title').text('Contrato Nº: ' + customer_id + ' - (Checkout)')
                $('#contracts-container').addClass('animate__animated animate__fadeOutUp d-none')
                $('#invoices-container').addClass('animate__animated animate__fadeInUp ').removeClass('animate__fadeOutDown d-none')
                // $('.owl-carousel').removeClass('d-none')
            } else {
                console.log($(this).attr('data-invoices'), invoices.length, invoices)
                notifyMessage('Atenção!', 'warning', 'O cadastro nº <b>' + customer_id + '</b> não possuí boletos em aberto.<br/> Obrigado pela pontualidade!')
            }
        });

        $('#back-to-contracts').click(function () {
            $('#payment-title').text('Pagamento (Contratos)')
            $('#contracts-container').addClass('animate__animated animate__fadeInDown').removeClass('animate__fadeOutUp d-none')
            $('#invoices-container').addClass('animate__animated animate__fadeOutDown d-none')
        });


        let juros;

        function date_to_utc(date) {
            const date_utc = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate());
            return date_utc;
        }

        function date_to_br(date) {
            const date_utc = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate());
            return date_utc;
        }

        function dias_atraso(date1, date2) {
            const date1utc = date_to_utc(date1);
            const date2utc = date_to_utc(date2);
            day = 1000 * 60 * 60 * 24;

            //Math.abs(value) -> Converte negativo para positivo
            return (date2utc - date1utc) / day
        }

        function calculaMulta(valor) {
            return ((valor * 2) / 100)
        }

        function calculaJuros(vencimento, valor) {

            const date1 = new Date(),
                date2 = new Date(vencimento),
                atraso = dias_atraso(date1, date2)
            let dados = {}
            let multa = 0, jurosCalculados = 0

            const vTit = Number(valor);

            if (atraso < 0) { //apenas calcula juros quando há dias em atraso
                jurosCalculados = Number((vTit * 0.2) / 100 * Math.abs(atraso));
                multa = Number(calculaMulta(valor).toFixed(2))

                // console.log('Dias atraso: '+Math.abs(atraso))
                // console.log('Juros: '+jurosCalculados.toFixed(2)  +' - '+ typeof(jurosCalculados))
                // console.log('Multa: '+multa.toFixed(2) +' - '+ typeof(multa) )
                // console.log('Valor: '+vTit.toFixed(2) +' - '+ typeof(vTit) )
                const total = parseFloat(vTit) + parseFloat(jurosCalculados) + parseFloat(multa);
                // const total = vTit + jurosCalculados + multa;

                dados = {
                    'dias_atraso': Math.abs(atraso),
                    'juros': jurosCalculados.toFixed(2),
                    'multa': multa.toFixed(2),
                    'valor': vTit.toFixed(2),
                    'total': total.toFixed(2),
                }
            } else {
                dados = {
                    'dias_atraso': 0,
                    'juros': 0,
                    'multa': 0,
                    'valor': vTit.toFixed(2),
                    'total': vTit.toFixed(2),
                }
            }
            return dados;

        }

        function loadInvoices(customer_id, invoices) {

            // $("#news-slider").owlCarousel({
            //     items : 3,
            //     itemsDesktop:[1199,3],
            //     itemsDesktopSmall:[980,2],
            //     itemsMobile : [600,1],
            //     navigation:true,
            //     navigationText:["Fatura anterior","Próxima fatura"],
            //     pagination:false,
            //     autoPlay:false
            // });

            let current_invoices = JSON.parse(invoices)
            let calculo = 0, total = 0

            $('.inner-slider').html('')


            console.log(swiper.length)

            // swiper.removeAllSlides();
            // swiper.update();

            $.each(current_invoices, function (key, value) {
                calculo = calculaJuros(value.Vencimento, value.Valor)
                total = Number(calculo.total);
                let vencimento = new Date(value.Vencimento)

                console.log(swiper)
                // $('#news-slider').html('')

                $('.inner-slider').append('' +
                    '<div id="invoice-' + key + '" class="invoice-slide card ' +
                    (calculo.total > value.Valor ? 'text-danger' : '')
                    + '" data-id="' + value.Id + '">' +
                    '<div class="invoice-content">' +
                    '<h3 id="title-' + key + '" class="invoice-title" data-id="' + value.Id + '">' + value.Referencia + '</h3>' +
                    '<ul class="list-group list-group-flush ' + value.Vencimento + '">' +
                    '<li id="billet_id" class="list-group-item d-none">' + value.Id + '</li>' +
                    '<li id="addition" class="list-group-item d-none">' + calculo.juros + '</li>' +
                    '<li id="discount" class="list-group-item d-none">0</li>' +
                    '<li id="month" class="list-group-item d-none">' + value.Referencia + '</li>' +
                    '<li class="list-group-item"><b>Nosso nº: </b><span id="reference">' + value.NossoNumero + '</span></li>' +
                    '<li class="list-group-item"><b>Vencimento: </b><span id="payday">' + vencimento.toLocaleDateString() + '</span></li>' +
                    '<li class="list-group-item"><b>Valor:  </b><span id="value">' +
                    (value.Valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '</span></li>' +
                    '<li class="list-group-item"><b>Valor atual: </b><b><span id="total">' +
                    total.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '</span></b></li>' +
                    '</ul>' +
                    '<ul class="list-group list-group-flush pt-0 pb-0">' +
                    '<li class="list-group-item invoice-actions">' +
                    // '<a href="#" id="copy-barcode-'+key+'" class="btn btn-primary btn-copy" data-id="'+ value.Id +'"'+
                    // 'onclick="copyBarcode(this.id)" data-code="'+value.LinhaDigitavel+'">'+
                    // '<i class="fa fa-barcode" aria-hidden="true"></i> <span class="action-name">copiar</span></a>'+
                    // '<a href="#" id="print-billet-'+key+'"'+
                    '<a href="/invoice/' + value.Id + '" id="print-billet-' + key + '"' +
                    'class="btn btn-info btn-print-billet" data-id="' + value.Id + '">' +
                    '<i class="fa fa-download" aria-hidden="true"></i> <span class="action-name">imprimir</span>' +
                    '</a>' +
                    '<a href="#" id="select-billet-' + key + '"' +
                    'class="add-to-cart btn btn-success"' +
                    'data-reference="' + value.NossoNumero + '" data-value="' + value.Valor + '"' +
                    'data-id="' + value.Id + '" data-discount="' + 0 + '"' +
                    'data-price="' + calculo.total + '"' +
                    'data-addition="' + calculo.juros + '">' +
                    '<i class="fa fa-check" aria-hidden="true"></i> <span class="action-name">pagar</span>' +
                    '</a>' +
                    '<a href="#" id="remove-billet-' + key + '" class="btn btn-danger delete-item d-none"' +
                    'data-reference="' + value.NossoNumero + '" data-id="' + value.Id + '">' +
                    '<i class="fa fa-times" aria-hidden="true"></i> <span class="action-name">remover</span>' +
                    '</a>' +
                    '</li>' +
                    '</ul>' +
                    '</div>' +
                    // '<div class="container-icon-move-hand">'+
                    '<div class="container-icon-move-hand' + (value.length < 4 ? "d-none" : "") + '">' +
                    '<i class="fa fa-long-arrow-alt-left icon-arrow-left"></i>' +
                    '<i class="fa fa-hand-pointer icon-move-hand"></i>' +
                    '</div>' +
                    '</div>'
                );
                // swiper.update()
            })
        };

    </script>
@endsection




