<html class="no-js" lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>IMPRIMINDO BOLETO...</title>
    <link rel="stylesheet" href="{{asset('assets/css_old/print-pdf.css_old')}}">
    <style>
        .boleto-container{
            margin: 0;
            padding: 0;
            width: 220mm;
            /*height: 69mm;*/
            height: 100%;
            overflow: auto;
        }

        .boleto-canhoto-esquerda{
            /*border: 0.3mm solid black;*/
            margin: 0px;
            padding: 0;
            width: 52mm;
            /*height: 68mm;*/
            height: 100%;
            /*font-size: 0.8em;*/
            font-size: 0.6em;
            top:2mm;
            /*top:0;*/
        }

        .text-right{
            text-align: right;
        }

        .boleto-canhoto-esquerda h1{

            font-size: 1em;
            margin: 0 auto;
            text-align: center;
        }

        .boleto-canhoto-esquerda hr{
            margin: 0px;
            padding: 0px;
        }

        .boleto-canhoto-esquerda p{
            margin: 1px;
            padding: 0;
        }

        .boleto-linha-digitavel{
            position: absolute;
            /*font-size: .9em;*/
            font-size: 0.8em;
            text-align: left;
            width: 120mm;
            border-left: 0.5mm dashed black;
            margin-left: 2mm;
            padding-left: 2mm;
            height: 7mm;
            left: 53mm;
            /*top: 3mm;*/
            top: 0mm;
            /*letter-spacing: 1px;*/
        }

        /*.boleto-linha-digitavel img{*/
        /*    width: 100%;*/
        /*}*/

        .boleto-info{
            border-left: 0.5mm dashed black;
            margin-left: 2mm;
            padding-left: 2mm;
            padding-top: 2mm;
            width: 120mm;
            height: 46.5mm;
            position: absolute;
            /*font-size: 0.8em;*/
            font-size: 0.6em;
            left: 53mm;
            /*top: 10.4mm;*/
            top: 7mm;
            letter-spacing: 1px;
        }

        .boleto-info p {
            line-height: 10px;
        }

        .boleto-codbarras{
            border-left: 0.5mm dashed black;
            margin-left: 2mm;
            padding-left: 2mm;
            width: 120mm;
            /*height: 10.7mm;*/
            height: 21.5mm;
            position: absolute;
            font-size: 1em;
            left: 53mm;
            top: 56.5mm;
        }

        .boleto-codbarras svg{
            width: 100mm !important;
        }

        .boleto-canhoto-direita{
            position: absolute;
            border-left: 0.3mm solid black;
            margin-left: 2.5mm;
            padding-left: 2mm;
            padding-right: 1mm;
            /*width: 49mm;*/
            width: 50mm;
            /*height: 67mm;*/
            height: 100%;
            /*font-size: 0.8em;*/
            font-size: 0.6em;
            left: 175.5mm;
            top: 2mm;
        }

        .boleto-canhoto-direita h1{
            font-size: 1em;
            margin: 0 auto;
            text-align: center;
        }

        .boleto-canhoto-direita hr{
            margin: 0px;
            padding: 0px;
        }

        .boleto-canhoto-direita p{
            margin: 1px;
            padding: 0;
        }

        .load-container{
            background-color: #002046;
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
        }

        @media print{

            #loader{
                display: none;
            }

            #content{
                display: block;
            }

            .landscape {
                width: 230mm;
                height: 75mm;
                transform: rotate(270deg) translate(-235mm, 0);
                transform-origin: 0 0;
            }
        }
    </style>
</head>
<body>
<div id="loader" class="load-container">
{{--    {!! dd( \App\Services\Functions::getBeneficiary(5) )!!}--}}
</div>

<div id="content" class="boleto-container landscape" style="color: black">

    <div class="boleto-canhoto-esquerda">

        <h1>RECIBO</h1>

        <P>Beneficiário</P>

        <p class="text-right">
            {{ $beneficiary['razao'] }}
        </p>

        <hr>

        <p>Vencimento</p>

        <p class="text-right">{{ \App\Services\Functions::dateToPt($invoice->Vencimento) }}</p>

        <hr>

        <p>Agência / Código beneficiário</p>

        <p class="text-right">{{$invoice->Agencia}} / {{$invoice->Convenio}}</p>

        <hr>

        <p>Nosso número</p>

        <p class="text-right"><b>{{$invoice->NossoNumero}}</b></p>

        <hr>

        <p>Valor</p>

        <p class="text-right"><b>R$ {{number_format($invoice->Valor, 2, ',', '')}}</b></p>

        <hr>

        <p>Valor Pago</p>

        <p>&nbsp;</p>

        <hr>

        <p>Pagador</p>

        <p class="text-right">{{$invoice->Nome}}<br>{{$invoice->CpfCgc}}</p>

    </div>

    <div class="boleto-linha-digitavel" style="display: flex">

        <img src="{{asset('assets/img/sicoob.bmp')}}" width="70" height="20">
{{--        <img src="{{asset('assets/img/sicoob.svg')}}" width="70">--}}

        <span style="padding-left: .5rem; padding-top: .2rem">
            {{$invoice->Banco}} | {{$invoice->LinhaDigitavel}}
        </span>

    </div>

    <div class="boleto-info" >

        Informações:<br>

        <p>{{$invoice->LocalPagamento}}</p>

        <p>NÃO RECEBER APÓS 15 DIAS DO VENCIMENTO<br>
        MULTA DE 2% POR ATRASO<br>
        JUROS DE 0,20% DE MORA AO DIA
        </p>

        <p>Referência: {{$invoice->Referencia}}</p>

        <hr align ="left">

        Pagador: <br>

        {{$invoice->Nome}}<br>

        {{$invoice->Cidade}}-{{$invoice->UF}} ({{$invoice->CEP}})<br>

    </div>

    <div class="boleto-codbarras" style="background-color: indianred">
{{--        <img src="https://svgsilh.com/svg_v2/306926.svg" />--}}
{{--        <canvas id="barcode"></canvas>--}}
{{--        <canvas id="1"></canvas>--}}
        {{ \App\Services\Functions::barcode2($invoice->CodigoBarras) }}
    </div>

    <div class="boleto-canhoto-direita">

        <p>Beneficiário</p>

        <p class="text-right">
            {{ $beneficiary['razao'] }}
        </p>

        <hr>

        <p>Agência / Código beneficiário</p>

        <p class="text-right">{{$invoice->Agencia}} / {{$invoice->Convenio}}</p>

        <hr>

        <p>Nosso número</p>

        <p class="text-right"><b>{{$invoice->NossoNumero}}</b></p>

        <hr>

        <p>Emissão</p>

        <p class="text-right">{{ \App\Services\Functions::dateToPt($invoice->Data_Emissao) }}</p>

        <hr>

        <p>Vencimento</p>

        <p class="text-right"><b>{{ \App\Services\Functions::dateToPt($invoice->Vencimento) }}</b></p>

        <hr>

        <p>Valor</p>

        <p class="text-right"><b>R$ {{number_format($invoice->Valor, 2, ',', '')}}</b></p>

        <hr>

        <p>Acréssimos (+)</p>

        <hr>

        <p>Descontos (-)</p>

        <hr>

        <p>Valor Pago</p>

    </div>

</div>
<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jsbarcode2.js') }}"></script>
<script>
    $("#barcode").JsBarcode("{{$invoice->CodigoBarras}}",{format:"ITF",displayValue:true,fontSize:17});
    // JsBarcode("#barcode","646464984654664400044", {
    //     format: "ITF",
    //     displayValue: false,
    //     height: 50,
    //     width: 1
    // });
</script>
<script type="text/javascript">
    window.print();

    (function () {

        var beforePrint = function () {

            $("#loader").delay(5000).fadeOut("slow");
            console.log('Before Print')

        };

        var afterPrint = function () {

            setTimeout(function(){
                history.back();
            }, 5000);

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
