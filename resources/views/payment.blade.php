@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid container-payment">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
{{--                        <div id="infoCustomerActive"  class="d-flex col-12 order-0 py-2 px-lg-0 px-md-1 mb-2 text-windx">--}}
{{--                            <a href="javascript:void(0)" class="d-lg-none pr-1" onclick="toggleLineClamp()">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"--}}
{{--                                     class="bi bi-info-square-fill" viewBox="0 0 16 16">--}}
{{--                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93--}}
{{--                                     4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105--}}
{{--                                     1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275--}}
{{--                                      0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                            <p id="infoText" class="text-uppercase space-1 clamped px-lg-3 text-justify">--}}
{{--                                Contrato Nº: {{session('customer')->id}} |--}}
{{--                                {{session('customer')->full_name}} |--}}
{{--                                {{session('customer')->street}}, {{session('customer')->district}},--}}
{{--                                {{session('customer')->city}}--}}
{{--                            </p>--}}
{{--                        </div>--}}
                        <div id="infoCustomerActive" class="d-flex d-none col-12 order-0 px-lg-0 px-md-1 mb-2">
                            <a href="{{route('central.home')}}" class="btn btn-secondary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path style="fill:white !important;" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg>
                                Voltar
                            </a>
                            <button id="refesh-slider" class="btn btn-primary">Refresh</button>

                        </div>
{{--                        checkout--}}
{{--                        {{count(session('customer')->billets)}}--}}
                        <div id="colCheckout" class="d-none {{count(session('customer')->billets) == 0 ? 'd-none': ''}} col-lg-4 order-lg-2
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
{{--                                        <button id="authenticate" type="button" style="width: calc(100% - 3%);"--}}
{{--                                                class="btn btn-warning mt-2 btn-radius-50"--}}
{{--                                                >Autenticar--}}
{{--                                        </button>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        faturas--}}
                        <div id="colInvoices" class="d-none {{count(session('customer')->billets) == 0 ? 'col-lg-12': 'col-lg-8'}}
                            order-lg-1 col-md-6 order-md-1 col-sm-6 order-sm-1
{{--                            py-2 pr-lg-3 px-0--}}
">
                            <h4 class="mb-3">Selecione a fatura a pagar</h4>
{{--                            {{ dd(\App\Helpers\WorkingDays::checkDate('2022-01-01T00:00:00'), session('customer')->billets) }}--}}
                            <div class="content-box">
                                <div class="my-slider">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">text</p>
                                            <p class="card-text">text</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-outline-primary btn-sm btn-block">COPIAR</a>
                                                <a href="#" class="btn btn-outline-info btn-sm btn-block">BAIXAR</a>
                                            </div>
                                            <a href="#" class="btn btn-success btn-sm btn-block">PAGAR</a>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title 2</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title 3</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title 4</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title 5</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Card title 6</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated 3 mins ago</small>
                                        </div>
                                    </div>
                                </div>
                                <table class="d-none table table-bordered table-striped display list-billets text-uppercase">
                                </table>
                            </div>
                        </div>

                        <div id="infoCheckout" class="d-none col-12 pl-0 pr-0 mb-2">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div id="checkout-box" class="d-flex flex-wrap">
{{--                                <div id="checkout-box" class="d-lg-flex d-md-block d-sm-block align-items-stretch">--}}
                                    <div class="pt-1 pb-1 pl-2 pr-2 flex-fill align-items-stretch text-left">
                                        <b>Selecionadas: </b><span>2</span>
                                    </div>
                                    <div class="pt-1 pb-1 pl-2 pr-2 flex-fill align-items-stretch text-left">
                                        <b>Valor: </b><span>R$ 200,00</span>
                                    </div>
                                    <div class="pt-1 pb-1 pl-2 pr-2 flex-fill align-items-stretch text-left">
                                        <b>Juros + Multa: </b><span>R$ 5,20</span>
                                    </div>
                                    <div class="pt-1 pb-1 pl-2 pr-2 flex-fill align-items-stretch text-left">
                                        <b>Total à pagar: R$ 205,20</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pl-0 pr-0 mb-2">
                            <div class="content-box">
                                <div class="btn-group tns-controls d-none" role="group" aria-label="Basic example">
                                    <button id="tyne-prev-btn" type="button" data-controls="prev"
                                            class="btn btn-primary btn-sm mr-1" aria-controls="tns1">Fatura anterior</button>
                                    <button id="tyne-next-btn" type="button" data-controls="next"
                                            class="btn btn-primary btn-sm" aria-controls="tns1">Próxima fatura</button>
                                </div>
                                <div class="billets-slider">
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">text</p>--}}
{{--                                            <p class="card-text">text</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                <a href="#" class="btn btn-outline-primary btn-sm btn-block">COPIAR</a>--}}
{{--                                                <a href="#" class="btn btn-outline-info btn-sm btn-block">BAIXAR</a>--}}
{{--                                            </div>--}}
{{--                                            <a href="#" class="btn btn-success btn-sm btn-block">PAGAR</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title 2</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title 3</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title 4</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title 5</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h5 class="card-title">Card title 6</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                            <small class="text-muted">Last updated 3 mins ago</small>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <div id="buttonsCheckout" class="d-none col-12 pl-0 pr-0">
                            <div class="content-box p-lg-3 p-md-2 p-sm-2">
                                <div id="v-pills-tab" class="checkout-controls d-flex flex-wrap ">
{{--                                <div class="checkout-controls d-lg-flex d-md-flex d-sm-block align-items-stretch">--}}
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
                                    <button type="button" id="clear-cart" class="clear-cart btn btn-outline-danger btn-sm btn-block">CANCELAR</button>
                                </div>
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

        }

        .my-slider .card {
            height: 20rem !important;
            max-height: 22.55rem !important;
            border-radius: .5rem;
            /*responsivo*/
            /*height: 17.5rem;*/
            /*max-height: 17.5rem;*/
        }

        .my-slider .card .card-header
        {
            background-color: rgba(0, 32, 70, 0.5);
            padding: 0.25rem 1.25rem;
            /*display: flex;*/
            /*justify-content: center;*/


        }

        .my-slider .card .card-body
        {
            background-color: #e6f6f6;
            /*responsivo*/
            /*font-size: 80%;*/
            /*font-weight: 400;*/
        }

        .my-slider .card .card-body p
        {
            line-height: 20px;
            margin-bottom: .1rem;
        }

        .my-slider .card-header:first-child {
            border-radius: calc(0.45rem - 1px) calc(0.45rem - 1px) 0 0;
        }

        .my-slider .card .card-header h5.card-title
        {
            color: white;
            font-weight: bold;
            position: relative;
            padding: .2rem;
            margin-bottom: 0;
        }

        .my-slider .card .card-footer
        {
            background-color: #e6f6f6;
            border-top: none;
        }

        .my-slider .card .card-footer .btn
        {
            padding: 5px 20px;
            margin: 3px;
            font-size: 11px;
        }

        .my-slider .card-footer:first-child {
            border-radius: calc(0.45rem - 1px) calc(0.45rem - 1px) 0 0;
        }

        .my-slider .card .card-text {
            text-align: left;
        }


        #DataTables_Table_0_paginate a{
            color: #002046 !important;
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

        /*body {*/
        /*    scrollbar-width: thin;          !* "auto" or "thin" *!*/
        /*    scrollbar-color: rgba(0, 32, 70, 0.5) rgba(255, 255, 255, 0);   !* scroll thumb and track *!*/
        /*}*/

        /*html ::-webkit-scrollbar {*/
        /*    width: 10px;*/
        /*}*/
        /*html ::-webkit-scrollbar-thumb {*/
        /*    border-radius: 50px;*/
        /*    background: rgba(0, 32, 70, 0.5);*/
        /*    !*background: #6e6ea9;*!*/

        /*}*/
        /*html ::-webkit-scrollbar-track {*/
        /*    background: rgba(255, 255, 255, 0);*/
        /*    !*background: #ededed;*!*/
        /*}*/

        /*#colInvoices {*/
        /*    height: 70vh;*/
        /*    overflow-y: scroll;*/
        /*}*/

        /*#colInvoices::-webkit-scrollbar {*/
        /*    display: none;*/
        /*}*/

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
            background-color: #fff !important;
            padding: 1rem;
        }


    </style>
{{--    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <!-- NOTE: prior to v2.2.1 tiny-slider.js need to be in <body> -->
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

        var slider = '';

        async function getBillets(){
            let url = "{{ route('central.get.billets') }}";
            const response = await fetch(url);
            const billets = await response.json();
            let sliderBillets = document.querySelector('.billets-slider');

            if(billets.data.length === 0){
                sliderBillets.innerHTML = '<h4 class="p-3">Não existem faturas à pagar!</h4>';
            }else{
                $('.tns-controls').removeClass('d-none');
                $('#infoCheckout').removeClass('d-none');
                $('#buttonsCheckout').removeClass('d-none');
                window.addEventListener('load', inicializeSlider());
                function inicializeSlider(){
                    let slides = '';
                    for(let billet in billets.data){
                        slides += `
                                <div id="billet_${billets.data[billet].Id}" class="card">
                                    <div class="card-header">
                                        <h5 class="card-title font-weight-bold">${billets.data[billet].Referencia}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Vencimento: ${billets.data[billet].dtEmissao}</p>
                                        <p class="card-text">Valor: ${billets.data[billet].valor}</p>
                                        <p class="card-text">Juros + Multa: ${billets.data[billet].fees}</p>
                                        <p class="card-text font-weight-bold">Total: ${billets.data[billet].total}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex">
                                            ${billets.data[billet].copy}
                                            ${billets.data[billet].download}
                                        </div>
                                        ${billets.data[billet].add}
                                        ${billets.data[billet].remove}
                                    </div>
                                </div>
                    `
                    }
                    sliderBillets.innerHTML = slides;
                }

                slider = tns({
                    container: '.billets-slider',
                    items: 1,
                    responsive: {
                        640: {
                            edgePadding: 20,
                            gutter: 20,
                            items: 2
                        },
                        700: {
                            gutter: 30
                        },
                        900: {
                            items: 3
                        }
                    },
                    animateIn: "tns-fadeIn",
                    mouseDrag: true,
                    nav: false,
                    prevButton: false,
                    nextButton: false,
                    controls: false
                });
            }
        }

        getBillets()

        $('#refesh-slider').on('click', function (){
            slider.destroy();
            slider = slider.rebuild();
        })

        $('#tyne-next-btn').on('click', function (){
            slider.goTo('next');
        })

        $('#tyne-prev-btn').on('click', function (){
            slider.goTo('prev');
        })

        $('.add-to-cart').on('click', function (){
            console.log('Inst: ',$(this).attr('data-billet'));
        })


    </script>
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>--}}
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



