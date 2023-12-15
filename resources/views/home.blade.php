@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="justify-content-center animate__animated animate__zoomIn animate__delay-1s"
                            style="color: lightsalmon">
                            Seja bem vind{{ (session('customer.gender') === 'Masculino') ? 'o' : 'a' }}
                            {{ explode(' ', session('customer.full_name'))[0] }}!
                        </h5>
                    </div>
                </div>

                <div class="container-actions-buttons d-flex justify-content-start mb-3 flex-wrap">
                    <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.contract')}}" class="text-custom">
                            <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                <div class="container-icon w-100  d-flex justify-content-center">
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                              <path
                                                  d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                              <path
                                                  d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="content mt-lg-4 mt-0 ">
                                    <h4 class="title">Contrato</h4>
                                    <p class="text-muted mt-3 mb-0 pl-2">Visualizar informações do cadastro, como
                                        endereço, plano e dados pessoais.</p>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                          <path
                                              d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                          <path
                                              d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.payment')}}" class="text-custom">
                            <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                <div class="container-icon w-100  d-flex justify-content-center">
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-cash-coin" viewBox="0 0 18 18" width="1.2em">
                                          <path fill-rule="evenodd"
                                                d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                          <path
                                              d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                          <path
                                              d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                          <path
                                              d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                    </span>
                                    </div>
                                </div>
                                <div class="content mt-lg-4 mt-0">
                                    <h4 class="title">Pagamento</h4>
                                    <p class="text-muted mt-3 mb-0 pl-2">Pagar faturas usando PIX, PICPAY, CRÉDITO,
                                        DÉBITO ou baixar uma 2ª via.</p>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-cash-coin" viewBox="0 0 18 18" width="1.2em">
                                          <path fill-rule="evenodd"
                                                d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                          <path
                                              d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                          <path
                                              d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                          <path
                                              d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.payments')}}" class="text-custom">
                            <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                <div class="container-icon w-100  d-flex justify-content-center">
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18"
                                                 width="1.2em">
                                              <path
                                                  d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                              <path
                                                  d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="content mt-lg-4 mt-0">
                                    <h4 class="title">Comprovantes</h4>
                                    <p class="text-muted mt-3 mb-0 pl-2">Acompanhar faturas pagas, visualizar ou baixar
                                        uma 2ª via.</p>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                          <path
                                              d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                          <path
                                              d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div>
                    <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.invoices')}}" class="text-custom">
                            <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                <div class="container-icon w-100  d-flex justify-content-center">
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 class="bi bi-file-earmark-medical" viewBox="0 0 18 18" width="1.2em">
                                              <path
                                                  d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                              <path
                                                  d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="content mt-lg-4 mt-0">
                                    <h4 class="title">Notas Fiscais</h4>
                                    <p class="text-muted mt-3 mb-0 pl-2">Acompanhar notas fiscais emitidas conforme as
                                        mensalidades pagas.</p>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-file-earmark-medical" viewBox="0 0 18 18" width="1.2em">
                                          <path
                                              d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                          <path
                                              d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div>
                    <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                        <a href="{{route('central.support')}}" class="text-custom">
                            <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                <div class="container-icon w-100  d-flex justify-content-center">
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                 class="bi bi-question-square" viewBox="0 0 18 18" width="1.2em">
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                <path
                                                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="content mt-lg-4 mt-0">
                                    <h4 class="title">Suporte</h4>
                                    <p class="text-muted mt-3 mb-0 pl-2">Acompanhar atendimentos ou abrir um novo para o
                                        suporte técnico.</p>
                                </div>
                                <div class="big-icon h1 text-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                         class="bi bi-question-square" viewBox="0 0 18 18" width="1.2em">
                                        <path
                                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path
                                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                    </svg>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div>
                    @if(session('customer.status') === 'B')
                        <div class="action-button animate__animated animate__fadeIn animate__delay-2s">
                            <a id="{{session('customer.id')}}" onclick="releaseCustomer(this.id)" class="text-custom">
                                <div class="w-100 h-100 card service-wrapper rounded border-0 shadow p-4">
                                    <div class="container-icon w-100  d-flex justify-content-center">
                                        <div class="icon text-center text-custom h1 shadow rounded">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock"
                                             viewBox="0 0 18 18" width="1.2em">
                                          <path
                                              d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                        </svg>
                                    </span>
                                        </div>
                                    </div>
                                    <div class="content mt-lg-4 mt-0">
                                        <h4 class="title">Desbloqueio</h4>
                                        <p class="text-muted mt-3 mb-0 pl-2">Desbloquear cadastro por até 48h, a fim de
                                            regularizar os débitos.</p>
                                    </div>
                                    <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock"
                                             viewBox="0 0 18 18" width="1.2em">
                                          <path
                                              d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                        </svg>
                                    </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Launch demo modal
                    </button>
                </div>
            </div>
        </section>
    </main>



    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="border: 0">
                    <h5 class="modal-title" id="staticBackdropLabel">Windx - Termos de Uso e Privacidade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    What follows is just some placeholder text for this modal dialog. You just gotta ignite the light
                    and let it shine! Come just as you are to me. Just own the night like the 4th of July. Infect me
                    with your love and fill me with your poison. Come just as you are to me. End of the rainbow looking
                    treasure.

                    I can't sleep let's run away and don't ever look back, don't ever look back. I can't sleep let's run
                    away and don't ever look back, don't ever look back. Yes, we make angels cry, raining down on earth
                    from up above. I'm walking on air (tonight). Let you put your hands on me in my skin-tight jeans.
                    Stinging like a bee I earned my stripes. I went from zero, to my own hero. Even brighter than the
                    moon, moon, moon. Make 'em go, 'Aah, aah, aah' as you shoot across the sky-y-y! Why don't you let me
                    stop by?

                    Boom, boom, boom. Never made me blink one time. Yeah, you're lucky if you're on her plane. Talk
                    about our future like we had a clue. Oh my God no exaggeration. You're original, cannot be replaced.
                    The girl's a freak, she drive a jeep in Laguna Beach. It's no big deal, it's no big deal, it's no
                    big deal. In another life I would make you stay. I'm ma get your heart racing in my skin-tight
                    jeans. I wanna walk on your wave length and be there when you vibrate Never made me blink one time.

                    We'd keep all our promises be us against the world. In another life I would be your girl. We can
                    dance, until we die, you and I, will be young forever. And on my 18th Birthday we got matching
                    tattoos. So open up your heart and just let it begin. 'Cause she's the muse and the artist. She eats
                    your heart out. Like Jeffrey Dahmer (woo). Pop your confetti. (This is how we do) I know one spark
                    will shock the world, yeah yeah. If you only knew what the future holds.

                    Sipping on Rosé, Silver Lake sun, coming up all lazy. It’s in the palm of your hand now baby. So we
                    hit the boulevard. So make a wish, I'll make it like your birthday everyday. Do you ever feel
                    already buried deep six feet under? It's time to bring out the big balloons. You could've been the
                    greatest. Passport stamps, she's cosmopolitan. Your kiss is cosmic, every move is magic.

                    We're living the life. We're doing it right. Open up your heart. I was tryna hit it and quit it. Her
                    love is like a drug. Always leaves a trail of stardust. The girl's a freak, she drive a jeep in
                    Laguna Beach. Fine, fresh, fierce, we got it on lock. All my girls vintage Chanel baby.

                    Before you met me I was alright but things were kinda heavy. Peach-pink lips, yeah, everybody
                    stares. This is no big deal. Calling out my name. I could have rewrite your addiction. She's got
                    that, je ne sais quoi, you know it. Heavy is the head that wears the crown. 'Cause, baby, you're a
                    firework. Like thunder gonna shake the ground.

                    Just own the night like the 4th of July! I’m gon’ put her in a coma. What you're waiting for, it's
                    time for you to show it off. Can't replace you with a million rings. You open my eyes and I'm ready
                    to go, lead me into the light. And here you are. I’m gon’ put her in a coma. Come on, let your
                    colours burst. So cover your eyes, I have a surprise. As I march alone to a different beat. Glitter
                    all over the room pink flamingos in theWhat follows is just some placeholder text for this modal
                    dialog. You just gotta ignite the light and let it shine! Come just as you are to me. Just own the
                    night like the 4th of July. Infect me with your love and fill me with your poison. Come just as you
                    are to me. End of the rainbow looking treasure.

                    I can't sleep let's run away and don't ever look back, don't ever look back. I can't sleep let's run
                    away and don't ever look back, don't ever look back. Yes, we make angels cry, raining down on earth
                    from up above. I'm walking on air (tonight). Let you put your hands on me in my skin-tight jeans.
                    Stinging like a bee I earned my stripes. I went from zero, to my own hero. Even brighter than the
                    moon, moon, moon. Make 'em go, 'Aah, aah, aah' as you shoot across the sky-y-y! Why don't you let me
                    stop by?

                    Boom, boom, boom. Never made me blink one time. Yeah, you're lucky if you're on her plane. Talk
                    about our future like we had a clue. Oh my God no exaggeration. You're original, cannot be replaced.
                    The girl's a freak, she drive a jeep in Laguna Beach. It's no big deal, it's no big deal, it's no
                    big deal. In another life I would make you stay. I'm ma get your heart racing in my skin-tight
                    jeans. I wanna walk on your wave length and be there when you vibrate Never made me blink one time.

                    We'd keep all our promises be us against the world. In another life I would be your girl. We can
                    dance, until we die, you and I, will be young forever. And on my 18th Birthday we got matching
                    tattoos. So open up your heart and just let it begin. 'Cause she's the muse and the artist. She eats
                    your heart out. Like Jeffrey Dahmer (woo). Pop your confetti. (This is how we do) I know one spark
                    will shock the world, yeah yeah. If you only knew what the future holds.

                    Sipping on Rosé, Silver Lake sun, coming up all lazy. It’s in the palm of your hand now baby. So we
                    hit the boulevard. So make a wish, I'll make it like your birthday everyday. Do you ever feel
                    already buried deep six feet under? It's time to bring out the big balloons. You could've been the
                    greatest. Passport stamps, she's cosmopolitan. Your kiss is cosmic, every move is magic.

                    We're living the life. We're doing it right. Open up your heart. I was tryna hit it and quit it. Her
                    love is like a drug. Always leaves a trail of stardust. The girl's a freak, she drive a jeep in
                    Laguna Beach. Fine, fresh, fierce, we got it on lock. All my girls vintage Chanel baby.

                    Before you met me I was alright but things were kinda heavy. Peach-pink lips, yeah, everybody
                    stares. This is no big deal. Calling out my name. I could have rewrite your addiction. She's got
                    that, je ne sais quoi, you know it. Heavy is the head that wears the crown. 'Cause, baby, you're a
                    firework. Like thunder gonna shake the ground.

                    Just own the night like the 4th of July! I’m gon’ put her in a coma. What you're waiting for, it's
                    time for you to show it off. Can't replace you with a million rings. You open my eyes and I'm ready
                    to go, lead me into the light. And here you are. I’m gon’ put her in a coma. Come on, let your
                    colours burst. So cover your eyes, I have a surprise. As I march alone to a different beat. Glitter
                    all over the room pink flamingos in theWhat follows is just some placeholder text for this modal
                    dialog. You just gotta ignite the light and let it shine! Come just as you are to me. Just own the
                    night like the 4th of July. Infect me with your love and fill me with your poison. Come just as you
                    are to me. End of the rainbow looking treasure.

                    I can't sleep let's run away and don't ever look back, don't ever look back. I can't sleep let's run
                    away and don't ever look back, don't ever look back. Yes, we make angels cry, raining down on earth
                    from up above. I'm walking on air (tonight). Let you put your hands on me in my skin-tight jeans.
                    Stinging like a bee I earned my stripes. I went from zero, to my own hero. Even brighter than the
                    moon, moon, moon. Make 'em go, 'Aah, aah, aah' as you shoot across the sky-y-y! Why don't you let me
                    stop by?

                    Boom, boom, boom. Never made me blink one time. Yeah, you're lucky if you're on her plane. Talk
                    about our future like we had a clue. Oh my God no exaggeration. You're original, cannot be replaced.
                    The girl's a freak, she drive a jeep in Laguna Beach. It's no big deal, it's no big deal, it's no
                    big deal. In another life I would make you stay. I'm ma get your heart racing in my skin-tight
                    jeans. I wanna walk on your wave length and be there when you vibrate Never made me blink one time.

                    We'd keep all our promises be us against the world. In another life I would be your girl. We can
                    dance, until we die, you and I, will be young forever. And on my 18th Birthday we got matching
                    tattoos. So open up your heart and just let it begin. 'Cause she's the muse and the artist. She eats
                    your heart out. Like Jeffrey Dahmer (woo). Pop your confetti. (This is how we do) I know one spark
                    will shock the world, yeah yeah. If you only knew what the future holds.

                    Sipping on Rosé, Silver Lake sun, coming up all lazy. It’s in the palm of your hand now baby. So we
                    hit the boulevard. So make a wish, I'll make it like your birthday everyday. Do you ever feel
                    already buried deep six feet under? It's time to bring out the big balloons. You could've been the
                    greatest. Passport stamps, she's cosmopolitan. Your kiss is cosmic, every move is magic.

                    We're living the life. We're doing it right. Open up your heart. I was tryna hit it and quit it. Her
                    love is like a drug. Always leaves a trail of stardust. The girl's a freak, she drive a jeep in
                    Laguna Beach. Fine, fresh, fierce, we got it on lock. All my girls vintage Chanel baby.

                    Before you met me I was alright but things were kinda heavy. Peach-pink lips, yeah, everybody
                    stares. This is no big deal. Calling out my name. I could have rewrite your addiction. She's got
                    that, je ne sais quoi, you know it. Heavy is the head that wears the crown. 'Cause, baby, you're a
                    firework. Like thunder gonna shake the ground.

                    Just own the night like the 4th of July! I’m gon’ put her in a coma. What you're waiting for, it's
                    time for you to show it off. Can't replace you with a million rings. You open my eyes and I'm ready
                    to go, lead me into the light. And here you are. I’m gon’ put her in a coma. Come on, let your
                    colours burst. So cover your eyes, I have a surprise. As I march alone to a different beat. Glitter
                    all over the room pink flamingos in the
                </div>
                <div class="modal-footer" style="border: 0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="acceptTerms()">Aceitar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        @media (max-width: 575.98px) {
            .action-button {
                /*min-width: calc(25% - .75rem);*/
                max-width: calc(50% - 20px);
            }

            .action-button .icon {
                width: 60px;
            }

            .action-button .content {
                position: relative;
                width: 140px !important;
                margin-left: -17px;
            }

            .action-button .content h4 {
                padding-top: .5rem;
                font-size: 1rem;
            }

            .action-button .content p {
                width: 100%;
                display: none;
            }


        }

        @media (min-width: 576px) and (max-width: 767.98px) {
            .action-button {
                max-width: calc(50% - 30px) !important;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .action-button {
                max-width: calc(25% - 1.2rem) !important;
            }
        }

        @media (min-width: 992px) and (max-width: 1199.98px) {
            .action-button {
                max-width: calc(25% - 1.2rem) !important;
            }
        }

        @media (min-width: 1200px) {
            .action-button {
                max-width: calc(25% - 1.2rem) !important;
            }
        }

        .bd-highlight {
            background-color: #e0e0e0;
            border: 1px solid #d0d0d0;
        }

        .container-actions-buttons {
            padding: 1rem;
            gap: 1.5rem;
        }

        .action-button {
            height: auto;
        }

        .action-button:after {
            content: "";
            display: block;
        }

        .card-button .content {
            font-size: .84rem;
        }

        .windx-red {
            background-color: #E82528
        }

        .windx-red-70 {
            background-color: #ED454C
        }

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

@section('modal')

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script type="text/javascript" defer>inactivitySession();</script>
    <script>

        function checkTerms() {
            var terms = getCookie('terms')
            if (!terms) {
                Swal.fire({
                    title: 'Cookies 🍪',
                    html: `
                        <small>Utilizamos cookies para proporcionar uma melhor experiência a você! Consulte nossos,
                         <a href="javascript:void(0);" class="help-link" data-toggle="modal" data-target="#staticBackdrop">
                        Termos de uso e Privacidade
                    </a>.</small>`,
                    position: 'bottom',
                    confirmButtonText: 'Concordo',
                    showDenyButton: false,
                    showCancelButton: true,
                    cancelButtonText: `Fechar`,
                    reverseButtons: true,
                    showClass: {
                        popup: `
                  animate__animated
                  animate__fadeInUp
                  animate__faster
                `,
                    },
                    hideClass: {
                        popup: `
                  animate__animated
                  animate__fadeOutDown
                  animate__faster
                `,
                    },
                    grow: 'row',
                    showConfirmButton: true,
                    showCloseButton: true,
                }).then((result) => {
                    result.isConfirmed ? acceptTerms() : ''
                });

    //             Swal.fire({
    //                 // title: 'Bottom drawer 👋',
    //                 html: `
    //                     <p>Utilizamos cookies para proporcionar uma melhor experiência aos usuários! Em caso de dúvidas,
    //                     consulte nossos <a href="javascript:void(0);" class="help-link" data-toggle="modal" data-target="#staticBackdrop">
    //                     Termos de uso e Privacidade
    //                 </a>.</p>`,
    //                 position: 'bottom',
    //                 showClass: {
    //                     popup: `
    //   animate__animated
    //   animate__fadeInUp
    //   animate__faster
    // `,
    //                 },
    //                 hideClass: {
    //                     popup: `
    //   animate__animated
    //   animate__fadeOutDown
    //   animate__faster
    // `,
    //                 },
    //                 grow: 'row',
    //                 showConfirmButton: true,
    //                 showCloseButton: true,
    //             })
    //
    //             Swal.fire({
    //                 // title: 'Informativo!',
    //                 html: `
    //                     <p>Utilizamos cookies para proporcionar uma melhor experiência aos usuários! Em caso de dúvidas,
    //                     consulte nossos <a href="javascript:void(0);" class="help-link" data-toggle="modal" data-target="#staticBackdrop">
    //                     Termos de uso e Privacidade
    //                 </a>.</p>`,
    //                 showDenyButton: false,
    //                 showCancelButton: true,
    //                 confirmButtonText: "Entendi",
    //                 cancelButtonText: `Fechar`,
    //                 reverseButtons: true,
    //                 showClass: {
    //                     popup: 'animate__animated animate__fadeInDown'
    //                 },
    //                 hideClass: {
    //                     popup: 'animate__animated animate__fadeOutUp'
    //                 },
    //                 allowOutsideClick: () => {
    //                     const popup = Swal.getPopup()
    //                     popup.classList.remove('swal2-show')
    //                     // setTimeout(() => {
    //                     //     popup.classList.add('animate__animated', 'animate__headShake')
    //                     // })
    //                     // setTimeout(() => {
    //                     //     popup.classList.remove('animate__animated', 'animate__headShake')
    //                     // }, 500)
    //                     return false
    //                 },
    //             }).then((result) => {
    //                 /* Read more about isConfirmed, isDenied below */
    //                 if (result.isConfirmed) {
    //                     acceptTerms()
    //                     Swal.fire("Termos aceito!", "", "success");
    //                 } else if (result.isDenied) {
    //                     Swal.fire("All be back", "", "info");
    //                 }
    //             });
            } else {
                console.log('Tem cookie')
            }
        }

        function acceptTerms() {
            setCookie('terms', 'ok', 30)
        }

        // auto timer
        setTimeout(function() {
            checkTerms()
        }, 3000); // optional - automatically opens in xxxx milliseconds
    </script>

@endsection
