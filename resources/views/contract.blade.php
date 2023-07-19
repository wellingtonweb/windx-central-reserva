@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <main role="main" class="inner fadeIn">
{{--                    <div class="container">--}}
                        <div  class="row contents animate__animated animate__fadeIn">
                            <div class="bg-primary_ col-md-3 order-md-2 py-4 mb-4">
                                <h4 class="d-flex font-weight-bold justify-content-center align-items-center mb-3">
                                    Checkout
{{--                                    <span class="badge badge-secondary badge-pill">3</span>--}}
                                </h4>
                                <ul class="list-group mb-3 " style="border-radius: .5rem">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h4 class="my-0 font-weight-bold">Faturas selecionadas</h4>
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
                                    <div class="row flex flex-column">
                                        <div class="col-12">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="w-100">
                                                    <h4 id="methodTitle" class="text-dark font-weight-bold p-1"></h4>
                                                </div>
                                                <div class="tab-pane fade justify-content-center" id="v-pills-qrcode" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                    <div class="py-2"><h5>Leia o qrcode com seu app</h5></div>
                                                    <img width="80%" src="data:image/png;base64,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" alt="qrcode">
                                                    <a href="javascript:void(0)" type="button" class="text-primary p-2">
                                                        <p class="py-3">PIX COPIA E COLA</p>
                                                    </a>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-card" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                    <form action="">
                                                        <div class="row">
                                                            <div class="pl-3"><h4>Preencha com seus dados</h4></div>

                                                            <div class="col-12 mb-3 text-left">
                                                                <label for="cc-name">Nome (como no cartão)</label>
                                                                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                                                <small class="text-muted">Full name as displayed on card</small>
                                                                <div class="invalid-feedback">
                                                                    Name on card is required
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3 text-left">
                                                                <label for="cc-number">Número do cartão</label>
                                                                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                                                <div class="invalid-feedback">
                                                                    Credit card number is required
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4 mb-3 text-left">
                                                                <label for="cc-expiration">Mês</label>
                                                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                                                <div class="invalid-feedback">
                                                                    Expiration date required
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mb-3  text-left">
                                                                <label for="cc-cvv">Ano</label>
                                                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                                                <div class="invalid-feedback">
                                                                    Security code required
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mb-3 text-left">
                                                                <label for="cc-cvv">Dígitos</label>
                                                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                                                <div class="invalid-feedback">
                                                                    Security code required
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-success" style="width: calc(100% - 3%);" type="submit">Finalizar pagamento</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <button class="btn btn-windx mb-1 checkoutBtn" id="btn-pix" data-toggle="pill" data-target="#v-pills-qrcode" type="button" role="tab" aria-controls="v-pills-qrcode" aria-selected="false">PIX</button>
                                                <button class="btn btn-windx mb-1 checkoutBtn" id="btn-picpay" data-toggle="pill" data-target="#v-pills-qrcode" type="button" role="tab" aria-controls="v-pills-qrcode" aria-selected="false">PICPAY</button>
                                                <button class="btn btn-windx mb-1 checkoutBtn" id="btn-credit" data-toggle="pill" data-target="#v-pills-card" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">CRÉDITO</button>
                                                <button class="btn btn-windx mb-1 checkoutBtn" id="btn-debit" data-toggle="pill" data-target="#v-pills-card" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">DÉBITO</button>
                                            </div>
                                            <button type="button" id="clear-cart" style="width: calc(100% - 3%);"
                                                    class="btn btn-danger clear-cart mt-2 btn-radius-50"
                                                    disabled>Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-secondary_ col-md-9 order-md-1 py-4 ">
                                <h4 class="mb-3">Selecione a fatura a pagar</h4>
                                <div class="table-responsive">
                                    <table id="table-invoices" class="table table-striped">
                                        <thead>
                                        <tr >
                                            <th style="padding: .3rem !important;">Nosso Nº</th>
                                            <th style="padding: .3rem !important;">Referência</th>
                                            <th style="padding: .3rem !important;">Valor</th>
                                            <th style="padding: .3rem !important;">Juros + Multa</th>
                                            <th style="padding: .3rem !important;">Total</th>
                                            <th style="padding: .3rem !important;">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count(session('customer')->billets) > 0)
                                            @foreach(session('customer')->billets as $key => $billet)
                                            <tr>
                                                <td data-label="Nosso Nº">{{ $billet->Id }}</td>
                                                <td data-label="Referência">{{ $billet->Referencia != '' ? $billet->Referencia : 'SEM REFERÊNCIA' }}</td>
                                                <td data-label="Valor">R$ {{ number_format($billet->Valor, 2, ',', '') }}</td>
                                                <td data-label="Juros + Multa">0</td>
                                                <td data-label="Total">14</td>
                                                <td data-label="Ações">
                                                    <a href="{{ route('central.printInvoice', ['id'=> $billet->Id ]) }}" id="print-billet-{{$key}}"
                                                       class="btn btn-info btn-print-billet" data-id="{{ $billet->Id }}">
                                                        <i class="fa fa-print" aria-hidden="true"></i> <span class="action-name">imprimir</span>
                                                    </a>
                                                    <a href="#" id="select-billet-{{$key}}"
                                                       class="add-to-cart btn btn-success"
                                                       data-reference="{{ 0 }}" data-value="{{ $billet->Valor }}"
                                                       data-duedate="{!! 0 !!}"
                                                       data-id="{{ strval($billet->Id) }}" data-discount="{{ 0 }}"
                                                       data-price="{{ number_format(0 + $billet->Valor, 2, '.', '') }}"
                                                       data-addition="{{ number_format(0, 2, '.', '') }}">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                                                                                                        <i class="fas fa-spinner fa-pulse d-none"></i>
                                                        <span class="action-name">pagar</span>
                                                    </a>
                                                    <a href="#" id="remove-billet-{{$key}}" class="btn btn-danger delete-item d-none"
                                                       data-reference="{{ 0 }}" data-id="{{ $billet->Id }}">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                        <span class="action-name">remover</span>
                                                    </a>
                                                    <button type="button" class="btn btn-primary" onclick="checkHoliday()">X</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">
                                                    <h4 style="color: #002046; padding: 1rem">Não existem faturas pendentes!<br><br>Obrigado pela pontualidade ;)</h4>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
{{--                                <div id="news-slider" class="owl-carousel owl-theme d-none">--}}
{{--                                    @foreach(session('customer')->billets as $key => $billet)--}}
{{--                                        <div id="invoice-{{$key}}" class="invoice-slide" data-id="{{ $billet->Id }}">--}}
{{--                                            <div class="invoice-content">--}}
{{--                                                <h3 id="title-{{$key}}" class="invoice-title title-card {{ ($billet->Vencimento < date('Y-m-d\TH:i:s')) ? 'text-red-50' : '' }}" data-id="{{ $billet->Id }}">--}}
{{--                                                    {{ $billet->Referencia != '' ? $billet->Referencia : 'SEM REFERÊNCIA' }}--}}
{{--                                                </h3>--}}
{{--                                                <ul class="list-group list-group-flush {{ ($billet->Vencimento < date('Y-m-d\TH:i:s')) ? 'text-red-50' : '' }}">--}}
{{--                                                    <li id="billet_id" class="list-group-item d-none">{{ $billet->Id }}</li>--}}
{{--                                                    <li id="addition" class="list-group-item d-none">0</li>--}}
{{--                                                    --}}{{--                                                                        <li id="addition" class="list-group-item d-none">{!! number_format(\App\Services\Functions::calcFees($billet->Vencimento, $billet->Valor), 2, ',', '') !!}</li>--}}
{{--                                                    <li id="discount" class="list-group-item d-none">0</li>--}}
{{--                                                    <li id="month" class="list-group-item d-none">{{ $billet->Referencia }}</li>--}}
{{--                                                    <li class="list-group-item d-none">{!! $fees = 0 !!}</li>--}}
{{--                                                    --}}{{--                                                                        <li class="list-group-item d-none">{!! $fees = \App\Services\Functions::calcFees($billet->Vencimento, $billet->Valor) !!}</li>--}}
{{--                                                    <li class="list-group-item"><b>Nosso nº: </b><span id="reference">{{ $number = $billet->NossoNumero }}</span></li>--}}
{{--                                                    <li class="list-group-item"><b>Vencimento: </b><span id="payday">{!! $dueDate = '14/07/2023' !!}</span></li>--}}
{{--                                                    --}}{{--                                                                        <li class="list-group-item"><b>Vencimento: </b><span id="payday">{!! $dueDate = \App\Services\Functions::dateToPt($billet->Vencimento) !!}</span></li>--}}
{{--                                                    <li class="list-group-item"><b>Valor:  </b><span>R$ <span id="value">{{ number_format($billet->Valor, 2, ',', '') }}</span></span></li>--}}
{{--                                                    <li class="list-group-item"><b>Valor atual: </b><b> R$ <span id="total">{{ number_format($fees + $billet->Valor, 2, ',', '') }}</span></b></li>--}}
{{--                                                </ul>--}}
{{--                                                <ul class="list-group list-group-flush pt-0 pb-0">--}}
{{--                                                    <li class="list-group-item invoice-actions_">--}}
{{--                                                        --}}{{--                                                                <a href="#" id="print-billet-{{$key}}"--}}
{{--                                                        --}}{{--                                                                            {{dd(strval(json_encode($billet)))}}--}}
{{--                                                <div class="w-100 bg-primary">--}}
{{--                                                    <a href="{{ route('central.printInvoice', ['id'=> $billet->Id ]) }}" id="print-billet-{{$key}}"--}}
{{--                                                       class="btn btn-info btn-print-billet" data-id="{{ $billet->Id }}">--}}
{{--                                                        <i class="fa fa-print" aria-hidden="true"></i> <span class="action-name">imprimir</span>--}}
{{--                                                    </a>--}}
{{--                                                    <a href="#" id="select-billet-{{$key}}"--}}
{{--                                                       class="add-to-cart btn btn-success"--}}
{{--                                                       data-reference="{{ $number }}" data-value="{{ $billet->Valor }}"--}}
{{--                                                       data-duedate="{!! $dueDate !!}"--}}
{{--                                                       data-id="{{ strval($billet->Id) }}" data-discount="{{ 0 }}"--}}
{{--                                                       data-price="{{ number_format($fees + $billet->Valor, 2, '.', '') }}"--}}
{{--                                                       data-addition="{{ number_format($fees, 2, '.', '') }}">--}}
{{--                                                        <i class="fa fa-check" aria-hidden="true"></i>--}}
{{--                                                        --}}{{--                                                                                <i class="fas fa-spinner fa-pulse d-none"></i>--}}
{{--                                                        <span class="action-name">pagar</span>--}}
{{--                                                    </a>--}}
{{--                                                    <a href="#" id="remove-billet-{{$key}}" class="btn btn-danger delete-item d-none"--}}
{{--                                                       data-reference="{{ $number }}" data-id="{{ $billet->Id }}">--}}
{{--                                                        <i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                                                        <span class="action-name">remover</span>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}

{{--                                            </div>--}}
{{--                                            <div class="container-icon-move-hand {{count(session('customer')->billets) == 1 ? 'd-none': ''}}">--}}
{{--                                                <img src="{{asset('assets/img/slide-icon.jpg')}}" width="25px" height="25px" alt="">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
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
    }

     #table-invoices tr td {
         background-color: whitesmoke;
         color: #5a6268;
     }

    .table thead th {
        padding: .3rem; !important;
    }

    @media (max-width: 575px) {

        table thead {
            display: none;
        }

        table tr {
            display: flex;
            flex-direction: column;
            border: 3px solid white;
            padding: 1px;
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
            .flex-item { width: 100% }
        }
        @media screen and (min-width: 640px) {
            .flex-item {width: calc(50% - 1rem)}
        }
        @media screen and (min-width: 1100px) {
            .flex-item { width: calc(25% - 1rem)}
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

        console.log('Holidays', holidays)

        function checkHoliday(){
            const dataFeriado = '2000-01-01';

            Object.entries(holidays).forEach(([key, value]) => {
                dataFeriado = new Date(key)
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

        // // Selecionar os inputs de rádio
        // var btnPix = document.getElementById("pix");
        // var btnPicpay = document.getElementById("picpay");
        // var btnCredit = document.getElementById("credit");
        // var btnDebit = document.getElementById("debit");
        // var btnClear = document.getElementById("clear-cart");
        // var containerDataForm = document.getElementById("container-dataform");
        // var containerQrcode = document.getElementById("container-qrcode");
        // var containerForm = document.getElementById("container-form");
        // var containerOptions = document.getElementById("container-options");
        //
        // // Adicionar ouvintes de evento 'click'
        // btnPix.addEventListener('click', getMethodPay);
        // btnPicpay.addEventListener('click', getMethodPay);
        // btnCredit.addEventListener('click', getMethodPay);
        // btnDebit.addEventListener('click', getMethodPay);
        // btnClear.addEventListener('click', cancelPay);
        //
        // function cancelPay(){
        //     containerOptions.classList.remove('d-none')
        // }
        //
        // // Callback do evento 'click'
        // function getMethodPay() {
        //     containerOptions.classList.add('d-none')
        //     containerDataForm.classList.remove('d-none')
        //
        //     if (btnPix.checked) {
        //         containerQrcode.innerText = PIX
        //         console.log("Opção PIX selecionada");
        //     } else if (btnPicpay.checked) {
        //         console.log("Opção PICPAY selecionada");
        //     } else if (btnCredit.checked) {
        //         console.log("Opção CRÉDITO selecionada");
        //     } else {
        //         console.log("Opção DÉBITO selecionada");
        //     }
        // }

        $('.checkoutBtn').on('click', function (){
            $('#methodTitle').text($(this).text())

            $('#v-pills-tab').addClass('d-none')
            $('#v-pills-tabContent').removeClass('d-none')
        });

        $('.clear-cart').on('click', function (){
            $('#v-pills-tab').removeClass('d-none')
            $('#v-pills-tabContent').addClass('d-none')
        });

    </script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



