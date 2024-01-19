@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <nav id="infoCustomerActive" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notas fiscais</li>
                        </ol>
                    </nav>
                    <div class="header-app col-12 font-weight-bolder text-left" style="display: none">
                        {{$header}}
                    </div>
                    <div class="container-list-table col-12">
                        <table class="table list-payments text-uppercase">
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
    <script type="text/javascript" defer>inactivitySession();</script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $(function () {
                $.fn.DataTable.ext.errMode = 'none';

                var billet = '';
                var table = $('.list-payments')
                    .on( 'error.dt', function ( e, settings, techNote, message ) {
                        console.log( 'An error has been reported by DataTables: ', message );
                    } )
                    .DataTable({
                    dom: '<"top"i>rt<"bottom"p><"clear">',
                    pagingType: 'simple',
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url:"{{ route('central.invoices.list') }}",
                        type: "GET"
                    },
                    columnDefs: [
                        {
                            visible: false,
                            searchable: false,
                            pageLength : 5,
                            lengthMenu: [[5, 10], [5, 10]],
                            className: 'dtr-control arrow-right',
                            orderable: false,
                        }
                    ],
                    columns: [
                        {data: 'id', name: 'id', title: 'ID'},
                        {data: 'rsocial', name: 'rsocial', title: 'Nome / Razão Social'},
                        {data: 'emissao', name: 'emissao', title: 'Data de emissão', render: function(data, type, full, meta) {
                                var year = data.substr(0, 4);
                                var month = data.substr(4, 2);
                                var day = data.substr(6, 2);

                                var formattedDate = day + "/" + month + "/" + year;
                                return formattedDate;
                            }},
                        {data: 'numero', name: 'numero', title: 'Número', render: function(data, type, full, meta) {
                                return parseInt(data, 10);
                            }},
                        {data: 'referencia', name: 'referencia', title: 'Referência', render: function(data, type, full, meta) {
                                return parseInt(data, 10);
                            }},
                        {data: 'valor_total', name: 'valor_total', title: 'Valor', render: function(data, type, full, meta) {
                                let valor = parseFloat(data) / 100;
                                return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
                            }},
                        {data: 'action', name: 'action', title: 'Download', orderable: false, searchable: false},
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                    },
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    responsive: true,
                    order: [2, 'desc']
                });
            });
        });
    </script>
@endsection
