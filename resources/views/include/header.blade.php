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
{{--                    <h4 class="text-light m-4 font-weight-bold text-center">Terminal: {{Cookie::has('terminal_id') ? Cookie::get('terminal_id'): '0'}}</h4>--}}
{{--                    @if(session()->has('customerActive') && Route::currentRouteName() != 'central.contracts')--}}
                        <div class="text-left m-3 p-3" style="border-bottom: 1px solid rgba(248,249,250,0.6)">
                            <div class="item-text">
                                <h5 class="text-light font-weight-bold text-left">Contrato ID:</h5>
                                <span class=" text-uppercase text-right">{{session('customer')->id}}</span>
                            </div>
                            {{--                            <h5 class="text-light mt-1 font-weight-bold text-left">Contrato ID: {{session('customerActive')->id}}</h5>--}}
                            {{--                            <span class="pl-4 pr-4 text-uppercase">{{session('customerActive')->id}}</span>--}}
                            {{--                            <p class="pl-4 pr-4 text-uppercase">{{session('customerActive')->id}}</p>--}}
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
{{--                    @else--}}
{{--                        <h5 class="text-light mt-5 mb-5 p-2">Escolha o cadastro desejado!</h5>--}}
{{--                    @endif--}}
                    <div class="menu ">
                        <div class="item">
                            <a href="{{ route('central.contract') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.contract' ? 'active' : '' }}">
                                <i class="fas fa-file-signature" aria-hidden="true"></i>Contrato
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{ route('central.payment') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.contract' ? 'active' : '' }}">
                                <i class="fas fa-money-bill" aria-hidden="true"></i>Pagamento
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{route('central.payments')}}"
                               class="click-loader close-menu {{ Route::currentRouteName() === 'central.payments' ? 'active' : '' }}">
                                <i class="fas fa-file-alt" aria-hidden="true"></i>Comprovantes
                            </a>
                        </div>
                        @if(session()->has('customer') && session('customer')->status === 'B')
                            <div class="item">
                                <a href="javascript:void(0)" id="{{session('customer')->id}}" class="btnRelease click-loader close-menu text-white " onclick="releaseCustomer(this.id)">
{{--                                    <i class="fas fa-lock-open" aria-hidden="true"></i>--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em" >
                                        <path style="fill: white !important;" d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                    </svg>

                                    Desbloqueio
                                </a>
                            </div>
                        @endif
                        <div class="item text-danger">
                            <a href="javascript:void(0)" id="btn-logout" class="click-loader text-orange close-menu" onclick="logout()">
                                <i class="fas fa-door-open" aria-hidden="true"></i>Sair
                            </a>
                        </div>
                    </div>
                </div>
                <div class="credits">
                    <smalL>dewelloper.dev.br</smalL>
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
