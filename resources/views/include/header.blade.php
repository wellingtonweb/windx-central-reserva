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
                        <div class="text-left m-3 p-3" style="border-bottom: 1px solid #f8f9fa">
                            <div class="item-text">
                                <h5 class="text-light font-weight-bold text-left">Contrato ID:</h5>
                                <span class=" text-uppercase text-right">{{session('customerActive')->id}}</span>
                            </div>
                            {{--                            <h5 class="text-light mt-1 font-weight-bold text-left">Contrato ID: {{session('customerActive')->id}}</h5>--}}
                            {{--                            <span class="pl-4 pr-4 text-uppercase">{{session('customerActive')->id}}</span>--}}
                            {{--                            <p class="pl-4 pr-4 text-uppercase">{{session('customerActive')->id}}</p>--}}
                            <div class="item-text">
                                <h5 class="text-light font-weight-bold text-left">Status:</h5>
                                @switch(session('customerActive')->status)
                                    @case('L')
                                    <span class="text-status text-right text-primary">LIBERADO</span>
                                    @break;
                                    @case('B')
                                    <span class="text-status text-right text-danger">BLOQUEADO</span>
                                    @break;
                                    @case('X')
                                    <span class="text-status text-right text-secondary">DESATIVADO</span>
                                    @break;
                                @endswitch
                            </div>
                            <div class="item-text">
                                <h5 class="text-light font-weight-bold text-left">Cliente:</h5>
                                <span class=" text-right text-uppercase">{{session('customerActive')->full_name}}</span>
                            </div>
                            <div class="item-text">
                                <h5 class="text-light font-weight-bold">Endereço:</h5>
                                <span class=" text-right text-uppercase text-address-menu">{{session('customerActive')->street}}, {{session('customerActive')->district}},
                                    {{session('customerActive')->city}}</span>
                            </div>
                        </div>
{{--                    @else--}}
{{--                        <h5 class="text-light mt-5 mb-5 p-2">Escolha o cadastro desejado!</h5>--}}
{{--                    @endif--}}
                    <div class="menu">
{{--                        <div class="item {{ Route::currentRouteName() === 'terminal.contracts' ? 'd-none' : '' }}">--}}
{{--                            <a href="{{ route('terminal.contracts') }}" class="click-loader close-menu {{count(session('customer')) == 1 ? 'd-none' : ''}}--}}
{{--                            {{ Route::currentRouteName() === 'terminal.contracts' ? 'active' : '' }}">--}}
{{--                                <i class="fas fa-file-signature" aria-hidden="true"></i>Contratos--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        @if(session()->has('customerId'))
                            <div class="item">
                                <a href="{{route('central.payments', ['customerId' => session('customerId')])}}"
                                   class="click-loader close-menu {{ Route::currentRouteName() === 'central.payments' ? 'active' : '' }}">
                                    <i class="fas fa-file-alt" aria-hidden="true"></i>Comprovantes
                                </a>
                            </div>
                        @endif
                        @if(session()->has('customerActive') && session('customerActive')->status === 'B')
                            <div class="item">
                                <a href="#" id="{{session('customerId')}}" class="btnRelease click-loader close-menu" onclick="releaseCustomer(this.id)">
                                    <i class="fas fa-lock-open" aria-hidden="true"></i>Liberar por confiança
                                </a>
                            </div>
                        @endif
                        <div class="item text-danger">
                            <a href="#" id="btn-logout" class="click-loader text-orange close-menu" onclick="logout()">
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
