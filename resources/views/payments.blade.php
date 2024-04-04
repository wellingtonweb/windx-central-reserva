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
        <div class="modal-dialog modal-sm_">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: none">
                    <h5 class="modal-title font-weight-bold">Pagamento ID: <span id="modalCouponViewerLabel"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="coupon d-flex_ justify-content-center_">
                        <table>
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
                                    <h3>Comprovante de pagamento</h3>
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
                                <td id="coupon_id" class="left" style="max-width: 74mm; padding-top: 1rem">
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td class="right">Referência: </td>
                                <td class="left" >
                                    <span id="coupon_reference" style="max-width: 75%"></span>
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td class="right">Data Hora: </td>
                                <td id="coupon_created_at" class="left">
                                </td>
                            </tr>
                            <tr class="ttu b-top" >
                                <td class="right">Cliente: </td>
                                <td class="left">
                                    <span id="coupon_customer_id"></span> -
                                    <span id="coupon_customer_fullname"></span>
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td id="coupon_label_billets" class="right">

                                </td>
                                <td id="coupon_billets" class="left">
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td class="right">Pago via: </td>
                                <td id="coupon_origin" class="left text-uppercase">
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td class="right">Modalidade: </td>
                                <td id="coupon_payment_type" class="left text-uppercase">
                                </td>
                            </tr>
                                    <tr id="tr_card_number" class="ttu b-top d-none">
                                        <td class="right">Cartão: </td>
                                        <td class="left" style="max-width: 74mm">
                                            ****.****.****<span id="coupon_card"></span>
                                        </td>
                                    </tr>
                                    <tr id="tr_card_flag" class="ttu b-top d-none">
                                        <td class="right">Bandeira: </td>
                                        <td id="coupon_flag" class="left" style="max-width: 74mm">

                                        </td>
                                    </tr>
                                    <tr id="tr_card_payer" class="ttu b-top d-none">
                                        <td class="right">Titular: </td>
                                        <td id="coupon_payer" class="left" style="max-width: 74mm">
                                        </td>
                                    </tr>
                                    <tr id="tr_card_installment" class="ttu b-top d-none">
                                        <td class="right">Acordo: </td>
                                        <td class="left" style="max-width: 74mm">
                                            Parcelado em <span id="coupon_installment"></span>x
                                        </td>
                                    </tr>
                            <tr class="ttu b-top">
                                <td class="right">Valor: </td>
                                <td class="left">R$ <span id="coupon_value"></span>
                                </td>
                            </tr>
                            <tr class="ttu b-top">
                                <td class="right">Juros + Multa: </td>
                                <td class="left">R$ <span id="coupon_addition"></span>
                                </td>
                            </tr>
                            <tr class="ttu b-top pb-4" style="font-weight: bold;">
                                <td class="right ">Valor pago: </td>
                                <td class="left ">
                                    R$ <span id="coupon_amount"></span>
                                </td>
                            </tr>
                            <tr class="ttu b-top text-center">
                                <td colspan="4" style="text-align: center; letter-spacing: 1px">
                                    <span id="coupon_card_ent_mode">
                                    </span>
                                </td>
                            </tr>
                                <tr class="ttu b-top text-center ">
                                    <td colspan="4" class="label-info">
                                        <p>FAVOR CONFERIR EM SEU <br>APLICATIVO DE PAGAMENTO</p>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                            <tr class="sup b-top pt-2 font-weight-bold">
                                <td colspan="4" style="text-align: center; padding-top: .5rem; border-top: 1px solid #cfcfcf; letter-spacing: 1px">
                                    <b>Ouvidoria: 0800 028 2309</b></br>
                                    <b>Financeiro: (28)3532-2309</b></br></br>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-download pr-1"></i>Baixar</button>
{{--                    <a href="{{ route('central.coupon.pdf', ['id' => $data['id'] ]) }} .--}}
{{--////                            '" data-toggle="tooltip" onclick="downloadClick()" data-original-title="Download" class="download-pdf badge badge-pill badge-primary px-3 py-2"><i class="fa fa-download pr-1"></i>BAIXAR</a>--}}
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

        #modalCouponViewer .modal-dialog {
            max-width: 400px;
        }

        #modalCouponViewer .modal-body {
            padding: 0 1rem;
        }

        #modalCouponViewer .modal-footer .btn, .btn-sm {
            padding: .25rem .75rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 20px;
        }

        thead h3 {
            font-weight: bold;
            text-transform: uppercase;
            font-size: .65rem;
            letter-spacing: 1px;
            margin-top: .8rem;
        }

        tbody {
            letter-spacing: 1px;
        }

        tbody .label-info p{
            text-align: center;
            letter-spacing: 1px;
            padding-top: 1rem;
            font-size: 10px;
        }

        .coupon{
            font-family: Nunito, "Courier New", monospace;
            width: 100%;
            /*width: 68mm;*/
            font-size: .68rem !important;
            text-align: center;
            padding: .43rem;
            background-color: #fff9f2 !important;
            color: #0a1520;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .coupon p{
            line-height: 12px;
        }

        .coupon table tbody,
        .coupon table tfoot{
            line-height: 22px;
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

        .coupon .right {
            text-align: right !important;
            width: 30%;
            font-weight: bold;
        }

        .coupon .left {
            text-align: left !important;
            width: 70%;
            padding-left: .3rem;
        }

    </style>
@endsection

@section('js')
{{--    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>--}}
    <script type="text/javascript" defer  src="{{ asset('assets/js/moment.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        var customerActive = @json(session('customer'));
        var paymentViewer = [];
        var feesB, valueB = 0;

        var test = {"card_number":"402400******3191","payer":"WELLINGTON FERREIRA","flag":"Master","transaction_code":"6be01539-4330-489f-963c-05bc8b5cabb0","card_ent_mode":"TRANSACAO AUTORIZADA COM SENHA","in_installments":1,"receipt":null}
        console.log('Test',JSON.stringify(test))

        let additionTotal = 0;
        let valueTotal = 0;
        let formattedBillets = [];
        let formattedReference = '';
        // const moment = require('moment-timezone');
        console.log(customerActive)

        fetch("{{ route('central.coupons') }}")
            .then(response => response.text())
            .then(data => {
                // Aqui 'data' será a string recuperada do banco de dados
                // console.log(data);
                const array = JSON.parse(data); // Convertendo a string para um array JavaScript
                const payment = array['data']['17'];
                console.log(payment)
                const receipt = JSON.parse(payment.receipt);
                console.log(receipt);
            })
            .catch(error => {
                console.error('Erro ao recuperar os dados:', error);
            });


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
                        {data: 'amount', name: 'amount', title: 'Valor pago'},
                        {data: 'payment_type', name: 'payment_type', title: 'Modalidade'},
                        {data: 'created_at', name: 'created_at', title: 'Data/Hora'},
                        {data: 'status', name: 'status', title: 'Status'},
                        {data: 'action', name: 'action', title: '2ª via (download)', orderable: false, searchable: false, render: function(data, type, full, meta) {
                                // delete full.customer_origin;

                                // full.receipt = JSON.parse(full.receipt)
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
            var payment = JSON.parse(dataPaymentString);
            console.log(payment);
            setDataCoupon(payment)

            $("#modalCouponViewer").modal('show')
        }

        function setDataCoupon(payment){
            var billets = '';
            $('#modalCouponViewerLabel').text(payment.id)
            $('#coupon_customer_id').text(customerActive.id + '('+payment.company_id+')')
            $('#coupon_customer_fullname').text(customerActive.full_name)
            additionTotal = 0;
            valueTotal = 0;
            formattedReference = '';

            for (const [key, value] of Object.entries(payment)) {
                if(key == 'origin'){
                    if(value == 'central'){
                        $(`#coupon_${key}`).text('Central do Assinante')
                    }else if(value == 'bot'){
                        $(`#coupon_${key}`).text('WhatsApp')
                    }else{
                        $(`#coupon_${key}`).text('Autoatendimento')
                    }
                }else if(key == 'payment_type'){
                    if(value == 'credit' || value == 'debit'){
                        $(`#tr_card_number`).removeClass('d-none')
                        $(`#tr_card_flag`).removeClass('d-none')
                        $(`#tr_card_payer`).removeClass('d-none')
                        // if(payment.installment > 1){
                            $(`#tr_card_installment`).removeClass('d-none')
                        // }
                        if(value == 'credit'){
                            $(`#coupon_${key}`).text('Crédito')
                        }else{
                            $(`#coupon_${key}`).text('Débito')
                        }
                    }

                    if(value == null){
                        $(`#coupon_${key}`).text('Picpay')
                    }
                }else if(key == 'created_at'){
                    var pay = moment(value).format('DD/MM/YYYY HH:mm:ss')

                        $(`#coupon_${key}`).text(pay)
                }else if(key == 'amount'){
                    $(`#coupon_${key}`).text(value.replace('.',','))
                }else{
                    $(`#coupon_${key}`).text(value)
                }
            }

            // for (const [key2, value2] of Object.entries(payment.receipt)) {
            //     if(key2 == 'card_number'){
            //         $(`#coupon_${key2}`).text(value2)
            //     }
            // }

            payment.billets.forEach(billet => {
                additionTotal += billet.addition;
                valueTotal += billet.value;
                formattedReference += `${billet.reference} (${billet.duedate}) <br>`;
            });

            // payment.receipt.forEach(billet => {
            //     console.log(billet)
            // });

            // Object.keys(payment).forEach(key => {
            //     if (key === 'addition') {
            //         additionTotal += payment[key];
            //     } else if (key === 'value') {
            //         valueTotal += payment[key];
            //     }
            //
            //     $(`#coupon_${payment[key]}`).text('Central do Assinante')
            // });

            $('#coupon_addition').text(additionTotal.toLocaleString('pt-br', {minimumFractionDigits: 2}))
            $('#coupon_value').text(valueTotal.toLocaleString('pt-br', {minimumFractionDigits: 2}))
            $(`#coupon_label_billets`).text(payment.billets.length > 1 ? 'Faturas: ':'Fatura: ')
            $(`#coupon_billets`).html(formattedReference)
        }
    </script>
@endsection
