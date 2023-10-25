@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid container-payment">
                <main role="main" class="inner fadeIn">
                    <div class="row contents animate__animated animate__fadeIn">
                        <div id="infoCustomerActive" class="d-flex d-none col-12 order-0 px-lg-0 px-md-1 mb-2">
                            <a href="{{route('central.home')}}" class="btn btn-secondary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path style="fill:white !important;" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg>Voltar
                            </a>
                        </div>
                        <div id="colCheckout" class="d-none {{count(session('customer')->billets) == 0 ? 'd-none': ''}} col-lg-4 order-lg-2
                        col-md-6 order-md-2 col-sm-6 order-sm-2 pl-lg-0 pl-md-0 mb-4">
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
                                        <div class="row">
                                            <div class="col-12 bg-success">btns checkout</div>
                                            <div class="col-12 bg-primary">btns cancelar</div>
                                        </div>

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
                        <div class="col-12 pl-0 pr-0 mb-2">
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

                                <div #swiperRef="" class="swiper mySwiper">
                                    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                    <div class="swiper-wrapper">
                                    </div>
                                </div>
{{--                                <p class="append-buttons">--}}
{{--                                    <button class="prepend-2-slides">Prepend 2 Slides</button>--}}
{{--                                    <button class="prepend-slide">Prepend Slide</button>--}}
{{--                                    <button class="append-slide">Append Slide</button>--}}
{{--                                    <button class="append-2-slides">Append 2 Slides</button>--}}
{{--                                </p>--}}
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
                                                    data-toggle="pill" data-target="#v-pills-card" type="button"
                                                    role="tab" aria-controls="v-pills-messages" aria-selected="false">
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
                    <div class="row d-none">
                        <div class="col-3 bg-light">
                            <div id="billet_1246934" class="card tns-item tns-slide-active card-overdue">
                                <div class="card-header d-flex card-header-overdue">
                                    <div class="title font-weight-bold">TESTE NOVA CENTRAL ASSINANTE</div>
                                    <span class="font-weight-bold"> (0000144-0)</span>
                                </div>
                                <div class="card-body">
                                    <div class="row letter-1">
                                        <div class="col-12 py-1 d-flex justify-content-between" >
                                            <small style="border-bottom: 2px solid #CCCCCC; width: 100%"
                                                   class="card-text font-weight-bold text-muted text-left">
                                                RESUMO DA FATURA
                                            </small>
                                        </div>
                                        <div class="col-12 py-1 d-flex justify-content-between font-weight-bold">
                                            <span class="card-text ">
                                                Total à pagar: </span>
                                            <span class="card-text">R$ 7,88</span>
                                        </div>
                                        <div class="col-12 py-1 d-flex justify-content-between">
                                            <small class="card-text">Valor: </small>
                                            <small class="card-text">R$ 5,90</small>
                                        </div>
                                        <div class="col-12 py-1 d-flex justify-content-between">
                                            <small class="card-text">Juros + Multa:</small>
                                            <small class="card-text">R$ 1,98</small>
                                        </div>
                                        <div class="col-12 py-1 d-flex justify-content-between">
                                            <small class="card-text">Vencimento: </small>
                                            <small class="card-text">15/05/2023</small>
                                        </div>
                                    </div>
                                    <div class="d-flex py-3" style="vertical-align: middle">
                                        <small class="card-text px-2">
                                            75691.30011   01131.961201   08887.440017   1   93510000000590
                                        </small>
                                        <a href="#" id="copy-barcode-1246934" class="billet-link text-primary click pt-0"
                                           data-id="1246934" onclick="copyBarcode3(this)"
                                           data-code="75691.30011   01131.961201   08887.440017   1   93510000000590">
                                            <i class="fa fa-copy"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a target="_blank" href="https://windx.vigoweb.com.br/clientes/boleto?k=75691935100000005901300101131961200888744001&amp;q=1246934" class="billet-link text-primary px-4">
                                            Baixar 2ª via<i class="fas fa-download pl-2"></i>
                                        </a>
                                    </div>
                                    <div class="pt-2">
                                        <small class="text-muted">* Pagamento do boleto sujeito a compensação do banco (até 72h úteis)</small>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#" id="select-billet-1246934" class="add-to-cart btn btn-success btn-sm btn-block" onclick="addToCartBtn(&quot;{\&quot;id\&quot;:1246934,\&quot;reference\&quot;:\&quot;0088874-4\&quot;,\&quot;value\&quot;:5.9,\&quot;duedate\&quot;:\&quot;15\\\/05\\\/2023\&quot;,\&quot;price\&quot;:\&quot;7.88\&quot;,\&quot;discount\&quot;:0,\&quot;addition\&quot;:\&quot;1.98\&quot;,\&quot;installment\&quot;:1}&quot;)">PAGAR
                                    </a><a href="#" id="remove-billet-1246934" class="btn btn-danger btn-sm btn-block delete-item d-none" onclick="deleteItemCart(1246934)">REMOVER</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">Teste</div>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .swiper {
            width: 100%;
            height: 100%;
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script defer type="text/javascript" src="{{ asset('assets/js/payment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>

{{--    <script defer type="text/javascript" src="{{ asset('assets/js/customer.release.min.js') }}"></script>--}}
{{--    <script defer type="text/javascript" src="{{ asset('assets/js/contract.custom.min.js') }}"></script>--}}
    {{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
@endsection



