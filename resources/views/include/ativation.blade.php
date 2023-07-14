<div class="modal fade" id="activationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                        <div class="col text-card">
                            <h3 id="uuid" class="m-4 text-danger font-weight-bold">Terminal bloqueado! {{$activate}}</h3>
                            <h4 id="text-info">Favor entrar em <br>contato com nossa <br> Central de Atendimento <br> no 0800 028
                                2309 <br>para mais informações.</h4>
                            <form method="POST" action="{{ route('terminal.unlock') }}">
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
                                    <button type="submit" name="activation" id="btn-activation" class="btn btn-primary btn-lg m-4">
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
<script></script>
