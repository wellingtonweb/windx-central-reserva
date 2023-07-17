@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <main role="main" class="inner fadeIn">
{{--                    <div class="container">--}}
                        <div  class="row contents animate__animated animate__fadeIn">
                            <div class="col-md-4 order-md-2 py-4 mb-4">
                                <h4 class="d-flex justify-content-center align-items-center mb-3">
                                    Checkout
{{--                                    <span class="badge badge-secondary badge-pill">3</span>--}}
                                </h4>
                                <ul class="list-group mb-3 " style="border-radius: .5rem">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h4 class="my-0">Faturas selecionadas</h4>
                                        </div>
                                        <span class="total-count badge badge-secondary badge-pill px-3 py-0 d-flex justify-content-center align-items-center "></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Valor:</h6>
{{--                                            <small class="text-muted">Brief description</small>--}}
                                        </div>
                                        <span class="text-muted">R$ 8,00</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Juros + Multa:</h6>
{{--                                            <small class="text-muted">Brief description</small>--}}
                                        </div>
                                        <span class="text-muted">R$ 5,00</span>
                                    </li>
{{--                                    <li class="list-group-item d-flex justify-content-between bg-light">--}}
{{--                                        <div class="text-success">--}}
{{--                                            <h6 class="my-0">Promo code</h6>--}}
{{--                                            <small>EXAMPLECODE</small>--}}
{{--                                        </div>--}}
{{--                                        <span class="text-success">-$5</span>--}}
{{--                                    </li>--}}
                                    <li class="list-group-item d-flex justify-content-between" style="font-size: 1.1rem">
                                        <strong>Valor total: </strong>
                                        <strong>R$<span class="total-cart pl-1"></span></strong>
                                    </li>
                                </ul>

                                <div class="checkout-controls">

                                    <ul class="list-group mb-3 bg-transparent w-100 border-0">
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <button id="btn-pix" type="button" class="btn btn-windx">Pix</button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <button id="btn-picpay" type="button" class="btn btn-secondary">PicPay</button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <button id="btn-credit" type="button" class="btn btn-secondary">Crédito</button>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <button id="btn-debit" type="button" class="btn btn-secondary">Débito</button>
                                        </li>
                                    </ul>


{{--                                    <button type="button" id="btn-pix"--}}
{{--                                            class="btn btn-windx font-weight-bold btn-payment-type_">--}}
{{--                                        Pix--}}
{{--                                    </button>--}}
{{--                                    <button type="button" id="btn-picpay"--}}
{{--                                            class="btn btn-windx font-weight-bold btn-payment-type_">--}}
{{--                                        PicPay--}}
{{--                                    </button>--}}
{{--                                    <button type="button" id="btn-credit"--}}
{{--                                            class="btn btn-windx font-weight-bold btn-payment-type_">--}}
{{--                                        Crédito--}}
{{--                                    </button>--}}
{{--                                    <button type="button" id="btn-debit"--}}
{{--                                            class="btn btn-windx font-weight-bold btn-payment-type_">--}}
{{--                                        Débito--}}
{{--                                    </button>--}}
                                    <button type="button" id="clear-cart"
                                            class="btn btn-danger clear-cart btn-radius-50"
                                            disabled>Cancelar
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8 order-md-1 py-4 ">
                                <h4 class="mb-3">Selecione a fatura a pagar</h4>
                                <div id="news-slider" class="owl-carousel owl-theme">
                                    @foreach(session('customer')->billets as $key => $billet)
                                        <div id="invoice-{{$key}}" class="invoice-slide" data-id="{{ $billet->Id }}">
                                            <div class="invoice-content">
                                                <h3 id="title-{{$key}}" class="invoice-title title-card {{ ($billet->Vencimento < date('Y-m-d\TH:i:s')) ? 'text-red-50' : '' }}" data-id="{{ $billet->Id }}">
                                                    {{ $billet->Referencia != '' ? $billet->Referencia : 'SEM REFERÊNCIA' }}
                                                </h3>
                                                <ul class="list-group list-group-flush {{ ($billet->Vencimento < date('Y-m-d\TH:i:s')) ? 'text-red-50' : '' }}">
                                                    <li id="billet_id" class="list-group-item d-none">{{ $billet->Id }}</li>
                                                    <li id="addition" class="list-group-item d-none">0</li>
                                                    {{--                                                                        <li id="addition" class="list-group-item d-none">{!! number_format(\App\Services\Functions::calcFees($billet->Vencimento, $billet->Valor), 2, ',', '') !!}</li>--}}
                                                    <li id="discount" class="list-group-item d-none">0</li>
                                                    <li id="month" class="list-group-item d-none">{{ $billet->Referencia }}</li>
                                                    <li class="list-group-item d-none">{!! $fees = 0 !!}</li>
                                                    {{--                                                                        <li class="list-group-item d-none">{!! $fees = \App\Services\Functions::calcFees($billet->Vencimento, $billet->Valor) !!}</li>--}}
                                                    <li class="list-group-item"><b>Nosso nº: </b><span id="reference">{{ $number = $billet->NossoNumero }}</span></li>
                                                    <li class="list-group-item"><b>Vencimento: </b><span id="payday">{!! $dueDate = '14/07/2023' !!}</span></li>
                                                    {{--                                                                        <li class="list-group-item"><b>Vencimento: </b><span id="payday">{!! $dueDate = \App\Services\Functions::dateToPt($billet->Vencimento) !!}</span></li>--}}
                                                    <li class="list-group-item"><b>Valor:  </b><span>R$ <span id="value">{{ number_format($billet->Valor, 2, ',', '') }}</span></span></li>
                                                    <li class="list-group-item"><b>Valor atual: </b><b> R$ <span id="total">{{ number_format($fees + $billet->Valor, 2, ',', '') }}</span></b></li>
                                                </ul>
                                                <ul class="list-group list-group-flush pt-0 pb-0">
                                                    <li class="list-group-item invoice-actions">
                                                        {{--                                                                <a href="#" id="print-billet-{{$key}}"--}}
                                                        {{--                                                                            {{dd(strval(json_encode($billet)))}}--}}
                                                        <a href="{{ route('central.printInvoice', ['id'=> $billet->Id ]) }}" id="print-billet-{{$key}}"
                                                           class="btn btn-info btn-print-billet" data-id="{{ $billet->Id }}">
                                                            <i class="fa fa-print" aria-hidden="true"></i> <span class="action-name">imprimir</span>
                                                        </a>
                                                        <a href="#" id="select-billet-{{$key}}"
                                                           class="add-to-cart btn btn-success"
                                                           data-reference="{{ $number }}" data-value="{{ $billet->Valor }}"
                                                           data-duedate="{!! $dueDate !!}"
                                                           data-id="{{ strval($billet->Id) }}" data-discount="{{ 0 }}"
                                                           data-price="{{ number_format($fees + $billet->Valor, 2, '.', '') }}"
                                                           data-addition="{{ number_format($fees, 2, '.', '') }}">
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                            {{--                                                                                <i class="fas fa-spinner fa-pulse d-none"></i>--}}
                                                            <span class="action-name">pagar</span>
                                                        </a>
                                                        <a href="#" id="remove-billet-{{$key}}" class="btn btn-danger delete-item d-none"
                                                           data-reference="{{ $number }}" data-id="{{ $billet->Id }}">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>

                                                            <span class="action-name">remover</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="container-icon-move-hand {{count(session('customer')->billets) == 1 ? 'd-none': ''}}">
                                                <img src="{{asset('assets/img/slide-icon.jpg')}}" width="25px" height="25px" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


{{--                    </div>--}}
                    <section>
                        <div id="container-modal">
                            {{--                            <!-- Modal -->--}}
                            <div id="modal-payment-form" class="modal fade" data-backdrop="static" data-keyboard="false"
                                 tabindex="-1" role="dialog" aria-labelledby="cart" aria-hidden="true"
                                 data-backdrop="static">
                                <div id="payment-form-dialog" class="modal-dialog modal-dialog-centered"
                                     role="document">
                                    <form id="form_checkout" method="POST" action="{{route('central.checkout')}}">
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
                                                        <input id="customer" name="customer" value="{{session('customer')->id}}"
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
                                                        <input id="payment_type" name="payment_type" type="text" hidden>
{{--                                                        <input id="cpf_cnpj_type" name="cpf_cnpj_type" type="text" hidden>--}}
                                                        <input id="token" type="hidden" name="_token"
                                                               value="{{ csrf_token() }}"/>
                                                        <input id="method" name="method" type="text" hidden>
{{--                                                        <input id="terminal_id" name="terminal_id" type="text" value="{{Cookie::get('terminal_id')}}" hidden>--}}
                                                    </div>
{{--                                                    <div class="form-row mt-2">--}}
{{--                                                        <div--}}
{{--                                                            class="alert alert-danger text-display-error text-center justify-content-center w-100 font-weight-bold d-none"--}}
{{--                                                            role="alert">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-12 mb-3 text-left">--}}
{{--                                                            <label for="cc-nome">Nome no cartão</label>--}}
{{--                                                            <input type="text" class="form-control text-uppercase"--}}
{{--                                                                   value="WELLINGTON FERREIRA" id="cc-nome"--}}
{{--                                                                   name="holder_name"--}}
{{--                                                                   placeholder="Nome como está no cartão">--}}
{{--                                                            <small--}}
{{--                                                                class="text-danger error-text holder_name_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-row">--}}
{{--                                                        <div class="col-md-6 mb-3 text-left">--}}
{{--                                                            <label for="cc-numero">Nº do cartão</label>--}}
{{--                                                            <input type="text" class="form-control"--}}
{{--                                                                   value="5226069490151810" id="cc-numero"--}}
{{--                                                                   name="card_number" placeholder="0000 0000 0000 0000">--}}
{{--                                                            <small--}}
{{--                                                                class="text-danger error-text card_number_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 mb-3 text-left">--}}
{{--                                                            <label for="cc-bandeira">Bandeira do cartão</label>--}}
{{--                                                            <select id="cc-bandeira" name="bandeira"--}}
{{--                                                                    class="form-control">--}}
{{--                                                                <option disabled>Selecionar</option>--}}
{{--                                                                <option value="American Express">American Express--}}
{{--                                                                </option>--}}
{{--                                                                <option value="Aura">Aura</option>--}}
{{--                                                                <option value="Banescard">Banescard</option>--}}
{{--                                                                <option value="Cabal">Cabal</option>--}}
{{--                                                                <option value="Dinners">Dinners</option>--}}
{{--                                                                <option value="Elo">Elo</option>--}}
{{--                                                                <option value="Hipercard">Hipercard</option>--}}
{{--                                                                <option selected value="Master">Master</option>--}}
{{--                                                                <option value="Visa">Visa</option>--}}
{{--                                                            </select>--}}
{{--                                                            <small--}}
{{--                                                                class="text-danger error-text bandeira_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-row">--}}
{{--                                                        <div class="col-4 mb-3 text-left">--}}
{{--                                                            <label for="cc-expiracao">Mês</label>--}}
{{--                                                            <input type="text" class="form-control" value="07"--}}
{{--                                                                   id="expiration_month" name="expiration_month"--}}
{{--                                                                   placeholder="Ex: 12">--}}
{{--                                                            <small--}}
{{--                                                                class="text-danger error-text expiration_month_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-4 mb-3 text-left">--}}
{{--                                                            <label for="cc-expiracao">Ano</label>--}}
{{--                                                            <input type="text" class="form-control" value="2023"--}}
{{--                                                                   id="expiration_year" name="expiration_year"--}}
{{--                                                                   placeholder="Ex: 2028">--}}
{{--                                                            <small--}}
{{--                                                                class="text-danger error-text expiration_year_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-4 mb-3 text-left">--}}
{{--                                                            <label for="cc-cvv">Cód. seg</label>--}}
{{--                                                            <input type="text" class="form-control" value="271"--}}
{{--                                                                   id="cc-cvv" name="cvv" placeholder="Ex: 123">--}}
{{--                                                            <small class="text-danger error-text cvv_error"></small>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
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

@section('css')
    <style >


    .checkout-controls .btn {
        margin: 5px !important
    }

     .checkout-controls .list-group-item {
         padding: 0;
         border: 0;
     }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
@endsection

@section('js')
    <script>
        var idCustomer = {{session('customer')->id}};
        var customerActive = @json(session('customer'));
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



