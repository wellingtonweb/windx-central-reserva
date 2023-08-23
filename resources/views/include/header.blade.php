<header id="header" class="masthead- justify-content-center- animate__animated animate__fadeInDown animate__delay-1s">
    <nav class="navbar sidebarNavigation p-3 d-none-" data-sidebarClass="navbar-dark- bg-dark-">
        <div class="container-fluid">
            <a class="navbar-brand pl-1" href="#">
                <img class="logo-windx" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">
            </a>
            <button id="btn-menu-toggle" class="navbar-toggler rightNavbarToggler font-weight-bold" type="button" data-toggle="collapse" data-target="#sidebar"
                    aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span><i class="fas fa-bars fa-2x" aria-hidden="true"></i>
            </button>
            <div class="collapse navbar-collapse" id="sidebar">
                <div class="side-bar">
                    <div class="text-left m-3 p-3" style="border-bottom: 1px solid rgba(248,249,250,0.6)">
                        <div class="item-text">
                            <h5 class="text-light font-weight-bold text-left">Contrato ID:</h5>
                            <span class=" text-uppercase text-right">{{session('customer')->id}}</span>
                        </div>
                        <div class="item-text">
                            <h5 class="text-light font-weight-bold text-left">Status:</h5>
                            @switch(session('customer')->status)
                                @case('L')
                                <span class="text-status text-right text-primary">LIBERADO</span>
                                @break;
                                @case('B')
                                <span class="text-status text-right text-orange">BLOQUEADO</span>
                                @break;
                                @case('X')
                                <span class="text-status text-right text-secondary">DESATIVADO</span>
                                @break;
                            @endswitch
                        </div>
                        <div class="item-text">
                            <h5 class="text-light font-weight-bold text-left">Cliente:</h5>
                            <span class=" text-right text-uppercase">{{session('customer')->full_name}}</span>
                        </div>
                        <div class="item-text">
                            <h5 class="text-light font-weight-bold">Endereço:</h5>
                            <span class=" text-right text-uppercase text-address-menu">{{session('customer')->street}}, {{session('customer')->district}},
                                {{session('customer')->city}}</span>
                        </div>
                    </div>
                    <div class="menu ">
                        <div class="item">
                            <a href="{{ route('central.contract') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.contract' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                </svg>Contrato
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ route('central.payment') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.contract' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                </svg>Pagamento
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{route('central.payments')}}"
                               class="click-loader close-menu {{ Route::currentRouteName() === 'central.payments' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                    <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>Comprovantes
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{route('central.invoices')}}"
                               class="click-loader close-menu {{ Route::currentRouteName() === 'central.invoices' ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-medical" viewBox="0 0 18 18" width="1.2em">
                                    <path d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>Notas Fiscais
                            </a>
                        </div>
                        @if(session()->has('customer') && session('customer')->status === 'B')
                            <div class="item">
                                <a href="javascript:void(0)" id="{{session('customer')->id}}" class="btnRelease click-loader close-menu text-white " onclick="releaseCustomer(this.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em">
                                        <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                    </svg>Desbloqueio
                                </a>
                            </div>
                        @endif
                        <div class="item text-danger">
                            <a href="javascript:void(0)" id="btn-logout" class="click-loader text-orange close-menu" onclick="logout()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-door-open" viewBox="0 0 18 18" width="1.2em">
                                    <path style="fill: coral !important;" d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                    <path style="fill: coral !important;" d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                                </svg>
                                Sair
                            </a>
                        </div>
                    </div>
                </div>
                <div class="credits">
                    <a href="javascript:void(0)">
                        <smalL>dewelloper.dev.br</smalL>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="header-page">
        <h3 class="font-weight-bold h3">Central do Assinante</h3>
        @if($header)
            <h5 id="payment-title" class="h5 pt-1">{{$header}}</h5>
        @endif
    </div>
</header>
