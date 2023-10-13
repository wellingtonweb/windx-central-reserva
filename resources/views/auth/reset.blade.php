@extends('layouts.app_login')

@section('content')
<main role="main" class="inner cover mt-md-3">
    <section>
        <div id="main" class="container-logon">
            <div class="loader animate__animated animate__fadeInUp d-none">
                <h2>
                    <span>W</span>
                    <span>I</span>
                    <span>N</span>
                    <span>D</span>
                    <span>X</span>
                </h2>
            </div>
            <div class="card-logon p-2">
                <div class="card form-signin p-4" style="border-radius: 1rem">
                    <form id="form_reset_password" method="POST" class="d-none" action="{{ Route('central.login.reset.send') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="font-size: 2rem; color: #002046;">Central do Assinante</h2>
                            <h3 style="font-size: 1.5rem; color: #002046;">Nova senha</h3>
                        </div>
                        <div class="card-body">
                            @csrf

                            @if ($errors->has('login') || $errors->has('password') || session('error'))
                                <p class="card-text text-danger pb-1">Verifique os dados informados!</p>
                            @else
                                <p class="card-text text-black-50 pb-1">Preencha com uma nova senha!</p>
                            @endif

                            <div class="input-group mb-3 {{ $errors->has('password') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" class="form-control inputs-login

                                @error('password') is-invalid @enderror"
                                       {{--                                    @error('password') is-invalid @enderror" value="{{old('password')}}"--}}
                                       name="password"  placeholder="{{ $errors->has('password') ? 'A senha é obrigatória' : 'Digite a nova senha' }}" aria-label="Password"
                                       aria-describedby="password">
                                <span class="show-pass" onclick="toggle()">
                            <i class="far fa-eye" onclick="myFunction(this)"></i>
                        </span>
                            </div>
                            <div class="input-group mb-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputConfirPassword" type="password" class="form-control inputs-login

                                @error('login') is-invalid @enderror" name="confirm_password"
                                       {{--                                    @error('login') is-invalid @enderror" value="{{old('login')}}" name="login"--}}
                                       placeholder="{{ $errors->has('confirm_password') ? 'A confirmação da senha é obrigatória' : 'Confirme a nova senha' }}"
                                       aria-label="Confirm password" aria-describedby="confirm password">

                            </div>

                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Salvar</button>
                        </div>
                    </form>
                    <form class="form-horizontal" id="validateForm">
                        <h1>Welcome</h1>
                        <fieldset>
                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-12 control-label" for="textinput">
                                    Email
                                </label>
                                <div class="col-md-12">
                                    <input id="email" name="textinput"
                                           type="email" autocomplete="off"
                                           placeholder="Enter your email address"
                                           class="form-control input-md">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-12 control-label" for="passwordinput">
                                    Password
                                </label>
                                <div class="col-md-12">
                                    <input id="password" class="form-control input-md"
                                           name="password" type="password"
                                           placeholder="Enter your password" >
                                    <span class="show-pass" onclick="toggle()">
                            <i class="far fa-eye" onclick="myFunction(this)"></i>
                        </span>
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
                                        <ul class="list-unstyled">
                                            <li class="">
                                    <span class="low-upper-case">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Lowercase &amp; Uppercase
                                    </span>
                                            </li>
                                            <li class="">
                                    <span class="one-number">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Number (0-9)
                                    </span>
                                            </li>
                                            <li class="">
                                    <span class="one-special-char">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Special Character (!@#$%^&*)
                                    </span>
                                            </li>
                                            <li class="">
                                    <span class="eight-character">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Atleast 8 Character
                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Button -->

                            <div class="form-group">
                                <a href="#" class="btn login-btn btn-block">
                                    Create Account
                                </a>
                            </div>
                            <div class="ex-account text-center">
                                <p>Already have an account? Signin
                                    <a href="/">here</a>
                                </p>
                                <div class="divider"></div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
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
{{--    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>--}}

<script>
    let state = false;
    let password = document.getElementById("password");
    let passwordStrength = document.getElementById("password-strength");
    let lowUpperCase = document.querySelector(".low-upper-case i");
    let number = document.querySelector(".one-number i");
    let specialChar = document.querySelector(".one-special-char i");
    let eightChar = document.querySelector(".eight-character i");

    password.addEventListener("keyup", function(){
        let pass = document.getElementById("password").value;
        checkStrength(pass);
    });

    function toggle(){
        if(state){
            document.getElementById("password").setAttribute("type","password");
            state = false;
        }else{
            document.getElementById("password").setAttribute("type","text")
            state = true;
        }
    }

    function myFunction(show){
        show.classList.toggle("fa-eye-slash");
    }

    function checkStrength(password) {
        let strength = 0;

        //If password contains both lower and uppercase characters
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
            strength += 1;
            lowUpperCase.classList.remove('fa-circle');
            lowUpperCase.classList.add('fa-check');
        } else {
            lowUpperCase.classList.add('fa-circle');
            lowUpperCase.classList.remove('fa-check');
        }
        //If it has numbers and characters
        if (password.match(/([0-9])/)) {
            strength += 1;
            number.classList.remove('fa-circle');
            number.classList.add('fa-check');
        } else {
            number.classList.add('fa-circle');
            number.classList.remove('fa-check');
        }
        //If it has one special character
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
            strength += 1;
            specialChar.classList.remove('fa-circle');
            specialChar.classList.add('fa-check');
        } else {
            specialChar.classList.add('fa-circle');
            specialChar.classList.remove('fa-check');
        }
        //If password is greater than 7
        if (password.length > 7) {
            strength += 1;
            eightChar.classList.remove('fa-circle');
            eightChar.classList.add('fa-check');
        } else {
            eightChar.classList.add('fa-circle');
            eightChar.classList.remove('fa-check');
        }

        // If value is less than 2
        if (strength < 2) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.add('progress-bar-danger');
            passwordStrength.style = 'width: 10%';
        } else if (strength == 3) {
            passwordStrength.classList.remove('progress-bar-success');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-warning');
            passwordStrength.style = 'width: 60%';
        } else if (strength == 4) {
            passwordStrength.classList.remove('progress-bar-warning');
            passwordStrength.classList.remove('progress-bar-danger');
            passwordStrength.classList.add('progress-bar-success');
            passwordStrength.style = 'width: 100%';
        }
    }
</script>



{{--    <script defer type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>--}}
    @if ($errors->has('document'))
        <script>
            let message = `{{$errors->first('document')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro '+400+'!',
                text: message,
                timer: 7000
            });
        </script>
    @elseif(session('error'))
        <script>
            let session = `{{session('error')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro '+400+'!',
                text: session,
                timer: 7000
            });
        </script>
    @endif
@endsection
