<header id="header" class="masthead- justify-content-center- animate__animated animate__fadeInDown animate__delay-1s">
{{--    <nav class="navbar sidebarNavigation p-3 d-none" data-sidebarClass="navbar-dark- bg-dark-">--}}
{{--        <div class="container-fluid">--}}
{{--            <a class="navbar-brand pl-1" href="#">--}}
{{--                <img class="logo-windx" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">--}}
{{--            </a>--}}
{{--            <button class="navbar-toggler rightNavbarToggler btn btn-outline-light font-weight-bold btn-radius-50" type="button" data-toggle="collapse" data-target="#sidebar"--}}
{{--                    aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}{{--<i class="fas fa-bars pr-1" aria-hidden="true"></i>MENU--}}
{{--            </button>--}}
{{--            <div class="collapse navbar-collapse" id="sidebar">--}}
{{--                <ul class="nav navbar-nav nav-flex-icons ml-auto">--}}
{{--                    <li class="nav-item mt-5 {{ Route::currentRouteName() === 'terminal.contracts' ? 'active' : '' }}">--}}
{{--                        <a class="nav-link nav-click click-loader" href="{{ route('terminal.contracts') }}">--}}
{{--                        <a class="nav-link nav-click click-loader {{count(session('customer')) == 1 ? 'd-none' : ''}}" href="{{ route('terminal.contracts') }}">--}}
{{--                            <span class="container-icon"><i class="fas fa-file-signature" aria-hidden="true"></i></span>--}}
{{--                            <span class="container-text">Contratos</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @if(session()->has('customerId'))--}}
{{--                    <li class="nav-item {{ Route::currentRouteName() === 'terminal.payments' ? 'active' : '' }}">--}}
{{--                        <a class="nav-link nav-click click-loader" href="{{route('terminal.payments', ['customerId' => session('customerId')])}}">--}}
{{--                            <span class="container-icon"><i class="fas fa-file-alt" aria-hidden="true"></i></span>--}}
{{--                            <span class="container-text">Comprovantes</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    @endif--}}
{{--                    <li class="nav-item btn-exit">--}}
{{--                        <a class="nav-link text-tomato" href="{{route('terminal.logout')}}">--}}
{{--                            <span class="container-icon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>--}}
{{--                            <span class="container-text">Sair</span>--}}
{{--                        </a>--}}
{{--                        <a id="btn-logout" class="nav-link text-tomato" href="#">--}}
{{--                            --}}{{----}}{{--                            <span><i class="fas fa-door-open" aria-hidden="true"></i></span> Sair</a>--}}
{{--                            <span class="container-icon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>--}}
{{--                            <span class="container-text">Sair</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--                <div class="credits">--}}
{{--                    <smal>Desenvolvido por <br>Wellington Dias Ferreira</smal>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

    <aside class="sidebar">
        <div class="sidebar_inner">
            <header class="sidebar_header">
                <button type="button" class="sidebar_burger" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars burger-icon"></i>
                </button>
                <img src="C:\Users\User\Documents\images\blocklord-logo.png" class="sidebar_logo">
            </header>
            <nav class="sidebar_nav">
                <button type="button">
                    <i class="fa-solid fa-house"></i>
                    <span style="animation-delay: .5s">Home</span>
                </button>
                <button type="button">
                    <i class="fa-solid fa-gear"></i>
                    <span style="animation-delay: .4s">Settings</span>
                </button>
                <button type="button">
                    <i class="fa-solid fa-layer-group"></i>
                    <span style="animation-delay: .3s">Levels</span>
                </button>
                <button type="button">
                    <i class="fa-solid fa-user"></i>
                    <span style="animation-delay: .2s">Accounts</span>
                </button>
            </nav>
            <footer class="sidebar_footer">
                <button type="button">
                    <i class="fa-solid fa-lock"></i>
                    <span style="animation-delay: .1s">Logout</span>
                </button>
            </footer>
        </div>
    </aside>

{{--    <nav class="nav">--}}
{{--        <a class="navbar-brand pl-1" href="#">--}}
{{--            <img class="logo-windx" src="{{ asset('assets/img/logo.svg') }}" alt="{{ config('app.name') }}">--}}
{{--        </a>--}}
{{--        <div class="nav__toggle">--}}
{{--            <div class="nav__line nav__line--first"></div>--}}
{{--            <div class="nav__line nav__line--second"></div>--}}
{{--            <div class="nav__line nav__line--third"></div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <div class="sidebar">--}}
{{--        <ul class="nav navbar-nav nav-flex-icons ml-auto">--}}
{{--            <li class="nav-item mt-5 {{ Route::currentRouteName() === 'terminal.contracts' ? 'active' : '' }}">--}}
{{--                <a class="nav-link nav-click click-loader" href="{{ route('terminal.contracts') }}">--}}
{{--                <a class="nav-link nav-click click-loader {{count(session('customer')) == 1 ? 'd-none' : ''}}" href="{{ route('terminal.contracts') }}">--}}
{{--                    <span class="container-icon"><i class="fas fa-file-signature" aria-hidden="true"></i></span>--}}
{{--                    <span class="container-text">Contratos</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @if(session()->has('customerId'))--}}
{{--            <li class="nav-item {{ Route::currentRouteName() === 'terminal.payments' ? 'active' : '' }}">--}}
{{--                <a class="nav-link nav-click click-loader" href="{{route('terminal.payments', ['customerId' => session('customerId')])}}">--}}
{{--                    <span class="container-icon"><i class="fas fa-file-alt" aria-hidden="true"></i></span>--}}
{{--                    <span class="container-text">Comprovantes</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endif--}}
{{--            <li class="nav-item btn-exit">--}}
{{--                <a id="btn-logout" class="nav-link text-tomato" href="#">--}}
{{--                    <span><i class="fas fa-door-open" aria-hidden="true"></i></span> Sair</a>--}}
{{--                    <span class="container-icon"><i class="fa fa-times-circle" aria-hidden="true"></i></span>--}}
{{--                    <span class="container-text">Sair</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
{{--    </div>--}}
    <div class="header-page ">
        <h3 class="font-weight-bold h3">Terminal de autoatendimento</h3>
        @if(Route::currentRouteName() == 'terminal.contract')
            <h5 id="payment-title" class="h5 pt-1">Contrato nº: {{$customer[0]->id}} - Checkout</h5>
        @elseif(Route::currentRouteName() == 'terminal.contracts')
            <h5 id="payment-title" class="h5 pt-1">Contratos</h5>
        @else
            <h5 id="payment-title" class="h5 pt-1">Comprovantes (2ª via - Contrato nº: {{session('customerId')}})</h5>
        @endif
    </div>
</header>



