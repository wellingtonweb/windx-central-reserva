<!doctype html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <title>Windx Telecomunicações - 2ª via de comprovante</title>
    <link rel="stylesheet" href="{{ public_path('assets/css_old/print-pdf.css_old') }}">
{{--    <link rel="stylesheet" href="{{ public_path('assets/css_old/print.coupon.css_old') }}">--}}
    <style>
        @page { margin: 0; }

        body{
            background-color: #ffffff !important;
            color: black;
            /*background: #002046 url(/assets/img/bg001.jpg) no-repeat center center fixed;*/
            /*-webkit-background-size: cover;*/
            /*-moz-background-size: cover;*/
            /*-o-background-size: cover;*/
            /*background-size: cover;*/
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
            line-height: 12px;
            /*letter-spacing: 1px;*/
        }
        .comprovante .table-coupon {
            text-align: center !important;
            line-height: 15px !important;
            /*letter-spacing: 1px;*/
        }

        .comprovante table tfoot {
            line-height: 15px;
        }
        .comprovante .right {
            text-align: right !important;
            width: 40%;
            font-weight: bold;
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
{{--{{dd($full_name)}}--}}
<div id="container">
    <div class="document">
        <div id="coupon" class="d-flex justify-content-center comprovante">
            <div class="coupon-print-central">
                <div id="container-coupon" class="xpto">
                    <table id="example" class="printer-ticket">
                        <thead>
                        <tr>
                            <th class="text-center" colspan="2">
                                <img style="width: 20mm !important;" src="{{ public_path('assets/img/logo2.png') }}" class="logo pt-2">
                            </th>
                        </tr>
                        <tr class="b-top">
                            <th class="ttu text-center" colspan="2">
                                <h3 style="text-transform: uppercase"><strong>Comprovante de pagamento</strong></h3>
                                <span>(Cupom não fiscal)</span>
                            </th>
                        </tr>
{{--                        <tr class="b-top">--}}
{{--                            <th class="ttu text-center" colspan="2">--}}
{{--                                <p>--}}
{{--                                <span>Cliente ID: </span><span id="coupon_customer_id">{{$id}}</span>--}}
{{--                                </p>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
                        </thead>
                        <tfoot>
{{--                        <tr class="ttu ">--}}
{{--                            <th colspan="2" class="ttu text-center justify-content-center" >--}}
{{--                                <strong class="mt-2 p-1">Dados do pagamento: </strong>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
                        <tr class="ttu b-top">
                            <td class="right">Cliente: </td>
                            <td id="coupon_reference-" class="left">
                                <p class="coupon_customer_fullname">{{session('customerActive')->full_name}}
                                    <span id="coupon_customer_id">(ID: {{session('customerActive')->id}})</span></p>
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Pagamento ID: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                {{$id}}
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Referência: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                {{$reference}}
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Cartão: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                80000000
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">ID: </td>
                            <td id="coupon_id" class="left">88521</td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Autorização: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                94644551
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Data/Hora: </td>
                            <td id="coupon_created_at" class="left">16/08/2023 18:00</td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">
                                {{sizeof($billets) > 1 ? 'Fatura(s):' : 'Fatura:'}}
                            </td>
                            <td id="coupon_billets" class="left">
                                @foreach($billets as $key => $info)
{{--                                        {{ $info->reference }} {{ $info->due}}--}}
                                    @if($billets >= 1)
                                        {{ $info->reference }} ({{!empty($info->duedate) ? $info->duedate : '' }}){{!$loop->last ? ',':''}}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Pago via: </td>
                            <td id="coupon_method" class="left">
                                @if($method == 'ecommerce' && $terminal_id == null)
                                    Central do Assinante
                                @else
                                    Auto-atendimento
                                @endif
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Modalidade: </td>
                            <td id="coupon_payment_type" class="left">
                                @if($payment_type == 'credit')
                                    Crédito
                                @elseif($payment_type == 'debit')
                                    Débito
                                @elseif($payment_type == 'pix')
                                    Pix
                                @else
                                    Picpay
                                @endif
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Valor: </td>
                            <td class="left">R$
                                <span id="coupon_value">
                                    @php
                                        $total = 0;
                                        foreach ($billets as $billet)
                                        {
                                            $total += $billet->value;
                                        }
                                    @endphp
                                    {{number_format($total, 2, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        <tr class="ttu b-top pb-4">
                            <td class="right">Valor pago: </td>
                            <td class="left"><b>R$ <span id="coupon_amount">
                                        {{number_format($amount, 2, ',', '.') }}
                                    </span></b></td>
                        </tr>
                        @if($method == 'tef')
                            <tr class="ttu b-top pb-4 text-center">
                                <td colspan="2">TRANSACAO AUTORIZADA MEDIANTE<br>
                                    USO DE SENHA PESSOAL</td>
                            </tr>
                        @endif
                        <tr class="sup b-top pt-2 font-weight-bold">
                            <td colspan="4" style="text-align: center; padding-top: 1rem">
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
</body>
</html>
