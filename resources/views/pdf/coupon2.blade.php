<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>IMPRIMINDO COMPROVANTE...</title>
    <link rel="stylesheet" href="{{asset('assets/css_old/print-pdf.css_old')}}">
    <style>
        @page { margin: 0; }

        body{
            background-color: #002046 !important;
            /*background: #002046 url(/assets/img/bg001.jpg) no-repeat center center fixed;*/
            /*-webkit-background-size: cover;*/
            /*-moz-background-size: cover;*/
            /*-o-background-size: cover;*/
            /*background-size: cover;*/
        }

        .load-container{
            background-color: #002046;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        #content{
            display: none;
            /*border: 1px solid #000000;*/
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: center;*/
        }
        .comprovante{
            font-family: Lucida Console,Lucida Sans Typewriter,monaco,Bitstream Vera Sans Mono,monospace;
            margin: 0;
            /*border: bold solid black;*/
            width: 68mm;
            font-size: 10px !important;
            text-align: center;
        }

        .comprovante p{
            line-height: 10px;
            /*letter-spacing: 1px;*/
        }
        .comprovante .table-coupon {
            text-align: center !important;
            line-height: 15px !important;
            /*letter-spacing: 1px;*/
        }

        .comprovante table tfoot {
            line-height: 12px;
        }
        .comprovante .right {
            text-align: right !important;
            width: 40%;
        }

        .comprovante .left {
            text-align: left !important;
            width: 60%;
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
                /*max-width: 25ch;*/
                /*overflow: hidden;*/
                /*text-overflow: ellipsis;*/
                /*white-space: nowrap;*/
                line-height: 12px !important;
                padding-top: 1rem
            }
        }
    </style>
</head>
<body>
<div id="loader" class="load-container">

</div>
{{--<p>{{print_r(\App\Services\Functions::getDataCoupon($payment->data)[16])}}</p>--}}
{{--{{dd(\App\Services\Functions::getDataCoupon($payment->data)[16] == trim('\r') ? true : false)}}--}}
{{--{{dd(empty( trim(\App\Services\Functions::getDataCoupon($payment->data)[16])))}}--}}
{{--{{dd($payment->data)}}--}}
{{--{{dd(trim(\App\Services\Functions::getDataCoupon($payment->data)[16]))}}--}}
{{--{{dd(explode("\n", $payment->data->receipt))}}--}}
{{--{{dd(session('customerActive')->id)}}--}}
{{--{{dd(json_decode(\App\Services\Functions::getDataCoupon($payment->receipt)))}}--}}
<div id="content" class="comprovante">
    <div id="container-coupon" class="xpto">
        <table id="table-coupon" class="printer-ticket_" style="margin: 0mm 5mm 5mm 2mm ; width: 100%;
        font-size: 11px !important;">
            <thead style="background-color: indianred">
            <tr class="ttu b-top">
                <th class="text-center" colspan="2">
                    <img style="width: 20mm !important; padding-bottom: 1rem" src="{{asset('assets/img/logo1.svg')}}" class="logo">
                    <p style="letter-spacing: 1px !important;">WINDX TELECOMUNICAÇÕES<br>
                        CNPJ: 01.771.952/0001-71<br>
                        AV. SIMÃO SOARES, Nº: 365<br>
                        MARATAÍZES-ES</p>
                </th>
            </tr>
            <tr class="ttu b-top">
                <td style="text-align: center; line-height: 12px;" colspan="2">
                    <b><p style="font-size: 12px !important; ">Comprovante de pagamento</p></b>
                    <p>(Cupom não fiscal)</p>
                </td>
            </tr>
            </thead>
            <tfoot >
            <tr class="ttu b-top">
                <td class="right">Cliente: </td>
                <td id="coupon_reference-" class="left">
                    <p class="coupon_customer_fullname">{{session('customerActive')->full_name}}
                        <span id="coupon_customer_id">(ID: {{session('customerActive')->id}})</span></p>
                </td>
            </tr>
            <tr class="ttu b-top">
                <td class="right">Pagamento ID: </td>
                <td id="coupon_id" class="left">{{$payment->data->id}}</td>
            </tr>
            <tr class="ttu b-top" style="padding-top: 1rem">
                <td class="right">Referência: </td>
                <td id="coupon_reference-" class="left">
                    <p style="line-height: 12px !important;">{{$payment->data->reference}}</p>
                </td>
            </tr>
            <tr class="ttu b-top">
                <td class="right">Data - Hora: </td>
                <td id="coupon_created_at" class="left">{{\App\Services\Functions::dateTimeToPt($payment->data->created_at)}}</td>
            </tr>
            <tr class="ttu b-top">
                <td class="right">{{sizeof($payment->data->billets) > 1 ? 'Faturas (Nosso nº):' : 'Fatura (Nosso nº):'}}</td>
                <td id="coupon_billets" class="left">
                    @foreach($payment->data->billets as $key => $info)
                        @if($payment->data->billets > 1)
                            {{ $info->reference }} ({{!empty($info->duedate) ? $info->duedate : '' }}){{!$loop->last ? ',':''}}
                        @endif
                    @endforeach
                </td>
            </tr>
            @if($payment->data->method === 'tef' && $payment->data->payment_type != 'pix')
                <tr class="ttu b-top">
                    <td class="right">Autorização: </td>
                    <td id="coupon_id" class="left">
{{--                        {{preg_replace('/[^0-9]/', '', \App\Services\Functions::arrayCoupon($payment->data)[10])}}--}}
                        {{\App\Services\Functions::arrayCoupon($payment->data)[10] != null ? preg_replace('/[^0-9]/', '', \App\Services\Functions::arrayCoupon($payment->data)[10]) : ''}}
                    </td>
                </tr>
                @if(count(\App\Services\Functions::arrayCoupon($payment->data)) == 23)
                    <tr class="ttu b-top">
                        <td class="right">Pagador: </td>
                        <td id="coupon_reference-" class="left" style="max-width: 74mm">
                            {{\App\Services\Functions::arrayCoupon($payment->data)[17]}}
                        </td>
                    </tr>

                    <tr class="ttu b-top">
                        <td class="right">Cartão: </td>
                        <td id="coupon_reference-" class="left" style="max-width: 74mm">
                            {{\App\Services\Functions::arrayCoupon($payment->data)[9]}}
                        </td>
                    </tr>
                @endif
                <tr class="ttu b-top">
                    <td class="right">Bandeira: </td>
                    <td id="coupon_reference-" class="left" style="max-width: 74mm">
                        {{\App\Services\Functions::arrayCoupon($payment->data)[7]}}
                        ({{trim(\App\Services\Functions::arrayCoupon($payment->data)[6])}})

                    </td>
                </tr>
            @endif

            <tr class="ttu b-top">
                <td class="right">Pago via: </td>
                <td id="coupon_method" class="left">
                    @if($payment->data->method == "ecommerce" && $payment->data->terminal_id == null)
                        Central do Assinante
                    @elseif($payment->data->method == 'picpay')
                        Picpay
                    @else
                        Autoatendimento
                    @endif
                </td>
            </tr>
            @if($payment->data->method != 'picpay')
                <tr class="ttu b-top">
                    <td class="right">Modalidade: </td>
                    <td id="coupon_payment_type" class="left">
                        @if($payment->data->payment_type == 'credit')
                            Crédito
                        @elseif($payment->data->payment_type == 'debit')
                            Débito
                        @else
                            Pix
                        @endif
                    </td>
                </tr>
            @endif
            <tr class="ttu b-top">
                <td class="right">Valor: </td>
                <td class="left">R$
                    <span id="coupon_value">
                    @php
                        $total = 0;
                        foreach ($payment->data->billets as $billet)
                        {
                            $total += $billet->value;
                        }
                    @endphp
                        {{number_format($total, 2, ',', '.') }}
                </span>
                </td>
            </tr>
            <tr class="ttu b-top">
                <td class="right">Juros + Multa: </td>
                <td class="left">R$
                    <span id="coupon_value">
                    @php
                        $totalAddition = 0;
                        foreach ($payment->data->billets as $billet)
                        {
                            $totalAddition += $billet->addition;
                        }
                    @endphp
                        {{number_format($totalAddition, 2, ',', '.') }}
                </span>
                </td>
            </tr>
            <tr class="ttu b-top pb-4">
                <td class="right">Valor pago: </td>
                <td class="left">
                    <b>R$ <span id="coupon_amount">
                       {{number_format($payment->data->amount, 2, ',', '.') }}
                    </span></b>
                </td>
            </tr>
            @if($payment->data->payment_type == 'credit' || $payment->data->payment_type == 'debit')
                @if($payment->data->method == 'tef')
                    <tr class="sup b-top">
                        <td colspan="4" class="justify-content-center" style="padding-top: 1rem; text-align: center">
                            @if(trim(\App\Services\Functions::arrayCoupon($payment->data)[16]) != "TRANSACAO AUTORIZADA COM SENHA")
                                <p>TRANSAÇÃO AUTORIZADA<br> POR APROXIMAÇÃO<br><br>
                                    {{\App\Services\Functions::arrayCoupon($payment->data)[17]}}<br><br>
                                    {{\App\Services\Functions::arrayCoupon($payment->data)[18]}}<br>
                                    {{\App\Services\Functions::arrayCoupon($payment->data)[19]}}
                                </p>
                            @else
                                <p>{{\App\Services\Functions::arrayCoupon($payment->data)[16]}}<br><br>
                                    {{\App\Services\Functions::arrayCoupon($payment->data)[18]}}<br><br>
                                </p>
                            @endif
                        </td>
                    </tr>
                @endif
            @else
                <tr class="sup b-top">
                    <td colspan="4" class="justify-content-center" style="padding-top: 1rem; text-align: center">
                        <p>FAVOR CONFERIR O PAGAMENTO<br>
                            EM SEU APLICATIVO</p>
                    </td>
                </tr>
            @endif
            <tr class="sup b-top">
                <td colspan="4" class="justify-content-center" style="padding-top: 1rem; text-align: center">
                    <p>Ouvidoria: 0800 028 2309</p>
                    <p>Financeiro: (28) 3532-2309</p>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/libs.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/payment2.js') }}"></script>

<script type="text/javascript">
    const route_login = '{{route('terminal.login')}}';
    const route_logout = '{{route('terminal.logout')}}';
    const app_url = '{{env('APP_URL')}}';
    const base_url = '{{env('APP_BASE_URL')}}';
    const contracts = '{{route('terminal.contracts')}}';

    window.print();

    (function () {

        var beforePrint = function () {

            $("#loader").delay(5000).fadeOut("slow");
            console.log('Before Print')

        };

        var afterPrint = function () {
            // setTimeout(function(){
            // history.back();
            clearInterval(callback)
            Swal.fire({
                title: document.referrer != contracts ? 'Deseja continuar?':'Deseja realizar outro pagamento?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                timer: 10000,
                customClass: {
                    actions: 'my-actions',
                    cancelButton: 'order-1 right-gap',
                    confirmButton: 'order-2',
                    denyButton: 'order-3',
                },
                didOpen: () => {
                    Swal.hideLoading()
                },
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
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    clearAllSections()
                    // location.reload();
                    window.location.href = base_url+"contrato/"+{{session('customerActive')->id}}
                        //setTimeout(() => { callbackTransaction() }, 15000);
                } else if (result.dismiss || result.isDenied) {
                    logout()
                }
            })
            // }, 5000);
        };

        if (window.matchMedia) {

            var mediaQueryList = window.matchMedia('print');

            mediaQueryList.addListener(function (mql) {

                if (mql.matches) {

                    beforePrint();

                } else {

                    afterPrint();

                }

            });

        }

        window.onbeforeprint = beforePrint;

        window.onafterprint = afterPrint;

    }());

</script>
</body>
</html>
