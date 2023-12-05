@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <nav id="infoCustomerActive" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comprovantes</li>
                        </ol>
                    </nav>
                    <div class="header-app col-12 font-weight-bolder text-left" style="display: none">
                        {{$header}}
                    </div>
                    <div class="container-list-table col-12">
                        <table class="table table-bordered table-striped display list-payments text-uppercase">
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
                var billet = '';
                var table = $('.list-payments').DataTable({
                    dom: '<"top"i>rt<"bottom"p><"clear">',
                    pagingType: 'full_numbers',
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('central.coupons') }}",
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
                        {data: 'billets', name: 'billets', title: 'Faturas | vencimento | Valor | Multa + Juros', render: function(data, type, full, meta) {
                                var billetsHTML = '';
                                if (Array.isArray(data)) {
                                    billetsHTML = '<ul style="list-style: none">';
                                    data.forEach(function(billet) {
                                        billetsHTML += '<li>' + billet.reference
                                            +' | '+ moment(billet.duedate).utc().format('DD/MM/YYYY')
                                            +' | R$ '+ billet.value.toLocaleString('pt-br', {minimumFractionDigits: 2})
                                            +' | R$ '+billet.addition.toLocaleString('pt-br', {minimumFractionDigits: 2})
                                             +'</li>';
                                    });
                                    billetsHTML += '</ul>';
                                }
                                return billetsHTML;
                            }},
                        {data: 'amount', name: 'amount', title: 'Valor pago', render: function(data, type, full, meta) {
                                return 'R$ ' + data.replace(".", ",");
                            }
                        },
                        {data: 'payment_type', name: 'payment_type', title: 'Modalidade', render: function(data, type, full, meta) {
                                var paymentType = '';
                                switch (data) {
                                    case 'pix':
                                        paymentType = "pix";
                                        break;
                                    case null:
                                        paymentType = "picpay";
                                        break;
                                    case 'debit':
                                        paymentType = "Débito";
                                        break;
                                    case 'credit':
                                        paymentType = "Crédito";
                                        break;
                                }
                                return paymentType;
                            }},
                        {data: 'created_at', name: 'created_at', title: 'Data, Hora', render: function(data, type, full, meta) {
                                var pay = new Date(data);
                                return pay.toLocaleString();
                            }},
                        {data: 'status', name: 'status', title: 'Status', render: function(data, type, full, meta) {
                                var state = '';
                                switch (data) {
                                    case 'created':
                                        state = "Criado";
                                        break;
                                    case 'approved':
                                        state = "Aprovado";
                                        break;
                                    case 'canceled':
                                        state = "Cancelado";
                                        break;
                                    case 'refused':
                                        state = "Recusado";
                                        break;
                                }
                                return state;
                            }},
                        {data: 'action', name: 'action', title: '2ª via (download)', orderable: false, searchable: false},
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                    },
                    orderable: false,
                    searchable: false,
                    sortable: false,
                    responsive: true,
                    order: [0, 'desc'],
                    rowCallback: function(row, data, index) {
                        var statusCell = table.cell(index, 'status:name');
                        var statusText = statusCell.data();
                        if (statusText === 'approved') {
                            $(row).find('td.status').css('color', 'green'); // Altere a cor desejada
                        } else {
                            $(row).find('td.status').css('color', 'gray'); // Altere a cor desejada
                        }
                    }
                });
            });
        });
    </script>
@endsection
