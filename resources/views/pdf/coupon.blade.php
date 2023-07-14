<!doctype html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html charset=utf-8"/>
    <title>Windx Telecomunicações - 2ª via de comprovante</title>
    <link rel="stylesheet" href="{{ public_path('assets/css_old/print-pdf.css_old') }}">
{{--    <link rel="stylesheet" href="{{ public_path('assets/css_old/print.coupon.css_old') }}">--}}
    <style>
        @page { margin: 0; }
    </style>
</head>
<body>
{{--{{dd($full_name)}}--}}
<div id="container">
    <div class="document">
        <div id="coupon" class="d-flex justify-content-center">
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
                                <h6><strong>Comprovante de pagamento</strong></h6>
                                <span>(Cupom não fiscal)</span>
                            </th>
                        </tr>
                        <tr class="b-top">
                            <th class="ttu text-center" colspan="2">
                                <p>
                                <span>Contrato Nº: </span><span id="coupon_customer_id">{{$customer}}</span>
                                </p>
                            </th>
                        </tr>
                        </thead>
                        <tfoot>
{{--                        <tr class="ttu ">--}}
{{--                            <th colspan="2" class="ttu text-center justify-content-center" >--}}
{{--                                <strong class="mt-2 p-1">Dados do pagamento: </strong>--}}
{{--                            </th>--}}
{{--                        </tr>--}}
                        <tr class="ttu b-top">
                            <td class="right">Referência: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                {{$reference}}
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Cartão: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                {{\App\Services\Functions::getDataCard($receipt)}}
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">ID: </td>
                            <td id="coupon_id" class="left">{{$id}}</td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Autorização: </td>
                            <td id="coupon_reference" class="left" style="max-width: 74mm">
                                {{\App\Services\Functions::getDataAutorizationPayment($receipt)}}
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Data/Hora: </td>
                            <td id="coupon_created_at" class="left">{{\App\Services\Functions::dateTimeToPt($created_at)}}</td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">{{sizeof($billets) > 1 ? 'Fatura(s):' : 'Fatura:'}}</td>
                            <td id="coupon_billets" class="left">
                                @foreach($billets as $key => $info)
                                        {{ $info->reference }}
                                @endforeach
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Pago via: </td>
                            <td id="coupon_method" class="left">
                                @if($method == 'ecommerce')
                                    Central do Assinante
                                @else
                                    Auto-atendimento
                                @endif
                            </td>
                        </tr>
                        <tr class="ttu b-top">
                            <td class="right">Venda à: </td>
                            <td id="coupon_payment_type" class="left">
                                @if($payment_type == 'credit')
                                    Crédito
                                @else
                                    Débito
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
                            <td class="left"><b>R$ <span id="coupon_amount">{{number_format($amount, 2, ',', '.') }}</span></b></td>
                        </tr>
                        @if($method == 'tef')
                            <tr class="ttu b-top pb-4 text-center">
                                <td colspan="2">TRANSACAO AUTORIZADA MEDIANTE<br>
                                    USO DE SENHA PESSOAL</td>
                            </tr>
                        @endif
                        <tr class="sup b-top pt-2 font-weight-bold">
                            <td colspan="4" class="text-center justify-content-center">
                                Ouvidoria: 0800 028 2309</br>
                                Financeiro: (28) 3532-2309</br></br>
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
