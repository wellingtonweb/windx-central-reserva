@extends('layouts.app')

@section('content')
    <main role="main" class="inner cover mt-md-3">
        <section>
            <div id="main" class="container-logon">
                <div class="modal fade" id="activationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content rounded-10 animate__animated animate__fadeIn">
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col text-card">
                                        <a href="#"><h3 id="uuid" class="m-4 text-danger font-weight-bold">Desbloqueio</h3></a>
                                        <h4 id="text-info">Favor entrar em <br>contato com nossa <br> Central de Atendimento <br> no 0800 028
                                            2309 <br>para mais informações.</h4>
                                        <form id="unlockForm" method="POST" action="{{ route('central.unlock') }}">
                                            @csrf
                                            <div id="group-active-terminal" class=" animate__animated animate__fadeIn d-none">
                                                <div class="form-group ml-5 mr-5 text-left">
                                                    <label for="terminal_id">ID do terminal</label>
                                                    <input type="text" class="form-control input-uuid @error('terminal_id') is-invalid @enderror" id="terminal_id"
                                                           aria-describedby="terminalId" name="terminal_id" value="{{ old('terminal_id') }}"
                                                           placeholder="Digite id do terminal">
                                                    @if ($errors->has('terminal_id'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('terminal_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group ml-5 mr-5 text-left">
                                                    <label for="terminal_key">Chave do terminal</label>
                                                    <input type="text" class="form-control input-uuid @error('terminal_key') is-invalid @enderror" id="terminal_key"
                                                           aria-describedby="terminalKey" name="terminal_key" value="{{ old('terminal_key') }}"
                                                           placeholder="Digite a chave de ativação">
                                                    @if ($errors->has('terminal_key'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('terminal_key') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <button type="submit" id="btn-activation" class="btn btn-primary btn-lg m-4 click-loader">
                                                    DESBLOQUEAR TERMINAL
                                                </button>
                                            </div>
                                        </form>
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

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css_old/loader.css') }}">
    <style>
        body {
            background: var(--bg-windx) !important;
        }
    </style>
@endsection

@section('js')
<script>
    @if($errors->has('terminal_id') || $errors->has('terminal_key') || session('error'))
        $('#activationModal').modal('show')
        $('#group-active-terminal').removeClass('d-none animate__animated animate__fadeOut')
    @endif

    $(document).ready(function() {
        $('#activationModal').modal('show')
        $('#uuid').dblclick(function () {
            let id = $(this).text();
            $('#input-uuid').val(id)
            // var ok = document.execCommand('copy');
            if ($('#input-uuid').focus) {
                $('#group-active-terminal').removeClass('d-none animate__animated animate__fadeOut')
                $('#text-info').addClass('d-none animate__animated animate__fadeOut')
                setTimeout(function () {
                    $('#group-active-terminal').addClass('d-none animate__animated animate__fadeOut');
                    $('#text-info').removeClass('d-none animate__animated animate__fadeOut')
                }, 60000);
            }
        });

        $('#unlockForm').submit(function (e){
            $('#activationModal').modal('hide')
            $('.loading').removeClass('d-none')
        });
    });
</script>
@endsection
