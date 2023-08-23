@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-5 mt-md-0">
                <main role="main" class="p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <section class="d-none">
                        @if(count($data->items()) != 0)
                        <div class="contents">
                            @php $billets = 0; @endphp
                            <div class="row checkout ">
                                <div class="col-12 d-flex align-middle checkout-status- bg-white rounded mb-2 justify-content-between">
                                    <a class="btn btn-primary ml-0" href="{{route('central.contract', ['customerId' => session('customerId')])}}">
                                        <i class="fas fa fa-arrow-left pr-1" aria-hidden="true"></i>Voltar
                                    </a>
                                </div>
                            </div>

                            <table id="table-coupons-list" class=" table table-coupons mt-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nosso nº</th>
                                        <th>Vencimento</th>
                                        <th>Data - Hora</th>
                                        <th>Valor pago</th>
                                        <th>Pago via</th>
                                        <th>Modalidade</th>
                                        <th>Status</th>
                                        <th>2ª Via</th>
                                        <th>Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data->items() as $key => $payment)
{{--                                    <tr class="t-scheduled t-status">--}}
                                    <tr class="{{ $payment['status'] == 'approved' ? 't-scheduled t-status': 't-inactive'}}">
                                                <td id="col_id" width="14,28%">
                                                    <span class="fields-values">{{$payment['id'] }}</span>
                                                </td>
                                                <td id="col_billets" width="44,28%" >
                                                    <p class="fields-values">
                                                    @foreach($payment['billets'] as $billet)
                                                        @if(count($payment['billets']) > 1)
                                                        {{$billet['reference'] }}<br>
                                                        @else
                                                        {{$billet['reference'] }}
                                                        @endif
                                                    @endforeach
                                                    </p>
                                                </td>
                                                <td id="col_duedate" width="44,28%">
                                                    <p class="fields-values">
                                                    @foreach($payment['billets'] as $billet)
                                                        @if(isset($billet['duedate']))
                                                            @if(count($payment['billets']) > 1)
                                                            {{$billet['duedate'] ? $billet['duedate'] : null }}<br>
                                                            @else
                                                            {{$billet['duedate']}}
                                                            @endif
                                                        @else
{{--                                                        {{null}}--}}
                                                            ----
                                                        @endif
                                                    @endforeach
                                                    </p>
                                                </td>
{{--                                                <td id="col_dt_payment" width="14,28%"><h4 class="title-actions">Data de pagamento: </h4><span class="fields-values">{!! gmdate("Y-m-d\TH:i:s\Z") !!}</span></td>--}}
                                                <td id="col_dt_payment" width="14,28%">
                                                    <span class="fields-values">01/07/2023</span>
{{--                                                    <span class="fields-values">{!! $dueDate = \App\Services\Functions::dateTimeToPt($payment['created_at'])!!}</span>--}}
                                                </td>
                                                <td id="col_amount" width="14,28%"><span class="fields-values">R$ {{ number_format($payment['amount'], 2, ',', '') }}</span></td>
                                                <td id="col_payment_type" width="14,28%">
                                                    <span class="fields-values">
                                                        @if($payment['method'] == 'ecommerce' && !$payment['method'] == 'tef')
                                                            Central do Assinante
                                                        @elseif($payment['method'] == 'picpay')
                                                            Picpay
                                                        @else
                                                            Autoatendimento
                                                        @endif
                                                    </span>
                                                </td>
                                                <td id="col_payment_type" width="14,28%"><span class="fields-values">{{ $payment['payment_type'] }}</span></td>
                                                <td id="col_status" width="14,28%"><span class="fields-values">{{ $payment['status'] }}</span></td>
                                                <td id="col_reference" class="d-none" width="14,28%">{{$payment['reference']}}</td>
                                                <td id="col_value" class="d-none" >
                                                    @php
                                                        $total = 0;
                                                        foreach ($payment['billets'] as $billet)
                                                        {
                                                            $total += $billet['value'];
                                                        }
                                                    @endphp
                                                    {{number_format($total, 2, ',', '.') }}
                                                </td>
                                                <td id="col_fees" class="d-none" >
                                                    @php
                                                        $totalAddition = 0;
                                                        foreach ($payment['billets'] as $billet)
                                                        {
                                                            $totalAddition += $billet['addition'];
                                                        }
                                                    @endphp
                                                    {{number_format($totalAddition, 2, ',', '.') }}
                                                </td>
                                                <td id="col_btn_print" width="7%">
                                                @if($payment['status'] != 'approved')
{{--                                                    @if($payment['status'] != 'approved' && $payment['method'] != 'tef')--}}
                                                    <a href="#" class="btn btn-secondary btn-sm btn-radius-50 disabled">
                                                        <i class="fa fa-times fa-2x pl-1 pr-1" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('central.coupon.pdf', ['id' => $payment['id'] ]) }}" type="button" id="{{  $payment['id'] }}" class="btn btn-primary btn-sm coupon-pdf btn-radius-50 ">
                                                        <i class="fa fa-print fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                </td>
                                                <td id="col_btn_details" width="7%">
                                                    <a href="#" class="btn btn-info btn-sm btn-radius-50 btn-payment-get-details " data-toggle="modal"
                                                       data-target="#payments-details" data-payment="{{$payment['id']}}">
                                                        <i class="fa fa-info fa-2x pl-2 pr-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>

                            <div id="container-coupon" class="xpto d-none">
{{--                                <div id="container-coupon" class="xpto">--}}
                                    <table id="example" class="printer-ticket">
                                        <thead>
                                        <tr>
                                            <th class="text-center" colspan="4">
                                                <img style="width: 100px" src="{{ asset('assets/img/logo2.svg') }}" class="logo pt-2">
                                            </th>
                                        </tr>
                                        <tr class="b-top">
                                            <th class="ttu text-center" colspan="2">
                                                <strong>Comprovante de pagamento<br />Cupom não fiscal</strong>
                                            </th>
                                        </tr>
                                        <tr class="b-top">
                                            <th class="ttu text-center" colspan="2">
                                                <p><strong class="p-2">Cliente: </strong></p>
                                                <span id="coupon_customer">{{session('customer')->full_name}}</span><br />
{{--                                                    <span>WELLINGTON DIAS FERREIRA</span><br />--}}
                                                <span>Contrato ID: </span><span id="coupon_customer_id">{{session('customer')->id}}</span>
{{--                                                    <span>Contrato ID: </span><span>1234</span>--}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr class="ttu ">
                                            <th colspan="4" class="ttu text-center justify-content-center" >
                                                <strong class="mt-3 p-1">Dados do pagamento: </strong>
                                            </th>
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Referência: </td>
                                            <td id="coupon_reference" class="left" style="max-width: 220px"></td>
{{--                                                <td id="coupon_card_number" class="left">4a32bcb8-cbe2-46bf-8527-d31f61840889</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">ID: </td>
                                            <td id="coupon_id" class="left"></td>
{{--                                                <td class="left">76</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Data/Hora: </td>
                                            <td id="coupon_created_at" class="left"></td>
{{--                                                <td class="left">09/06/2021 / 17:36:00 ONL-C</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Boleto(s): </td>
                                            <td id="coupon_billets" class="left"></td>
{{--                                                <td class="left">0559959-5</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Pago via: </td>
                                            <td id="coupon_method" class="left">CENTRAL DO ASSINANTE</td>
{{--                                                <td class="left">CENTRAL DO ASSINANTE</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Venda à: </td>
                                            <td id="coupon_payment_type" class="left"></td>
{{--                                                <td class="left">DÉBITO</td>--}}
                                        </tr>
                                        <tr class="ttu b-top">
                                            <td class="right">Valor: </td>
                                            <td class="left">R$ <span id="coupon_value"></span></td>
{{--                                                <td class="left">R$ 69,90</td>--}}
                                        </tr>
                                        <tr class="ttu b-top pb-4">
                                            <td class="right">Valor pago: </td>
                                            <td class="left">R$ <span id="coupon_amount"></span></td>
{{--                                                <td class="left">R$ 69,90</td>--}}
                                        </tr>
                                        <tr class="sup b-top pt-2 font-weight-bold">
                                            <td colspan="4" class="text-center justify-content-center">
                                                Ouvidoria: 0800 028 2309</br>
                                                Financeiro: (28) 3532-2309
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                        </div>
                        @else
                            <script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
                            <script>
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Este cadastro ainda não possuí comprovantes!',
                                    showConfirmButton: false,
                                    timer: 5000,
                                    allowOutsideClick: () => {
                                        const popup = Swal.getPopup()
                                        popup.classList.remove('swal2-show')
                                        setTimeout(() => {
                                            popup.classList.add('animate__animated', 'animate__headShake')
                                        })
                                        setTimeout(() => {
                                            popup.classList.remove('animate__animated', 'animate__headShake')
                                        }, 500)
                                        return false
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        history.back();
                                    }
                                })
                            </script>
                        @endif
                    </section>
                    <section>
                        <table id="example" class="display" style="width:100%; color: #ffffff">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn.</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Extn.</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                            </tfoot>
                        </table>
                    </section>
                </main>
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
@endsection

@section('js')
{{--    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
    <script type="text/javascript" defer  src="{{ asset('assets/js/moment.min.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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

        console.log('Teste: ',{{$data}});

        {{--new DataTable('#example', {--}}
        {{--    ajax: {{$data}}--}}
        {{--});--}}
    </script>
@endsection
