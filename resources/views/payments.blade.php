@extends('layouts.app')

@section('content')
    <div>
        <section>
            <div class="container-fluid mt-lg-5 mt-md-0">
                <div class="row contents p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <div class="col-12">
                        <table class="table table-bordered table-striped display list-payments text-uppercase">
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" tabindex="-1" role="dialog" id="payments-details" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header"><h5 class="modal-title">Pagamento nº <span id="details_payment_id"></span> - Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <ul class="list-group list-group-flush ">
                        <li class="list-group-item d-flex justify-content-between">
                            <h6>Cliente</h6>
                            <span id="details_payment_customer" class="text-right">
                                {{session('customer')->full_name}}
                                ({{session('customer')->id}})
                            </span>
                        </li>
                        <li class="list-group-item">
                            <h6>Referência</h6>
                            <span id="details_payment_reference"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Data / Hora</h6>
                            <span id="details_payment_created_at"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Faturas (Nosso Nº) </h6>
                            <span id="details_payment_billets"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Método de pagamento</h6>
                            <span id="details_payment_type" class="text-uppercase"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Modalidade:</h6>
                            <span id="details_payment_modality" class="text-uppercase"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Valor</h6>
                            <span id="details_payment_value"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Juros + Multa</h6>
                            <span id="details_payment_fees"></span>
                        </li>
                        <li class="list-group-item">
                            <h6>Valor total</h6>
                            <b><span id="details_payment_amount" class="text-detach"></span></b>
                        </li>
                        <li class="list-group-item">
                            <h6>Status</h6>
                            <b>
                                <i id="spinner-status-details" class="fas fa-spinner mt-2 fa-pulse d-none"></i>
                                <span id="details_payment_status" class="text-detach text-uppercase"></span>
                            </b>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <style>
        .bottom, .top {
            font-weight: bold;
            display: flex;
            justify-content: center;
        }

        /*table.dataTable > tbody > tr {*/
        /*    min-height: 200px !important;*/
        /*}*/

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

    </style>
@endsection

@section('js')
{{--    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script type="text/javascript" defer  src="{{ asset('assets/js/moment.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        function printStatus(status)
        {
            var status_out;

            switch (status)
            {
                case 'created':
                    status_out = '<span class="text-secondary">Criado</span>';
                    break;
                case 'approved':
                    status_out = '<span class="text-success">Aprovado</span>';
                    break;
                case 'refused':
                    status_out = '<span class="text-danger">Recusado</span>';
                    break;
                case 'canceled':
                    status_out = '<span class="text-danger">Cancelado</span>';
                    break;
            }
            return status_out;
        }

        $('.btn-payment-get-details').click(function (){
            $('.loading-get-info').removeClass('d-none')
            $('#spinner-status-details').removeClass('d-none')

            var paymentID = $(this).data('payment')
            var url = base_url+"callback/"+ paymentID
            var jsonData

            var row = $(this).closest('tr');
            var status = row.find('td:nth-child(8)').text().trim();
            $('#details_payment_id').text(row.find('td:nth-child(1)').text().trim());
            $('#details_payment_reference').text(row.find('td:nth-child(9)').text().trim());
            $('#details_payment_created_at').text(row.find('td:nth-child(4)').text().trim());
            $('#details_payment_billets').text(row.find('td:nth-child(2)').text().trim());
            $('#details_payment_type').text(row.find('td:nth-child(6)').text().trim());
            $('#details_payment_modality').text(row.find('td:nth-child(7)').text().trim());
            $('#details_payment_value').text('R$ '+row.find('td:nth-child(10)').text().trim());
            $('#details_payment_fees').text('R$ '+row.find('td:nth-child(11)').text().trim());
            $('#details_payment_amount').text(row.find('td:nth-child(5)').text().trim());
            $('#details_payment_status').text('');

            async function logJSONData() {
                const response = await fetch(url);
                jsonData = await response.json();
                if(jsonData.status == 'created'){
                    $('.loading-get-info').addClass('d-none')
                    $('#spinner-status-details').addClass('d-none')
                    $('#details_payment_status').html(printStatus(jsonData.status));
                }
            };
            logJSONData()
        });

        {{--const urlCoupons = '{{route('central.coupons')}}'--}}
        {{--fetch(urlCoupons)--}}
        {{--    .then((response) => {--}}
        {{--        var obj1 = JSON.parse(JSON.stringify(response));--}}
        {{--        obj1 = '{ "data": ' + obj1 + '}'; //reformat obj1 to pass to  datatable--}}
        {{--        // console.log('Data: ', data, typeof obj)--}}
        {{--        // console.log('Details: ', data.id)--}}
        {{--        --}}
        {{--    })--}}
        {{--    // .then((data) => {--}}
        {{--    //--}}
        {{--    // });--}}

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
                        {data: 'billets', name: 'billets', title: 'Faturas | vencimento | Valor | Multa + Juros', render: function(data, type, full, meta) {
                                var billetsHTML = '';
                                if (Array.isArray(data)) {
                                    billetsHTML = '<ul style="list-style: none">';
                                    data.forEach(function(billet) {
                                        console.log(billet)
                                        billetsHTML += '<li>' + billet.reference
                                            +' | '+ billet.duedate
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
                                    case 'picpay':
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
                    rowCallback: function(row, data, index) {
                        var statusCell = table.cell(index, 'status:name');
                        var statusText = statusCell.data();
                        console.log(statusText);

                        if (statusText === 'approved') {
                            $(row).find('td.status').css('color', 'green'); // Altere a cor desejada
                        } else {
                            $(row).find('td.status').css('color', 'gray'); // Altere a cor desejada
                        }
                    }
                });
            });
        });

        $('.download-pdf').on('click', function (e){
            e.preventDefault();
            alert('olá mundo!')
        })
    </script>
@endsection
