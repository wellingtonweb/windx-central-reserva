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
                <div class="card form-signin p-4 animate__animated animate__fadeInUp" style="border-radius: 1rem">
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
                                <input id="inputLogin" type="text" class="form-control inputs-login" name="login"
                                       placeholder="Seu login"
                                       aria-label="Login" aria-describedby="login">
                            </div>
                            <small class="text-danger mt-3 login_error"></small>
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" class="form-control inputs-login" name="password"  placeholder="Sua senha" aria-label="Password"
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
        $('#btn-login').text('Verificando...')

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
                if(data.message === 'authorized'){
                    $(this)[0].reset();
                    $('#btn-login').text('Entrar')

                    $('.form-signin').removeClass('animate__fadeInUp').addClass('animate__fadeOutUp')
                    $('.loader').removeClass('d-none');
                    location.href = `{{ route('central.home') }}`;
                }else{
                    $('#btn-login').text('Entrar')
                    shakeError('form-signin')

                    if(data.error.login){
                        $('small.login_error').text(data.error.login)
                    }

                    if(data.error.password){
                        $('small.password_error').text(data.error.password)
                    }

                    if(data.null){
                        Swal.fire({
                            title: data.null,
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
                shakeError('form-signin')
                Swal.fire({
                    title: 'Ops, login não cadastrado!',
                    text: 'Solicite seu cadastro em nossa Central de Atendimento.',
                    icon: 'warning',
                    confirmButtonColor: '#208637',
                    confirmButtonText: 'Central de Atendimento',
                    showCloseButton: true,
                    willClose: () => {
                        $(this)[0].reset();
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                    }
                })
            });
    })

    $('#form_reset_password').submit(async function (e){
        e.preventDefault();
        let formData = $(this).serializeArray()
        let url = "{{ route('central.forgot.password') }}";
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
                        didOpen: () => {
                            $(this)[0].reset();
                        },
                        willClose: () => {
                            $('.close_reset_password').click()
                        }
                    })
                }else{
                    $('#btn-send-mail').text('Enviar')
                    shakeError('form-signin')
                        // console.log(data.error);
                    $('small.login_reset_error').text(data.error)
                    $('#inputLoginReset').addClass('is-invalid');

                    if(data.message){
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
                }
            })
            .catch((error) => {
                $('#btn-send-mail').text('Enviar - Catch')
                shakeError('form-signin')
                Swal.fire({
                    title: 'Ops, login não cadastrado!',
                    text: 'Solicite seu cadastro em nossa Central de Atendimento.',
                    icon: 'warning',
                    confirmButtonColor: '#208637',
                    confirmButtonText: 'Central de Atendimento',
                    showCloseButton: true,
                    willClose: () => {
                        $(this)[0].reset();
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                    }
                })
            });
    })

    function shakeError(elementClass)
    {
        $('.'+elementClass).removeClass('animate__fadeInUp').addClass('animate__shakeX')
        setTimeout(() => {
            $('.'+elementClass).removeClass('animate__shakeX')
        }, 1000);
    }
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
