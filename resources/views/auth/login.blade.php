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
                <div class="card form-signin p-4 d-none" style="border-radius: 1rem">
                    <form id="form_login" method="POST" class="d-none_ panel" action="{{ Route('central.logon') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="font-size: 2rem; color: #002046;">Central do Assinante</h2>
                            <h3 style="font-size: 1.5rem; color: #002046;">Login</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            <p class="card-text text-black-50 pb-1">Preencha seus dados de acesso!</p>
                            <div class="input-group mt-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLogin" type="text" value="sup.windx@gmail.com" class="form-control inputs-login" name="login"
                                       placeholder="Seu login"
                                       aria-label="Login" aria-describedby="login">
                            </div>
                            <small class="text-danger mt-3 login_error"></small>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" value="Wdx@1234567890" class="form-control inputs-login" name="password"  placeholder="Sua senha" aria-label="Password"
                                       aria-describedby="password">
                            </div>
                            <small class="text-danger mt-3 password_error"></small>
                            <div class="text-right mt-3">
                                <a href="#" class="card-link text-primary open_reset_password">Esqueceu a senha?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Entrar</button>
                        </div>
                    </form>
                    <form style="display: none" id="form_reset_password" method="POST" action="{{ Route('central.forgot.password') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="font-size: 2rem; color: #002046;">Central do Assinante</h2>
                            <h3 style="font-size: 1.5rem; color: #002046;">Lembrar senha</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            <p class="card-text text-black-50 pb-1">
                                Preencha seu e-mail de cadastro<br>
                                e lhe enviaremos um link <br>para gerar sua nova senha!
                            </p>
                            <div class="input-group mt-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLoginReset" type="text" class="form-control inputs-login"
                                       name="login" placeholder="Seu login" aria-label="Login" aria-describedby="login">
                            </div>
                            <small class="text-danger mt-3 login_reset_error"></small>
                            <div class="text-right mt-3">
                                <a href="#" class="card-link text-primary close_reset_password">Voltar ao login?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-send-mail" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Enviar</button>
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
            $('.full-screen-splash').addClass('d-none')
            let session = `{{session('error')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro '+400+'!',
                text: session,
                timer: 7000
            });
        </script>
    @elseif(session('success'))
        <script>
            $('.full-screen-splash').addClass('d-none')
            let session = `{{session('success')}}`;
            Swal.fire({
                icon: 'success',
                title: session,
                timer: 5000,
                showConfirmButton: false,
            });
        </script>
    @endif
@endsection
