@extends('layouts.app_login')

@section('content')
<div class="full-screen-splash">
    <section>
        <article>
            <img class="animate__animated animate__zoomIn" src="{{ asset('assets/img/logox2.svg') }}"
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
                <div class="card form-signin py-4 d-none" style="border-radius: .5rem">
                    <form id="form_login" method="POST" class="panel" action="{{ Route('central.logon') }}">
                        <div class="card-header" style="padding-top: 0; ">
                            <h2>Central do Assinante</h2>
                            <h5 class="py-1">Aqui você pode fazer pagamentos, obter segunda via de faturas, notas fiscais e suporte técnico.</h5>
                        </div>
                        <div class="card-body">
                            @csrf
                            <p class="card-text subtitle-login pb-1">Preencha seus dados de acesso!</p>
                            <div class="input-group mt-2 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLogin" type="text" class="form-control inputs-login" name="login"
                                       placeholder="Seu login" autocomplete="off"
                                       aria-label="Login" aria-describedby="login">
                            </div>
                            <small id="smallErrorLogin" class="text-warning mt-2 login_error"></small>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" class="form-control inputs-login" name="password"  placeholder="Sua senha" aria-label="Password"
                                       aria-describedby="password" autocomplete="off">
                                <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password text-primary mr-2"></span>
                            </div>
                            <small id="smallErrorPassword" class="text-warning mt-2 password_error"></small>
                            <div class="text-right mt-3">
                                <a href="https://api.whatsapp.com/send?phone=558000282309&amp;text=Desejo%20falar%20com%20atendimento%20Windx!"
                                   target="_blank" class="card-link text-primary-light close_reset_password pr-1 letter-1x">
                                    Não tem os dados de acesso?</a>
                            </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-2">
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
    <script>
        $( "#inputLogin" ).on( "click", function() {
            $("#smallErrorLogin").text('');
        });
        $( "#inputPassword" ).on( "click", function() {
            $("#smallErrorPassword").text('');
        });
    </script>
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
