@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <div id="infoCustomerActive" class="d-flex col-12 order-0 px-lg-0 px-md-1 mb-2">
                        <a href="{{route('central.home')}}" class="btn btn-secondary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path style="fill:white !important;" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Voltar
                        </a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-call">
                            Novo atendimento
                        </button>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-striped display list-calls text-uppercase">
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" id="new-call" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title">Novo atendimento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body text-left pb-0">
                            <form id="form-new-call" name="form-new-call">
                                <div class="form-group">
                                    <ul id="form-errors"></ul>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="call-subject">Assunto</label>
                                    <input type="text" class="form-control"
                                           id="assunto" name="assunto" placeholder="DIGITE O ASSUNTO">

                                    <input type="hidden" class="form-control"
                                           id="call-type" name="tipo" value="RETORNAR">
                                </div>

                                <div class="form-group">
                                    <label for="call-description">Descrição:</label>
                                    <textarea class="form-control "
                                              id="text" rows="5" name="texto"
                                              placeholder="DESCREVA SUA DÚVIDA OU SOLICITAÇÃO"></textarea>
{{--                                    <small id="error_descricao" class="text-danger">Erro na descrição</small>--}}
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" role="dialog" id="call-details" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header"><h5 class="modal-title">Número O.S.: <span id="call_numero_os"></span> - Detalhes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item">
                                    <h6>Status: </h6>
                                    <span id="call_status" class="text-uppercase"></span>
                                </li>
                                <li class="list-group-item">
                                    <h6>Funcionário: </h6>
                                    <span id="call_desc_funcionario"></span>
                                </li>
                                <li class="list-group-item">
                                    <h6>Data - Hora: </h6>
                                    <span id="call_created_at"></span>
                                </li>
                                <li class="list-group-item">
                                    <h6>Assunto: </h6>
                                    <span id="call_descricao"></span>
                                </li>
                                <li id="li_call_operador" class="list-group-item d-none">
                                    <h6>Operador: </h6>
                                    <span id="call_fechado_por" class="text-uppercase"></span>
                                </li>
                                <li class="list-group-item">
                                    <h6>Histórico: </h6>
                                    <span id="call_historico" class="text-uppercase"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>

        div#call-details li.list-group-item {
            display: flex;
            justify-content: left;
            text-align: left;
            border: none;

        }

        div#call-details li.list-group-item h6 {
            /*font-weight: bold;*/
            color: #002046;
            padding-right: .5rem;
            padding-top: 3px;
        }

        #call-details .list-group-item span {
            color: #6f777e;
        }

        #infoCustomerActive {
            border-top-right-radius: .5rem;
            border-top-left-radius: .5rem;
        }

        #infoCustomerActive p {
            font-size: 80%;
            margin: 0 auto
        }

        .bottom, .top {
            font-weight: bold;
            display: flex;
            justify-content: center;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td {
            padding: 1rem 0 !important;
        }

        table.dataTable.dtr-inline.collapsed > tbody > tr > td.child,
        table.dataTable.dtr-inline.collapsed > tbody > tr > th.child,
        table.dataTable.dtr-inline.collapsed > tbody > tr > td.dataTables_empty {
            text-align: left !important;
            padding: 1rem !important;
        }

        div.dataTables_processing {
            background-color: rgba(255, 255, 255, 0.6);
            padding: 2rem !important;
            border-radius: .4rem;
            font-weight: bold;
            top: 35% !important;
        }

        .dataTables_wrapper {
            min-height: 200px !important;
        }

        @media (max-width: 575.98px) {
            .header-page {
                display: none !important;
            }
        }

        @media (max-width: 991.98px) {
            .sideMenu {
                max-width: 80% !important;
            }
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script type="text/javascript" defer  src="{{ asset('assets/js/moment.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $(function () {
                var billet = '';
                var table = $('.list-calls').DataTable({
                    dom: '<"top"i>rt<"bottom"p><"clear">',
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    ajax: "",
                    {{--ajax: "{{ route('central.support.list') }}",--}}
                    columnDefs: [
                        {
                            // targets: [0],
                            visible: false,
                            searchable: false,
                            pageLength : 5,
                            lengthMenu: [[5, 10], [5, 10]],
                            className: 'dtr-control arrow-right',
                            orderable: false,
                            // target: -1
                        }
                    ],
                    columns: [
                        {data: 'id', name: 'id', title: 'ID'},
                        // {data: 'rsocial', name: 'rsocial', title: 'Nome / Razão Social'},

                        {data: 'numero_os', name: 'numero_os', title: 'Número', render: function(data, type, full, meta) {
                                return parseInt(data, 10);
                            }},
                        {data: 'dt_abertura', name: 'dt_abertura', title: 'Data', render: function(data, type, full, meta) {
                            // console.log(data)
                                var opening = new Date(data);
                                return opening.toLocaleString().substr(0, 10);
                                // return opening;
                                // return data;
                            }},
                        {data: 'h_abertura', name: 'h_abertura', title: 'Hora'},
                        {data: 'id_tatendimento', name: 'id_tatendimento', title: 'Tipo', render: function(data, type, full, meta) {
                                return 'RETORNAR';
                            }},
                        {data: 'descricao', name: 'descricao', title: 'Assunto', render: function(data, type, full, meta) {
                                return data;
                            }},
                        {data: 'fechado_por', name: 'fechado_por', title: 'Situação', render: function(data, type, full, meta) {
                                    return data === '' ? 'ABERTO' : 'FECHADO';
                            }},
                        // {data: 'valor_total', name: 'valor_total', title: 'Valor', render: function(data, type, full, meta) {
                        //         let valor = parseFloat(data) / 100;
                        //         return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                        //     }},
                        {data: 'action', name: 'action', title: 'Detalhes', orderable: false, searchable: false},
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                    },
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    responsive: true,
                    order: [2, 'desc']                    // rowCallback: function(row, data, index) {,
                    //     var statusCell = table.cell(index, 'status:name');
                    //     var statusText = statusCell.data();
                    //     if (statusText === 'approved') {
                    //         $(row).find('td.status').css('color', 'green'); // Altere a cor desejada
                    //     } else {
                    //         $(row).find('td.status').css('color', 'gray'); // Altere a cor desejada
                    //     }
                    // }
                });

                $('.list-calls').on('click', '.call-viewer', function() {
                    var rowData = table.row($(this).closest('tr')).data(); // Captura os dados da linha
                    var data = $(this).closest('tr').data('call'); // Recupera os dados do atributo data-call
                    var opening = new Date(rowData.dt_agendamento);

                    $('#call_status').text(rowData.fechado_por === '' ? 'ABERTO' : 'FECHADO');
                    $('#call_numero_os').text(rowData.numero_os);
                    $('#call_desc_funcionario').text(rowData.desc_funcionario);
                    $('#call_created_at').text(opening.toLocaleString().substr(0, 10) +' - '+rowData.h_agendamento);
                    $('#call_descricao').text(rowData.descricao);
                    if(rowData.fechado_por != ''){
                        $('#li_call_operador').removeClass('d-none');
                        $('#call_fechado_por').text(rowData.fechado_por);
                    }
                    $('#call_historico').text(rowData.historico);

                    $('#call-details').modal('show');
                });
            });
        });

        // function callViewer(btn){
        //     var call = $('#'+btn).data('call')
        //     console.log(btn, call);
        // }
        //
        // $("#getclick").on('click', function() {
        //     console.log($(this).attr('data-call'))
        // });

        //
        // const el = document.querySelector(".call-viewer");
        // const dataId = el.getAttribute("data-call");
        // console.log(dataId);

        //support.new

        document.getElementById('form-new-call').onsubmit = function (event) {
            const form = event.target;
            event.preventDefault();
            const formData = new FormData(form);
            const url = '{{ route('central.support.new') }}';
            event.preventDefault();
            axios.request({
                method: "post",
                url: url,
                data: formData
            }).then(function (response) {
                //....
                swal.fire({
                    title: 'Sucesso!',
                    text: 'Beleza',
                    type: 'success',
                    confirmButtonText: 'Fechar'
                });
            }).catch(function (error) {
                let inputs, errors, li, ul = form.querySelector('ul#form-errors');
                if (error.response.status === 422) {
                    errors = error.response.data.errors;
                    ul.innerHTML = '';
                    inputs = form.getElementsByTagName("input");
                    for (let error in errors) {
                        errors[error].forEach(message => {
                            li = document.createElement("li");
                            li.className = 'error';
                            li.innerText = message;
                            ul.appendChild(li)
                        });
                        inputs[error].className = 'error';
                    }
                }
            });
        }


        $('#form-new-call_').on("submit", function (e){
            e.preventDefault();
            var formData = new FormData(this);
            var url = '{{ route('central.support.new') }}';

            axios.post(url, formData)
                .then(function () {
                    // se tudo der certo, o prato vai ser criado!
                    console.log('Ok! Atualizar data table');
                    swal.fire({
                        title: 'Sucesso!',
                        text: 'Beleza',
                        type: 'success',
                        confirmButtonText: 'Fechar'
                    });

                })
                // .catch(function (error) {
                //     const errors                =   error.response.data.errors;
                //     const firstItem             =   Object.keys(errors)[0];
                //
                //     console.log(firstItem)
                //
                //     const firstItemDOM          =   $("#"+firstItem);
                //     console.log(firstItemDOM)
                //     const firstErrorMessage     =   errors[firstItem][0];
                //
                //     swal.fire({
                //         title: 'Erro!',
                //         text: 'Deu ruim',
                //         type: 'error',
                //         confirmButtonText: 'Fechar'
                //     });
                //
                //     // scroll to the error messsage
                //     // firstItemDOM.scrollIntoView({ behavior: 'smooth' });
                //
                //     // remove all error messages
                //     const errorMessages         =   document.querySelectorAll('.text-danger');
                //     errorMessages.forEach((element) => element.textContent = '');
                //
                //     // show error message
                //     firstItemDOM.insertAdjacentHTML('afterend', `<small class="text-danger">${firstErrorMessage}</small>`);
                //
                //     // remove all from controls with highlited errors text bos
                //     const formControls          =   document.querySelectorAll('.form-control');
                //     formControls.forEach((element) => element.classList.remove('border', 'border-danger'));
                //
                //     // highlight the form control with the error
                //     firstItemDOM.classList.add('border', 'border-danger');
                //     // console.log(error)
                // });

        .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
                console.log(errorObject);
                dispatch(authError(errorObject.response.data.error));
            })





            // const formData = $(this).serializeArray();
            // const formData = $(this).serializeArray()
            // console.log(formData.get('_token'))

            // $.ajax({
            //     type: 'POST',
            //     url: url,
            //     data: formData ,
            //     processData: false,
            //     contentType: false
            //
            // }).done(function (data) {
            //     console.log(data);
            // }).fail(function (xhr, status, error) {
            //
            //     const responseText = xhr.responseText;
            //     try {
            //         const errorData = JSON.parse(responseText);
            //
            //         if (Array.isArray(errorData.errors)) {
            //             console.log("Houve mais de um erro:");
            //             errorData.errors.forEach(function (errorMessage) {
            //                 console.log(errorMessage);
            //             });
            //         } else {
            //             console.log("Erro único:", errorData.error, errorData);
            //         }
            //     } catch (e) {
            //         console.log("Resposta não está em formato JSON:", responseText);
            //     }
            // });

            {{--fetch('{{ route('central.support.new') }}', {--}}
            {{--    method: 'POST',--}}
            {{--    headers: {--}}
            {{--        'Accept': 'application/json, text/plain, */*',--}}
            {{--        'Content-Type': 'application/json',--}}
            {{--        'X-CSRF-TOKEN': formData.get('_token')--}}
            {{--    },--}}
            {{--    body: formData--}}
            {{--}).then(res => res.json())--}}
            {{--    .then(res => console.log(res));--}}
        })

    </script>
@endsection
