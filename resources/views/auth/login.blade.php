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
                @if ($errors->has('login') || $errors->has('password') || session('error'))
                <div class="card form-signin p-4 animate__animated animate__shakeX" style="border-radius: 1rem">
                @else
                <div class="card form-signin p-4 animate__animated animate__fadeInUp" style="border-radius: 1rem">
                @endif
                    <form id="form_login" method="POST" class="d-none_ panel" action="{{ Route('central.logon') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="font-size: 2rem; color: #002046;">Central do Assinante</h2>
                            <h3 style="font-size: 1.5rem; color: #002046;">Login</h3>
{{--                            <p style="font-size: 2rem; color: #002046;">Central do Assinante</p>--}}
{{--                            <p style="font-size: 1.2rem; color: #002046;"></p>Login<br>--}}
{{--                            PHP: {{ phpversion() }}<br>--}}
{{--                            Laravel: {{ app()->version() }}--}}
                        </div>
                        <div class="card-body">
                            @csrf

                            @if ($errors->has('login') || $errors->has('password') || session('error'))
                                <p class="card-text text-danger font-weight-bold pb-1">Verifique os dados informados!</p>
                            @else
                                <p class="card-text text-black-50 pb-1">Preencha seus dados de acesso!</p>
                            @endif
                            <div class="input-group mt-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLogin" type="text" class="form-control inputs-login

                                @error('login') is-invalid @enderror" value="sup.windx@gmail.com" name="login"
                                       {{--                                    @error('login') is-invalid @enderror" value="{{old('login')}}" name="login"--}}
                                       placeholder="{{ $errors->has('login') ? 'O login é obrigatório' : 'Seu login' }}"
                                       aria-label="Login" aria-describedby="login">

                            </div>
                            <small class="text-danger mt-3 login_error"></small>
                            <div class="input-group mt-3 {{ $errors->has('password') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" class="form-control inputs-login

                                @error('password') is-invalid @enderror" value="Wdx@1234567890"
                                       {{--                                    @error('password') is-invalid @enderror" value="{{old('password')}}"--}}
                                       name="password"  placeholder="{{ $errors->has('password') ? 'A senha é obrigatória' : 'Sua senha' }}" aria-label="Password"
                                       aria-describedby="password">

                            </div>
{{--                            <div class="input-group mb-3" style="background-color: transparent; border: none">--}}
                            <small class="text-danger mt-3 password_error"></small>
{{--                            </div>--}}
                            <div class="text-right mt-3">
                                <a href="#" class="card-link text-primary open_reset_password">Esqueceu a senha?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Entrar</button>
                        </div>
                    </form>
                    <form style="display: none" id="form_reset_password" method="POST" action="{{ Route('central.login.check.mail') }}">
                        <div class="card-header font-weight-bold" style="padding-top: 0">
                            <h2 style="font-size: 2rem; color: #002046;">Central do Assinante</h2>
                            <h3 style="font-size: 1.5rem; color: #002046;">Lembrar senha</h3>
                            {{--                            <p style="font-size: 1.2rem; color: #002046;"></p>Login<br>--}}
                            {{--                            PHP: {{ phpversion() }}<br>--}}
                            {{--                            Laravel: {{ app()->version() }}--}}
                        </div>
                        <div class="card-body">
                            @csrf

                            @if ($errors->has('login') || $errors->has('password') || session('error'))
                                <p class="card-text text-danger pb-1">Verifique os dados informados!</p>
                            @else
                                <p class="card-text text-black-50 pb-1">Preencha seu e-mail de cadastro<br> e enviaremos um link <br>para gerar sua nova senha!</p>
                            @endif
                            <div class="input-group mb-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLoginReset" type="text" class="form-control inputs-login

                                @error('login') is-invalid @enderror" value="sup.windx@gmail.com" name="login"
                                       {{--                                    @error('login') is-invalid @enderror" value="{{old('login')}}" name="login"--}}
                                       placeholder="{{ $errors->has('login') ? 'O login é obrigatório' : 'Seu login' }}"
                                       aria-label="Login" aria-describedby="login">

                            </div>
                            <div class="text-right">
                                <a href="#" class="card-link text-muted close_reset_password">Voltar ao login?</a>
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
{{--    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>--}}
<script>
    $('.open_reset_password').click(function() {
        $('#form_login').fadeOut().hide();
        $('#form_reset_password').fadeIn(300).show();
    });

    $('.close_reset_password').click(function() {
        $('#form_reset_password').fadeOut().hide();
        $('#form_login').fadeIn(200).show();
    });

    $('#form_login').submit(async function (e){
        e.preventDefault();
        let formData = $(this).serializeArray()
        let url = "{{ route('central.logon') }}";
        $('#btn-login').text('Entrando...')

        console.log(formData)

        await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": formData[0].value
            },
            body: JSON.stringify({
                login: formData[1].value,
                password: formData[2].value,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if(!data.error){
                    $('#btn-login').text('Entrar')
                    $('.form-signin').removeClass('animate__fadeInUp').addClass('animate__fadeOutUp')
                    location.href = `{{ route('central.home') }}`;
                }else{
                    $('#btn-login').text('Entrar')
                    $('.form-signin').removeClass('animate__fadeInUp').addClass('animate__shakeX')

                    if(data.error.login){
                        $('small.login_error').text(data.error.login)
                    }

                    if(data.error.password){
                        $('small.password_error').text(data.error.password)
                    }
                    $('.form-signin').removeClass('animate__shakeX').addClass('animate__fadeInUp')

                    if(data.error){
                        Swal.fire({
                            title: data.error,
                            icon: 'error',
                            timer: 4000,
                            timerProgressBar: false,
                            showCloseButton: true,
                        })
                    }
                }
            })
            .catch((error) => {
                $('#btn-login').text('Entrar')
                Swal.fire({
                    icon: 'error',
                    title: 'Ops!',
                    html: error.message,
                    willClose: () => {
                        $('#inputLoginReset').val('')
                    }
                })
            });
    })

    $('#form_reset_password').submit(async function (e){
        e.preventDefault();
        let formData = $(this).serializeArray()
        let url = "{{ route('central.login.check.mail') }}";
        $('#btn-send-mail').text('Enviando...')

        await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": formData[0].value
            },
            body: JSON.stringify({login: formData[1].value}),
        })
            .then((response) => response.json())
            .then((data) => {
                if(!data.error){
                    $('#btn-send-mail').text('Enviar')
                    Swal.fire({
                        icon: 'success',
                        title: 'Enviado com sucesso!',
                        html: data.message,
                        timer: 4000,
                        timerProgressBar: false,
                        showConfirmButton: false,
                        willClose: () => {
                            location.reload()
                        }
                    })
                }else{
                    $('#btn-send-mail').text('Enviar')
                    Swal.fire({
                        title: data.error,
                        text: data.message,
                        icon: 'warning',
                        confirmButtonColor: '#208637',
                        confirmButtonText: 'Central de Atendimento',
                        showCloseButton: true,
                        willClose: () => {
                            window.location.reload()
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                        }
                    })
                }
            })
            .catch((error) => {
                $('#btn-send-mail').text('Enviar')
                Swal.fire({
                    icon: 'error',
                    title: 'Ops!',
                    html: error.message,
                    willClose: () => {
                        $('#inputLoginReset').val('')
                    }
                })
            });
    })
</script>

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
    @elseif(session('success'))
        <script>
            let session = `{{session('success')}}`;
            Swal.fire({
                icon: 'success',
                title: session,
                timer: 5000
            });
        </script>
    @endif
@endsection
