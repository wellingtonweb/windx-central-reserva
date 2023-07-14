<div class="hamburger-menu {{ Route::currentRouteName() === 'terminal.login' ? 'invisible' : ''}}">
    <input id="menu__toggle" type="checkbox"/>
    <label class="menu__btn" for="menu__toggle">
        <span></span>
    </label>

        <ul class="menu__box">
{{--            <div class="over-screen"></div>--}}
        <li>
            <a class="menu__item" href="{{ Route('terminal.contracts') }}">
                <div class="link">
                    <div class="icon-bar"><i class="fas fa-file-contract fa-2x pr-3"></i></div>
                    <span>Contratos</span></div>
            </a>
        </li>
        <li>
            <a class="menu__item" href="#">
                <div class="link">
                    <div class="icon-bar"><i class="fas fa-file-invoice-dollar fa-2x pr-3"></i></div>
                    <span>Pagamentos</span></div>
            </a>
        </li>
        <li>
            <a class="menu__item" href="{{ route('terminal.logout') }}">
                <div class="link">
                    <div class="icon-bar"><i class="fas fa-sign-out-alt fa-2x pr-3"></i></div>
                    <span>Sair</span></div>
            </a>
        </li>
        <li class="credits">
            <p>Development by:</p>
            <p>Wellington Dias Ferreira</p>
        </li>
    </ul>

</div>
