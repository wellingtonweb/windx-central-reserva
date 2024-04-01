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
                    <div class="header-app col-12 font-weight-bolder d-flex justify-content-between" style="display: none">
                        <a href="javascript:history.back();"><i class="fas fa-arrow-left pr-3"></i></a>
                        <span>{{$header}}</span>
                        <span class="px-3"></span>
                    </div>
                    <div class="container-list-table col-12">
                        <table class="table table-bordered_ table-striped_ display_ list-payments text-uppercase">
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="modalCouponViewer" tabindex="-1" aria-labelledby="modalCouponViewerLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none">
{{--                    <h5 class="modal-title" id="modalCouponViewerLabel">Modal title</h5>--}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="container">
                        <div class="document">
                            <div id="coupon" class="d-flex justify-content-center comprovante">
                                <div class="coupon-print-central">
                                    <div id="container-coupon" class="xpto">
                                        <table id="example" class="printer-ticket">
                                            <thead>
                                            <tr>
                                                <th class="text-center" colspan="2">
                                                    {{--                                <h2 style="text-transform: uppercase; letter-spacing: 1px "><strong>Windx Telecomunicações</strong></h2>--}}
                                                    <img style="width: 20mm !important; margin-top: 1rem"
                                                         src="https://terminal.windx.com.br/assets/img/logo2.png" class="logo pt-2">
                                                </th>
                                            </tr>
                                            <tr class="b-top" >
                                                <th class="ttu text-center" colspan="2" style="border-bottom: 1px solid #cfcfcf">
                                                    <h3 style="text-transform: uppercase; letter-spacing: 1px "><strong>Comprovante de pagamento</strong></h3>
                                                    <span style="letter-spacing: 1px; padding-top: 1rem; padding-bottom: 1rem;">(Cupom não fiscal)</span><br>
                                                    <p>
                                    <span style="color: #5b5b5b; padding-top: 1rem; padding-bottom: 1rem; font-size: 90% !important;">
{{--                                        {{ $date_time_full }}--}}
                                    </span>
                                                    </p>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr class="ttu b-top">
                                                <td class="right" style="padding-top: 1rem">Pagamento Nº: </td>
                                                <td id="coupon_reference" class="left" style="max-width: 74mm; padding-top: 1rem">
{{--                                                    {{$payment['id']}}--}}
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">Referência: </td>
                                                <td id="coupon_reference" class="left" style="max-width: 74mm">
{{--                                                    {{$payment['reference']}}--}}
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">Data Hora: </td>
                                                <td id="coupon_created_at" class="left">
{{--                                                    {!! \App\Helpers\forDates::convertDateTime($payment['created_at']) !!}--}}
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top" >
                                                <td class="right">Cliente: </td>
                                                <td id="coupon_reference-" class="left" >
                                                    <span id="coupon_customer_id">
{{--                                                        {{ $payment['customer'] }}--}}
                                                    </span>
                                                    <span class="coupon_customer_fullname">-
{{--                                                        {{ $full_name }}--}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">
{{--                                                    {{count($billets) > 1 ? 'Faturas Nº: ' : 'Fatura Nº: '}}--}}
                                                </td>
                                                <td id="coupon_billets" class="left">
{{--                                                    @foreach($billets as $info)--}}
{{--                                                        @if(count($billets) > 1)--}}
{{--                                                            {{ $info['reference'] }} {{!empty($info['duedate']) ? '('.date("d/m/Y", strtotime($info['duedate'])).'), ' : ', ' }}<br>--}}
{{--                                                        @else--}}
{{--                                                            {{ $info['reference'] }} {{!empty($info['duedate']) ? '('.date("d/m/Y", strtotime($info['duedate'])).')' : '' }}--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">Pago via: </td>
                                                <td id="coupon_method" class="left">
{{--                                                    @if(($payment['method'] == 'ecommerce' && $payment['terminal'] == null) ||--}}
{{--                                                        ($payment['method'] == 'picpay' && $payment['terminal'] == null))--}}
{{--                                                        Central do Assinante--}}
{{--                                                    @else--}}
                                                        Auto-atendimento
{{--                                                    @endif--}}
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">Modalidade: </td>
                                                <td id="coupon_payment_type" class="left">
{{--                                                    @if($payment['payment_type'] == 'credit')--}}
{{--                                                        Crédito--}}
{{--                                                    @elseif($payment['payment_type'] == 'debit')--}}
{{--                                                        Débito--}}
{{--                                                    @elseif($payment['payment_type'] == 'pix')--}}
{{--                                                        Pix--}}
{{--                                                    @else--}}
                                                        Picpay
{{--                                                    @endif--}}
                                                </td>
                                            </tr>
{{--                                            @if($payment['payment_type'] == 'credit' || $payment['payment_type'] == 'debit')--}}
{{--                                                @if(isset($payment['receipt']['card_number']))--}}
{{--                                                    <tr class="ttu b-top">--}}
{{--                                                        <td class="right">Cartão: </td>--}}
{{--                                                        <td id="coupon_card_number" class="left" style="max-width: 74mm">--}}
{{--                                                            {{ $payment['receipt']['card_number'] }}--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endif--}}
{{--                                                @if(isset($payment['receipt']['flag']))--}}
{{--                                                    <tr class="ttu b-top">--}}
{{--                                                        <td class="right">Bandeira: </td>--}}
{{--                                                        <td id="coupon_flag" class="left" style="max-width: 74mm">--}}
{{--                                                            {{ $payment['receipt']['flag'] }}--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endif--}}
{{--                                                @if(isset($payment['receipt']['payer']))--}}
{{--                                                    <tr class="ttu b-top">--}}
{{--                                                        <td class="right">Titular: </td>--}}
{{--                                                        <td id="coupon_payer" class="left" style="max-width: 74mm">--}}
{{--                                                            {{ $payment['receipt']['payer'] }}--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endif--}}
{{--                                                @if(isset($payment['receipt']['in_installments']) && $payment['receipt']['in_installments'] > 1)--}}
{{--                                                    <tr class="ttu b-top">--}}
{{--                                                        <td class="right">Acordo: </td>--}}
{{--                                                        <td id="coupon_flag" class="left" style="max-width: 74mm">--}}
{{--                                                            Parcelado em {{ $payment['receipt']['in_installments'] }}x--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                @endif--}}
{{--                                            @endif--}}
                                            <tr class="ttu b-top">
                                                <td class="right">Valor: </td>
                                                <td class="left">R$ <span id="coupon_value">
{{--                                @php--}}
{{--                                    $total = 0;--}}
{{--                                    foreach ($billets as $billet)--}}
{{--                                    {--}}
{{--                                        $total += $billet['value'];--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                                        {{number_format($total, 2, ',', '.') }}--}}
                                </span>
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top">
                                                <td class="right">Juros + Multas: </td>
                                                <td class="left">R$ <span id="coupon_fees">
{{--                                @php--}}
{{--                                    $totalAdition = 0;--}}
{{--                                    foreach ($billets as $billet)--}}
{{--                                    {--}}
{{--                                        $totalAdition += $billet['addition'];--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                                        {{number_format($totalAdition, 2, ',', '.') }}--}}
                                </span>
                                                </td>
                                            </tr>
                                            <tr class="ttu b-top pb-4" style="font-weight: bold;">
                                                <td class="right ">Valor pago: </td>
                                                <td class="left ">
                                                    R$ <span id="coupon_amount">
{{--                                      {{number_format($payment['amount'], 2, ',', '.') }}--}}
                                   </span>
                                                </td>
                                            </tr>
{{--                                            @if(isset($payment['receipt']['card_ent_mode']))--}}
{{--                                                <tr class="ttu b-top text-center ">--}}
{{--                                                    <td colspan="4" style="text-align: center; letter-spacing: 1px">--}}
{{--                                                        <p>{{ $payment['receipt']['card_ent_mode'] }}</p>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endif--}}
{{--                                            @if($payment['payment_type'] == 'pix' || $payment['method'] == 'picpay')--}}
                                                <tr class="ttu b-top text-center ">
                                                    <td colspan="4" style="text-align: center; letter-spacing: 1px">
                                                        <p style="margin-top: 1rem">FAVOR CONFERIR EM SEU <br>APLICATIVO DE PAGAMENTO</p>
                                                    </td>
                                                </tr>
{{--                                            @else--}}
{{--                                                <tr><td colspan="4"class="line-1"></td></tr>--}}
{{--                                            @endif--}}
                                            </tbody>
                                            <tfoot>
                                            <tr class="sup b-top pt-2 font-weight-bold">
                                                <td colspan="4" style="text-align: center; padding-top: .5rem; border-top: 1px solid #cfcfcf">
                                                    <b>Ouvidoria: 0800 028 2309</b></br>
                                                    <b>Financeiro: (28)3532-2309</b></br></br>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary btn-sm">Baixar</button>
                    <a href="{{ route('central.coupon.pdf', ['id' => $data['id'] ]) }} .
////                            '" data-toggle="tooltip" onclick="downloadClick()" data-original-title="Download" class="download-pdf badge badge-pill badge-primary px-3 py-2"><i class="fa fa-download pr-1"></i>BAIXAR</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/payments.css') }}">
    <style>
        @page { margin: 0; }

        body{
            background-color: #fff9f2 !important;
            color: #0a1520;
            /*margin-left: 20px;*/
        }

        #content{
            display: none;
            justify-content: center;
            margin: 0 auto;
        }
        .comprovante{
            font-family: Courier, Lucida Console,Lucida Sans Typewriter,monaco,Bitstream Vera Sans Mono,monospace;
            margin: 0;
            width: 68mm;
            font-size: .55rem !important;
            text-align: center;
            padding: .33rem;

        }

        .comprovante p{
            line-height: 12px;
        }
        .comprovante .table-coupon {
            padding-left: 10px;
            text-align: center !important;
            line-height: 15px !important;
        }

        .comprovante table tbody, .comprovante table tfoot{
            line-height: 15px;
        }

        .line-1{
            padding-top: 1rem !important;
        }

        .line-1-5{
            padding-top: 1.5rem !important;
        }

        .line-2{
            padding-top: 2rem !important;
        }

        .comprovante .right {
            text-align: right !important;
            width: 35%;
            font-weight: bold;
        }

        .comprovante .left {
            text-align: left !important;
            width: 65%;
        }

        @media print{

            #loader{
                display: none;
            }

            #content{
                display: block;
                text-align: center;
                font-size: 10px !important;
                background-color: darkgrey !important;
            }

            p.coupon_customer_fullname {
                line-height: 12px !important;
                padding-top: 1rem
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
        var paymentViewer = [];

        $(document).ready(function() {
            $(function () {
                var billet = '';




                var table = $('.list-payments').DataTable({
                    dom: '<"top"i>rt<"bottom"p><"clear">',
                    pagingType: 'simple',
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

                        },
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
                        {data: 'action', name: 'action', title: '2ª via (download)', orderable: false, searchable: false, render: function(data, type, full, meta) {
                                delete full.customer_origin;
                                var payment = JSON.stringify(full)

                                return `<a href="#" data-payment='${payment}' onclick="previewCoupon(this)" class='badge badge-pill badge-primary px-3 py-2'><i class='fas fa-receipt pr-1'></i>VISUALIZAR</a>`;
                            }},
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


        function previewCoupon(button){
            var dataPaymentString = button.getAttribute('data-payment');
            var dataPayment = JSON.parse(dataPaymentString);
            console.log(dataPayment);

            $("#modalCouponViewer").modal('show')
        }


    </script>
@endsection
