@extends('layouts.app_login')

@section('content')
    <main role="main" class="inner cover mt-md-3">
        <section>
            <div id="main" class="container-logon">
                <div class="card-logon p-2">
                    <div class="card form-signin p-4" style="border-radius: 1rem">
                        <form id="form_reset_password" method="POST" action="{{ Route('central.reset.password') }}">
                            <div class="card-header font-weight-bold" style="padding-top: 0">
                                <h2>Central do Assinante</h2>
                                <h3>Nova senha</h3>
                            </div>
                            <div class="card-body" style="padding: 0 !important;">
                                @csrf

                                @if ($errors->has('email') || $errors->has('password') || $errors->has('confirm') || session('error'))
                                    <p class="card-text text-danger pb-1">Verifique os dados informados!</p>
                                @endif
                                <div class="input-group mb-2 {{ $errors->has('email') ? 'is-error' : '' }}">
                                    <div class="input-group-prepend">
                                        <i class="fa fa-user {{ $errors->has('email') ? 'text-danger' : '' }} " aria-hidden="true"></i>
                                    </div>
                                    <input id="login"
                                           type="text"
                                           value="{{ old('email') }}"
                                           class="form-control inputs-login
                                            @error('email') is-invalid @enderror"
                                           name="login"
                                           placeholder="{{ $errors->has('email') ? 'O e-mail é obrigatório' : 'Digite seu e-mail' }}"
                                           aria-label="E-mail"
                                           aria-describedby="email">
                                </div>
                                <small class="text-danger mt-1 login_reset_error"></small>
                                <div class="input-group mb-2 {{ $errors->has('password') ? 'is-error' : '' }}">
                                    <div class="input-group-prepend">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </div>
                                    <input id="password"
                                           type="{{ $errors->has('password') ? 'text' : 'password'}}"
                                           value="{{ old('password') }}"
                                           class="form-control inputs-login
                                            @error('password') is-invalid @enderror"
                                           name="password"
                                           placeholder="{{ $errors->has('password') ? 'A senha é obrigatória' : 'Digite a nova senha' }}"
                                           aria-label="Password"
                                           aria-describedby="password">
                                    <span class="show-pass text-danger pr-3" onclick="toggle1()">
                                        <i class="far fa-eye" onclick="showPassword(this)"></i>
                                    </span>
                                </div>
                                <small class="text-danger mt-1 password_reset_error"></small>
                                <div class="input-group {{ $errors->has('confirm') ? 'is-error' : '' }}">
                                    <div class="input-group-prepend">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </div>
                                    <input id="confirm"
                                           type="{{ $errors->has('confirm') ? 'text' : 'password'}}"
                                           value="{{ old('confirm') }}"
                                           class="form-control inputs-login
                                            @error('confirm') is-invalid @enderror" name="confirm"
                                           placeholder="{{ $errors->has('confirm') ? 'A confirmação da senha é obrigatória' : 'Confirme a nova senha' }}"
                                           aria-label="Confirm password"
                                           aria-describedby="confirm password">
                                    <span class="show-pass text-danger pr-3" onclick="toggle2()">
                                        <i class="far fa-eye" onclick="showPassword(this)"></i>
                                    </span>
                                </div>
                                <small class="text-danger mt-1 confirm_reset_error"></small>
                                @include('include.captcha')
                                <div class="form-group">
                                    <div id="popover-password">
                                        <p><span id="result"></span></p>

                                        <div class="progress">
                                            <div id="password-strength"
                                                 class="progress-bar"
                                                 role="progressbar"
                                                 aria-valuenow="40"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width:0%">
                                            </div>
                                        </div>

                                        <ul class="list-unstyled text-left pt-2 " style="font-size: 80%">
                                            <li class="py-1">
                                                <span class="text-muted">Sua senha deve ter:</span>
                                            </li>
                                            <li class="">
                                                    <span class="eight-character text-muted">
                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                        &nbsp;Mínimo de 8 caracteres
                                                    </span>
                                            </li>
                                            <li class="">
                                                    <span class="low-upper-case text-muted">
                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                        &nbsp;Maiúsculas &amp; minúsculas
                                                    </span>
                                            </li>
                                            <li class="">
                                                    <span class="one-number text-muted">
                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                        &nbsp;Números (0-9)
                                                    </span>
                                            </li>
                                            <li class="">
                                                    <span class="one-special-char text-muted">
                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                        &nbsp;Caracteres especiais (<span style="letter-spacing: 1px">!@#$%^&*</span>)
                                                    </span>
                                            </li>
                                            <li class="">
                                                    <span class="equals-character text-muted">
                                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                                        &nbsp;Senha e confirma senha iguais
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <a href="{{ route('central.login') }}" class="card-link text-primary close_reset_password">Voltar ao login?</a>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <button id="btn-save" type="submit" class="btn btn-primary btn-load_ btn-block" disabled_
                                        style="font-size: 1rem; margin: 0">Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .form-horizontal {
            width: 320px;
            background-color: #ffffff;
            padding: 25px 38px;
            border-radius: 12px;
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.5);
        }

        .control-label {
            text-align: left !important;
            padding-bottom: 4px;
        }

        .progress {
            height: 3px !important;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .show-pass {
            position: absolute;
            top: 5%;
            right: 8%;
        }

        .progress-bar-danger {
            background-color: #e90f10;
        }

        .progress-bar-warning {
            background-color: #ffad00;
        }

        .progress-bar-success {
            background-color: #02b502;
        }

        .login-btn {
            width: 180px !important;
            background-image: linear-gradient(to right, #f6086e, #ff133a) !important;
            font-size: 18px;
            color: #fff;
            margin: 0 auto 5px;
            padding: 8px 0;
        }

        .login-btn:hover {
            background-image: linear-gradient(to right, rgba(255, 0, 111, 0.8), rgba(247, 2, 43, 0.8)) !important;
            color: #fff !important;
        }

        .fa-eye {
            color: #022255;
            cursor: pointer;
        }

        .ex-account p a {
            color: #f6086e;
            text-decoration: underline;
        }

        .fa-circle {
            font-size: 6px;
        }

        .fa-check {
            color: #02b502;
        }


    </style>
@endsection

@section('js')
    <script>
        let state_password = false;
        let state_confirm = false;
        let statePassword = false;
        let stateConfirmPassword = false;
        let inputPassword = document.getElementById("password");
        let inputConfirmPassword = document.getElementById("confirm");
        let btnSave = document.getElementById("btn-save");
        let passwordStrength = document.getElementById("password-strength");
        let lowUpperCase = document.querySelector(".low-upper-case i");
        let number = document.querySelector(".one-number i");
        let specialChar = document.querySelector(".one-special-char i");
        let eightChar = document.querySelector(".eight-character i");
        let equalsChars = document.querySelector(".equals-character i");
        let checkSpecialChar = false;
        let checkLowUpperCase = false;
        let checkNumber = false;
        let checkEightChar = false;
        let checkEqualsChars = false;

        inputPassword.addEventListener("keyup", function () {
            let pass = inputPassword.value;
            checkStrength(pass);
        });

        inputConfirmPassword.addEventListener("keyup", function () {
            let confPass = inputConfirmPassword.value;
            checkStrength(confPass);
        });

        function toggle1() {
            if (statePassword) {
                inputPassword.setAttribute("type", "password");
                statePassword = false;
            } else {
                inputPassword.setAttribute("type", "text")
                statePassword = true;
            }
        }

        function toggle2() {
            if (stateConfirmPassword) {
                inputConfirmPassword.setAttribute("type", "password");
                stateConfirmPassword = false;
            } else {
                inputConfirmPassword.setAttribute("type", "text")
                stateConfirmPassword = true;
            }
        }

        function showPassword(show) {
            show.classList.toggle("fa-eye-slash");
        }

        $('#btn-save').click(function (){
           $(this).text('Salvando...')
        });

        function checkStrength() {
            let password = inputPassword.value
            let strength = 0;

            //If password contains both lower and uppercase characters
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                document.querySelector(".low-upper-case").classList.remove('text-muted');
                document.querySelector(".low-upper-case").classList.add('text-success');
                lowUpperCase.classList.remove('fa-circle');
                lowUpperCase.classList.add('fa-check');

                checkLowUpperCase = true;
            } else {
                document.querySelector(".low-upper-case").classList.remove('text-success');
                document.querySelector(".low-upper-case").classList.add('text-muted');
                lowUpperCase.classList.add('fa-circle');
                lowUpperCase.classList.remove('fa-check');
                checkLowUpperCase = false;
                strength = -1;
            }
            //If it has numbers and characters
            if (password.match(/([0-9])/)) {
                strength += 1;
                document.querySelector(".one-number").classList.remove('text-muted');
                document.querySelector(".one-number").classList.add('text-success');
                number.classList.remove('fa-circle');
                number.classList.add('fa-check');
                checkNumber = true;
            } else {
                document.querySelector(".one-number").classList.remove('text-success');
                document.querySelector(".one-number").classList.add('text-muted');
                number.classList.add('fa-circle');
                number.classList.remove('fa-check');
                checkNumber = false;
                strength = -1;
            }
            //If it has one special character
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                strength += 1;
                document.querySelector(".one-special-char").classList.remove('text-muted');
                document.querySelector(".one-special-char").classList.add('text-success');
                specialChar.classList.remove('fa-circle');
                specialChar.classList.add('fa-check');
                checkSpecialChar = true;
            } else {
                document.querySelector(".one-special-char").classList.remove('text-success');
                document.querySelector(".one-special-char").classList.add('text-muted');
                specialChar.classList.add('fa-circle');
                specialChar.classList.remove('fa-check');
                checkSpecialChar = false;
                strength = -1;
            }
            //If password is greater than 7
            if (password.length > 7) {
                strength += 1;
                document.querySelector(".eight-character").classList.remove('text-muted');
                document.querySelector(".eight-character").classList.add('text-success');
                eightChar.classList.remove('fa-circle');
                eightChar.classList.add('fa-check');
                checkEightChar = true;
            } else {
                document.querySelector(".eight-character").classList.remove('text-success');
                document.querySelector(".eight-character").classList.add('text-muted');
                eightChar.classList.add('fa-circle');
                eightChar.classList.remove('fa-check');
                checkEightChar = false;
                strength = -1;
            }
            //If password is equals in inputs
            if((inputPassword.value == inputConfirmPassword.value) && (inputPassword.value != "") && (inputConfirmPassword.value != "")){
                strength += 1;
                document.querySelector(".equals-character").classList.remove('text-muted');
                document.querySelector(".equals-character").classList.add('text-success');
                equalsChars.classList.remove('fa-circle');
                equalsChars.classList.add('fa-check');
                checkEqualsChars = true;
            } else {
                document.querySelector(".equals-character").classList.remove('text-success');
                document.querySelector(".equals-character").classList.add('text-muted');
                equalsChars.classList.add('fa-circle');
                equalsChars.classList.remove('fa-check');
                checkEqualsChars = false;
                strength = -1;
            }

            //Check that all requirements have been met to enable the button
            // if(checkSpecialChar && checkLowUpperCase && checkNumber && checkEightChar && checkEqualsChars){
            //     btnSave.disabled = false;
            // }else{
            //     btnSave.disabled = true;
            // }

            //Modified progress bar value with state
            if (strength == 1) {
                passwordStrength.classList.add('progress-bar-danger');
                passwordStrength.style = 'width: 20%';
            } else if (strength == 2) {
                passwordStrength.classList.add('progress-bar-warning');
                passwordStrength.style = 'width: 40%';
            } else if (strength == 3) {
                passwordStrength.classList.add('progress-bar-warning');
                passwordStrength.style = 'width: 60%';
            } else if (strength == 4) {
                passwordStrength.classList.add('progress-bar-warning');
                passwordStrength.style = 'width: 80%';
            } else if (strength == 5) {
                passwordStrength.classList.add('progress-bar-success');
                passwordStrength.style = 'width: 100%';
            }
        }
    </script>
    @if ($errors->has('document'))
        <script>
            let message = `{{$errors->first('document')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro ' + 400 + '!',
                text: message,
                timer: 7000
            });
        </script>
    @elseif(session('error'))
        <script>
            let session = `{{session('error')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro ' + 400 + '!',
                text: session,
                timer: 7000
            });
        </script>
    @endif
@endsection
