@extends('layouts.app_login')

@section('content')
<div class="full-screen-splash">
    <section>
        <article>
            <img class="animate__animated animate__zoomIn" src="{{ asset('assets/img/logox.svg') }}"
                 alt="{{ config('app.name') }}">
            <h2 class="text-white mt-3 animate__animated animate__zoomIn animate__delay-1s">Windx <br> Telecomunicações
            </h2>
        </article>
    </section>
</div>
<main role="main" class="inner cover mt-md-3">
    <section>
        <div id="main" class="container-logon">
            <div class="card-logon p-2">
                <div class="card form-signin p-4 d-none" style="border-radius: .5rem">
                    <form id="form_login" method="POST" class="panel" action="{{ Route('central.logon') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="color: #002046;">Central do Assinante</h2>
                        </div>
                        <div class="card-body" style="padding: 0 !important;">
                            @csrf
                            <p class="card-text subtitle-login text-black-50 pb-1">Preencha seus dados de acesso!</p>
                            <div class="input-group mt-2 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLogin" type="text" value="sup.windx@gmail.com" class="form-control inputs-login" name="login"
                                       placeholder="Seu login"
                                       aria-label="Login" aria-describedby="login">
                            </div>
                            <small class="text-danger mt-2 login_error"></small>
                            <div class="input-group mt-2">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" value="Wdx@1234567890" class="form-control inputs-login" name="password"  placeholder="Sua senha" aria-label="Password"
                                       aria-describedby="password">
                            </div>
                            <small class="text-danger mt-2 password_error"></small>
                            @include('include.captcha')
                            <div class="text-right my-3">
                                <a href="{{route('central.forgot.password')}}" class="card-link text-primary open_reset_password">Esqueceu a senha?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-block" >Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
    @if ($errors->has('document'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: `{{$errors->first('document')}}`,
                timer: 5000,
                showConfirmButton: false,
            });
        </script>
    @elseif(session('error'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            Swal.fire({
                icon: 'error',
                title: 'Ops!',
                text: `{{session('error')}}`,
                timer: 5000,
                showConfirmButton: false,
            });
        </script>
    @elseif(session('success'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            Swal.fire({
                icon: 'success',
                title: `{{session('success')}}`,
                timer: 5000,
                showConfirmButton: false,
            });
        </script>
    @endif
@endsection
