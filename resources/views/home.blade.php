@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="justify-content-center animate__animated animate__zoomIn animate__delay-1s" style="color: lightsalmon">
                            Seja bem vind{{ (session('customer')->gender === 'Masculino') ? 'o' : 'a' }}
                            {{ explode(' ', session('customer')->full_name)[0] }}!
                        </h5>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.contract')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                              <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                              <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Contrato</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Visualizar informações do cadastro, como endereço, plano e dados pessoais.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.payment')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">
                                              <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                              <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                              <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                              <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Pagamento</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Pagar faturas usando PIX, PICPAY, CRÉDITO, DÉBITO ou baixar uma 2ª via.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">
                                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.payments')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Comprovantes</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Acompanhar faturas pagas, visualizar ou baixar uma 2ª via.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.invoices')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">--}}
{{--                                          <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>--}}
{{--                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>--}}
{{--                                        </svg>--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Notas Fiscais</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Acompanhar notas fiscais emitidas conforme as mensalidades pagas.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.support')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-question-square" viewBox="0 0 18 18" width="1.2em">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Suporte</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Acompanhar atendimentos ou abrir um novo para o suporte técnico.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-question-square" viewBox="0 0 18 18" width="1.2em">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                    </svg>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div><!--end col-->
                    @if(session('customer')->status === 'B')
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2 animate__animated animate__fadeIn animate__delay-2s">
                        <a id="{{session('customer')->id}}" onclick="releaseCustomer(this.id)" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="d-flex flex-lg-column flex-row">
                                    <div class="icon text-center text-custom h1 shadow rounded" style="width: 33.33%">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em">
                                              <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Desbloqueio</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Desbloquear cadastro por até 48h, a fim de regularizar os débitos.</p>
                                    </div>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div><!--end col-->
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .windx-red {background-color:#E82528}
        .windx-red-70 {background-color:#ED454C}

        .service-container {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .icon {
            margin-top: 5%;
            font-size: 38px;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .icon-2 {
            height: 70px;
            width: 70px;
            line-height: 80px;
            border-radius: 64% 36% 55% 45% / 76% 72% 28% 24% !important;
            border-color: #f89d36 !important;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .icon-2 i {
            font-size: 30px;
        }

        .service-container .number-icon .number {
            position: absolute;
            top: 0;
            right: 70px;
            left: 0;
            height: 35px;
            width: 35px;
            margin: 0 auto;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .number span {
            line-height: 30px;
        }

        .service-container .content .number {
            font-size: 40px;
            color: #dee2e6;
        }

        .service-container .content .title {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container.hover-bg {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container.hover-bg .smooth-icon {
            position: absolute;
            bottom: -40px;
            right: -20px;
            font-size: 60px;
            color: #f8f9fa;
            -webkit-transition: all 0.8s ease;
            transition: all 0.8s ease;
        }

        .service-container.hover-bg:hover {
            background-color: #f89d36;
        }

        .service-container.hover-bg:hover .content .title {
            color: #ffffff !important;
        }

        .service-container.hover-bg:hover .content .serv-pera {
            color: #fafafb !important;
        }

        .service-container.hover-bg:hover .smooth-icon {
            font-size: 100px;
            opacity: 0.2;
            bottom: -20px;
            right: 10px;
        }

        .service-container:hover {
            background-color: #ffffff;
            -webkit-box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
        }

        .service-container:hover .icon {
            color: #f89d36;
            -webkit-animation: mover 1s infinite alternate;
            animation: mover 1s infinite alternate;
        }

        .service-container:hover .number-icon .icon-2 {
            background-color: #f89d36;
            border-radius: 50% !important;
        }

        .service-container:hover .number-icon .icon-2 i {
            color: #ffffff !important;
        }

        .service-container:hover .number-icon .number {
            color: #ffffff;
            background: #f89d36 !important;
            border-color: #ffffff !important;
        }

        .service-container:hover .content .title {
            color: #f89d36;
        }

        .service-container a:hover,
        .service-container a .title:hover {
            color: #f89d36 !important;
        }

        @-webkit-keyframes mover {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-15px);
                transform: translateY(-15px);
            }
        }

        @keyframes mover {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-15px);
                transform: translateY(-15px);
            }
        }

        .service-wrapper {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-wrapper .icon {
            background-color: #e96a70;
            width: 60px;
            height: 60px;
            line-height: 45px;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;

            display: flex;
            justify-content: center; /* Alinhamento horizontal */
            align-items: center; /* Alinhamento vertical */
        }

        .service-wrapper .content .title {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            font-weight: 500;
        }

        .service-wrapper .big-icon {
            position: absolute;
            right: 0;
            bottom: 0;
            opacity: 0.05;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-wrapper:hover {
            -webkit-box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            background: #ffffff;
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
            border-color: transparent !important;
        }

        .service-wrapper:hover .icon {
            background: #ED454C !important;
            color: #ffffff !important;
        }

        .service-wrapper:hover .big-icon {
            z-index: -1;
            opacity: 0.1;
            font-size: 160px;
        }

        .text-custom {
            color: #002046 !important;
            /*color: #ED454C !important;*/
        }

        h4.title {
            letter-spacing: 1px;
            font-weight: bold !important;
        }

        .content p {
            letter-spacing: 1px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            text-align: justify;
        }

        .uim-svg {
            display: inline-block;
            /*height: 1em;*/
            vertical-align: -0.125em;
            font-size: inherit;
            fill: var(--uim-color, currentColor);
        }

    </style>
@endsection

@section('js')
    <script>

    </script>
@endsection
