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
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered table-striped display list-calls text-uppercase">
                        </table>
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
    <script>
        $(document).ready(function() {
            $(function () {
                var billet = '';
                var table = $('.list-calls').DataTable({
                    dom: '<"top"i>rt<"bottom"p><"clear">',
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('central.support.list') }}",
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
                        {data: 'dt_abertura', name: 'dt_abertura', title: 'Data / Hora', render: function(data, type, full, meta) {
                            console.log(data)
                                var opening = new Date(data);
                                return opening.toLocaleString();
                                // return opening;
                                // return data;
                            }},
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
                        {data: 'action', name: 'action', title: 'Download', orderable: false, searchable: false},
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
                    // var parsedData = JSON.parse(data); // Converte a string JSON em um objeto JavaScript

                    // Agora você pode usar os dados para exibir as informações ou fazer o que for necessário
                    console.log(rowData.desc_funcionario);

                });
            });
        });

        // function callViewer(btn){
        //     var call = $('#'+btn).data('call')
        //     console.log(btn, call);
        // }
        //
        // $("a[data-call]").click(function() {
        //     console.log('foi')
        // });


    </script>
@endsection
