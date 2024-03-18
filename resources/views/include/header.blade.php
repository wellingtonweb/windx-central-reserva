<header id="header" class="header">
    <div class="nav-web animate__animated animate__fadeInDown animate__delay-1s ">
        <div class="header-page">
            <h3 class="font-weight-bold h3">Central do Assinante</h3>
            @if($header)
                <h5 id="payment-title" class="h5 pt-1">{{$header}}</h5>
            @endif
        </div>
        <nav class="navbar sidebarNavigation p-lg-3 p-md-3 p-sm-0" data-sidebarClass="navbar-dark- bg-dark-">
            <div class="container-fluid">
                <a class="navbar-brand pl-1" href="{{ route('central.home') }}">
                    <img class="logo-windx" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">
                </a>
                <div class="flex justify-content-between align-items-center align-vertical">
                    <button id="btn-menu-toggle" class="navbar-toggler rightNavbarToggler font-weight-bold" type="button" data-toggle="collapse" data-target="#sidebar"
                            aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span><i class="fas fa-bars fa-2x" aria-hidden="true"></i>
                    </button>
                    <a href="javascript:void(0)" style="border-radius: 5px; border: 1px solid white; padding: 5px 10px; margin-top: 5px; display: flex; color: white; background-color: #ba302c; justify-content: center; align-items: center" onclick="logout()">
                            <i class="fas fa-sign-out-alt pr-1"></i>Sair
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="sidebar">
                    <div class="side-bar">
                        <div class="text-left m-3 p-3" style="border-bottom: 1px solid rgba(248,249,250,0.6)">
                            <div class="item-text">
                                <h5 class="item-title text-light font-weight-bold text-left">Contrato Nº:</h5>
                                <span class=" text-uppercase text-right">{{session('customer.id')}}</span>
                            </div>
                            <div class="item-text">
                                <h5 class="item-title text-light font-weight-bold text-left">Status:</h5>
                                @switch(session('customer.status'))
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
                                <h5 class="item-title text-light font-weight-bold text-left">Cliente:</h5>
                                <span class=" text-right text-uppercase">{{session('customer.full_name')}}</span>
                            </div>
                            <div class="item-text">
                                <h5 class="item-title text-light font-weight-bold">Endereço:</h5>
                                <span class=" text-right text-uppercase text-address-menu">{{session('customer.street')}}, {{session('customer.district')}},
                                {{session('customer.city')}}</span>
                            </div>
                        </div>
                        <div class="menu ">
                            <div class="item">
                                <a href="{{ route('central.home') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.home' ? 'active' : '' }}">
                                    <i class="fa fa-home"></i>
                                    Home
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('central.contract') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.contract' ? 'btn-side-active' : '' }}">
                                    <i class="fas fa-file-alt"></i>
                                    Contrato
                                </a>
                            </div>
                            <div class="item">
                                <a id="linkCollapseSidebar" data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false" aria-controls="collapseSidebar" class="">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    Financeiro
                                </a>
                            </div>
                            <div class="collapse pl-3" id="collapseSidebar">
                                <div class="item">
                                    <a href="{{ route('central.payment') }}" class="click-loader close-menu
                            {{ Route::currentRouteName() === 'central.payment' ? 'btn-side-active' : '' }}">
                                        <i class="fas fa-dollar-sign"></i>
                                        Pagamento
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{route('central.payments')}}"
                                       class="click-loader close-menu {{ Route::currentRouteName() === 'central.payments' ? 'btn-side-active' : '' }}">
                                        <i class="fas fa-file-download"></i>
                                        Comprovantes
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{route('central.invoices')}}"
                                       class="click-loader close-menu {{ Route::currentRouteName() === 'central.invoices' ? 'btn-side-active' : '' }}">
                                        <i class="fas fa-file-invoice"></i>
                                        Notas Fiscais
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <a href="{{route('central.support')}}"
                                   class="click-loader close-menu {{ Route::currentRouteName() === 'central.support' ? 'btn-side-active' : '' }}">
                                    <i class="fas fa-life-ring"></i>
                                    Suporte
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{route('central.traffic.average')}}"
                                   class="click-loader close-menu {{ Route::currentRouteName() === 'central.traffic.average' ? 'btn-side-active' : '' }}">
                                    <i class="fas fa-chart-bar"></i>
                                    Gráficos
                                </a>
                            </div>
                            @if(session()->has('customer') && session('customer.status') === 'W')
                            <div class="item">
                                <a href="{{route('central.connection')}}"
                                   class="click-loader close-menu {{ Route::currentRouteName() === 'central.connection' ? 'btn-side-active' : '' }}">
                                    <i class="fas fa-network-wired"></i>
                                    Conexão
                                </a>
                            </div>
                            @endif
                            @if(session()->has('customer') && session('customer.status') === 'B' && \App\Services\Validations::isRelease(session('customer.dt_trust')))
                                <div id="btn-release-sidebar" class="item btnReleaseItem">
                                    <a href="javascript:void(0)" id="{{session('customer.id')}}" class="btnRelease click-loader close-menu" onclick="releaseCustomer(this.id)">
                                        <i class="fas fa-unlock-alt"></i>
                                        Desbloqueio
                                    </a>
                                </div>
                            @endif
                            <div class="item text-danger">
                                <a href="javascript:void(0)" id="btn-logout" class="click-loader close-menu" onclick="logout()">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Sair
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="credits">
                        <a href="https://dewelloper.dev.br" target="_blank">
                            <smalL>dewelloper.dev.br</smalL>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="nav-mobile container">
        <nav class="bottom-nav">
            <div class="bottom-nav-item active">
                <a href="{{ route('central.home') }}" class="click-loader
                            {{ Route::currentRouteName() === 'central.home' ? 'active' : '' }}">
                    <div class="bottom-nav-link {{ Route::currentRouteName() === 'central.home' ? 'icon-active' : '' }}">
                        <i class="fa fa-home"></i>
                        <span>Home</span>
                    </div>
                </a>
            </div>
            <div class="bottom-nav-item">
                <a href="{{ route('central.contract') }}" class="click-loader
                {{ Route::currentRouteName() === 'central.contract' ? 'active' : '' }}">
                    <div class="bottom-nav-link {{ Route::currentRouteName() === 'central.contract' ? 'icon-active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Contrato</span>
                    </div>
                </a>
            </div>
            <div class="bottom-nav-item">
                <a href="{{ route('central.payment') }}" class="click-loader
            {{ Route::currentRouteName() === 'central.payment' ? 'active' : '' }}">
                    <div class="bottom-nav-link {{ Route::currentRouteName() === 'central.payment' ? 'icon-active' : '' }}">
                        <i class="fas fa-dollar-sign"></i>
                        <span>Pagamento</span>
                    </div>
                </a>
            </div>
            <div class="bottom-nav-item">
                <a href="{{ env('WHATSAPP_SERVICE') }}"
                   target="_blank">
                    <div class="bottom-nav-link">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </div>
                </a>
            </div>
            <div class="bottom-nav-item">
                <a href="javascript:void(0)" class="close-menu" onclick="logout()">
                    <div class="bottom-nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </div>
                </a>
            </div>
        </nav>
    </div>
</header>
