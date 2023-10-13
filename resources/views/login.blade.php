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
                                <p class="card-text text-danger pb-1">Verifique os dados informados!</p>
                            @else
                                <p class="card-text text-black-50 pb-1">Preencha seus dados de acesso!</p>
                            @endif
                            <div class="input-group mb-3 {{ $errors->has('login') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <input id="inputLogin" type="text" class="form-control inputs-login

                                @error('login') is-invalid @enderror" value="123wdf" name="login"
                                       {{--                                    @error('login') is-invalid @enderror" value="{{old('login')}}" name="login"--}}
                                       placeholder="{{ $errors->has('login') ? 'O login é obrigatório' : 'Seu login' }}"
                                       aria-label="Login" aria-describedby="login">
                            </div>
                            <div class="input-group mb-3 {{ $errors->has('password') ? 'is-error' : '' }}">
                                <div class="input-group-prepend">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </div>
                                <input id="inputPassword" type="password" class="form-control inputs-login

                                @error('password') is-invalid @enderror" value="1234"
                                       {{--                                    @error('password') is-invalid @enderror" value="{{old('password')}}"--}}
                                       name="password"  placeholder="{{ $errors->has('password') ? 'A senha é obrigatória' : 'Sua senha' }}" aria-label="Password"
                                       aria-describedby="password">
                            </div>
                            <div class="text-right">
                                <a href="#" class="card-link text-muted open_reset_password">Esqueceu a senha?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Entrar</button>
                        </div>
                    </form>
                    <form id="form_reset_password" method="POST" action="{{ Route('central.logon') }}">
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

                                @error('login') is-invalid @enderror" value="supwindx@gmail.com" name="login"
                                       {{--                                    @error('login') is-invalid @enderror" value="{{old('login')}}" name="login"--}}
                                       placeholder="{{ $errors->has('login') ? 'O login é obrigatório' : 'Seu login' }}"
                                       aria-label="Login" aria-describedby="login">

                            </div>
                            <div class="text-right">
                                <a href="#" class="card-link text-muted close_reset_password">Voltar ao login?</a>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button id="btn-login" type="submit" class="btn btn-primary btn-load_ btn-block" style="font-size: 1rem; margin: 0">Enviar</button>
                        </div>
                    </form>
                </div>
                <div class="d-none scene scene--card">
                    <div class="card-login {{ ($errors->has('document') ? 'is-flipped' : (session('error') != null ? 'is-flipped' : '')) }}">
                        <div class="card__face card__face--front">
                            <div class="card">
                                <div class="card-header">Central do Assinante<br></div>
                                <div class="card-body">
                                    <p class="card-text">Aqui você encontra <br>os serviços: <br>Consulta de débitos, pagamento de faturas e informações de seu cadastro.</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-flip btn-block btn-radius-50" >Iniciar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card card__face card__face--back">

                            <div class="d-none playground form-signin">
                                <div class="numpad">
                                    <div class="content">
                                        <input id="input-document" class="w-100 input-document @error('document') is-invalid @enderror"
                                               name="document"  placeholder="Digite seu CPF ou CNPJ"
                                               type="text" aria-label="Documento" aria-describedby="Documento" readonly="true">
                                    </div>
                                    <button type="button" class="button btn num-pad">1</button>
                                    <button type="button" class="button btn num-pad">2</button>
                                    <button type="button" class="button btn num-pad">3</button>
                                    <button type="button" class="button btn num-pad">4</button>
                                    <button type="button" class="button btn num-pad">5</button>
                                    <button type="button" class="button btn num-pad">6</button>
                                    <button type="button" class="button btn num-pad">7</button>
                                    <button type="button" class="button btn num-pad">8</button>
                                    <button type="button" class="button btn num-pad">9</button>
                                    <button type="button" id="clear" class="button btn btn btn-danger">
                                        <i class="fas fa-times" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="button btn num-pad">0</button>
                                    <button type="submit" id="check-login_" class="button btn btn-success">
                                        <i class="fas fa-check" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('js')
{{--    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>--}}
<script>
    $('#form_reset_password').hide();
    $('.open_reset_password').click(function() {
        $('#form_login').fadeOut().hide();
        $('#form_reset_password').fadeIn(300).show();
    });

    $('.close_reset_password').click(function() {
        $('#form_reset_password').fadeOut().hide();
        $('#form_login').fadeIn(300).show();
    });
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
