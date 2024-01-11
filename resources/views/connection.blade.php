@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <nav id="infoCustomerActive" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-primary" href="{{route('central.home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$header}}</li>
                        </ol>
                    </nav>
                    <div class="header-app col-12 font-weight-bolder text-left" style="display: none">
                        {{$header}}
                    </div>
                    <div class="contract-info col-12">
                        <form id="formFilterGraphics">
                            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <div class="row card-info row-cols-1 row-cols-sm-2 row-cols-md-4">
                                <div class="col pt-4">
                                    <div class="form-group">
                                        <div id="dtPkrStart" class="datepicker date dtInicial input-group">
                                            <input type="text" placeholder="Data inicial" class="form-control dtpkr" name="dtInicial" id="dtInicial">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-4">
                                    <div class="form-group">
                                        <div id="dtPkrEnd" class="datepicker date dtFinal input-group">
                                            <input type="text" placeholder="Data final" class="form-control dtpkr" name="dtFinal" id="dtFinal">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-3">
                                    <label class="form-check-label">Filtro rápido</label>
                                    <div class="form-group d-flex d-sm-flex">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="fastFilter" id="fastFilter7" value="7">
                                            <label class="form-check-label" for="inlineRadio1">7 dias</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="fastFilter" id="fastFilter15" value="15">
                                            <label class="form-check-label" for="inlineRadio2">15 dias</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="fastFilter" id="fastFilter30" value="30">
                                            <label class="form-check-label" for="inlineRadio3">30 dias</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col p-3 d-flex">
                                    <button class="btn btn-primary mt-2" type="submit">Pesquisar</button>
                                    <button id="btnDownload" class="btn btn-secondary mt-2" type="button">Download</button>
                                </div>
                            </div>
                            <div class="row card-info mt-2">
                                <div class="col-12 ">
                                    <div id="reportPage">
                                        <div id="loadingCharts" class="w-100">
                                            <i class="fas fa-spinner fa-2x fa-spin"></i>
                                        </div>
                                        <div id="chartContainer" class="container-fluid w-100" style="height: 40vh">
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                    <img id="canvas-img" src="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css">
    <style>
        #loadingCharts {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #002046;
        }

        .card {
            border-radius: .30rem;
        }

        h2 {
            color: #002046;
        }

        .card-info {
            background-color: white;
            border-radius: .5rem;
            /*gap: 5px;*/
        }

        @media (max-width: 575.98px) {
            .datepicker {
                background-color: white;
                width: 80% !important;
            }

            .datepicker table {
                width: 100% !important;
            }

            /*.col {*/
            /*    padding-right: 5px !important;*/
            /*    padding-left: 5px !important;*/
            /*}*/
            .form-group {
                margin-bottom: 0 !important;
            }

            .card-info {
                gap: 0 !important;
            }

            .card-body {
                padding: .5rem !important;
            }

            .list-group-item {
                padding: .5rem !important;
            }

            .contents {
                padding: .5rem !important;
            }
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
{{--    <script src="https://momentjs.com/downloads/moment.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="https://cdn.skypack.dev/date-fns"></script>
    <!-- jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

    <!-- html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <!-- canvas.js -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.br.min.js"></script>--}}
    <script>
        $(document).ready(function() {

            //Teste graphics
            const ctx = document.getElementById('myChart').getContext('2d');
            const dt = [];
            const graphics = []
            var myChart = {};



            // $('#fastFilter7').trigger("click");

            $('.datepicker').datepicker({
                language: "pt-BR",
                format: "dd/mm/yyyy",
                endDate: "date",
                todayHighlight: true,
                autoclose: true,
                locale: 'pt-br'
            })
                // .on('changeDate', function(ev){
                //     // dt['start'] = ev.date.toLocaleDateString();
                //     dt['start'] = $("#dtInicial").val()
                //
                //     console.log(ev.date.toLocaleDateString(), dt['start'])
                // });

            // $('#dtPkrStart').datepicker({
            //     closeText: 'Fechar',
            //     prevText: '<Anterior',
            //     nextText: 'Próximo>',
            //     currentText: 'Hoje',
            //     monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho',
            //         'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            //     monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
            //         'Jul','Ago','Set','Out','Nov','Dez'],
            //     dayNames: ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
            //     dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            //     dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
            //     weekHeader: 'Sm',
            //     dateFormat: 'dd/mm/yy',
            //     firstDay: 0,
            //     isRTL: false,
            //     showMonthAfterYear: false,
            //     yearSuffix: ''
            // });
        // } );

            $('.dtpkr').on('change', function (){
                $(".form-check-input").prop('checked', false);
            });

            async function postJSON(data) {
                try {
                    const response = await fetch("{{ route('central.traffic.average') }}", {
                        method: "POST", // or 'PUT'
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": $('meta[name="_token"]').attr('content')
                        },
                        body: JSON.stringify(data),
                    });

                    const result = await response.json();
                    const graphics = Object.entries(result.obj).map(([chave, valor]) => valor);

                    getDataGraphics(graphics)

                } catch (error) {
                    console.error("Error:", error);
                }
            }

            $('#formFilterGraphics').submit(function (e){
                e.preventDefault();
                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) {
                    chartStatus.destroy();
                    $("#loadingCharts").removeClass('d-none')
                }

                postJSON({'_token': $(this).serializeArray()[0].value,'dtStart': $(this).serializeArray()[1].value,'dtEnd': $(this).serializeArray()[2].value});
            })

            function getData(days){
                const dataAtual = new Date();
                const dataAtual2 = new Date();

                dataAtual.setDate(dataAtual.getDate() - days);

                document.getElementById("dtInicial").value = formatDate(dataAtual);
                document.getElementById('dtFinal').value = formatDate(dataAtual2);
            }

            function formatDate(dtInput){
                return `${dtInput.getDate().toString().padStart(2, '0')}/${(dtInput.getMonth() + 1).toString().padStart(2, '0')}/${dtInput.getFullYear()}`
            }

            (function startGraphics(){
                $('#fastFilter7').on('change', function (){
                    getData($(this).val())
                }).trigger("click")
                $('#formFilterGraphics').submit()
            })()

            $('#fastFilter7').on('change', function (){
                getData($(this).val())
            }).trigger("click")

            $('#fastFilter15').on('change', function (){
                getData($(this).val())
            })

            $('#fastFilter30').on('change', function (){
                getData($(this).val())
            })

            function bitsToMegabits(bits) {
                return bits / 1000000;
                // return bits / (8 * 1024 * 1024 * 1024);
            }

            function formatBytes(bytes) {
                // if (!+bytes) return '0 Bytes'
                //
                // const k = 1024
                // const dm = decimals < 0 ? 0 : decimals
                // const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']
                //
                // const i = Math.floor(Math.log(bytes) / Math.log(k))
                //
                // // return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))}`
                // return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`


                    var i = -1;
                    var byteUnits = [' kbps', ' Mbps', ' Gbps', ' Tbps', 'Pbps', 'Ebps', 'Zbps', 'Ybps'];
                    do {
                        bytes = bytes / 1024;
                        i++;
                    } while (bytes > 1024);

                    return Math.max(bytes, 0.1).toFixed(2);
                    // return Math.max(bytes, 0.1).toFixed(2)+ byteUnits[i];
            }

            // $('#downloadPdf').click(function(event) {
            //     // get size of report page
            //     var reportPageHeight = $('#reportPage').innerHeight();
            //     var reportPageWidth = $('#reportPage').innerWidth();
            //
            //     // create a new canvas object that we will populate with all other canvas objects
            //     var pdfCanvas = $('<canvas />').attr({
            //         id: "canvaspdf",
            //         width: reportPageWidth,
            //         height: reportPageHeight
            //     });
            //
            //     // keep track canvas position
            //     var pdfctx = $(pdfCanvas)[0].getContext('2d');
            //     var pdfctxX = 0;
            //     var pdfctxY = 0;
            //     var buffer = 100;
            //
            //     // for each chart.js chart
            //     $("canvas").each(function(index) {
            //         // get the chart height/width
            //         var canvasHeight = $(this).innerHeight();
            //         var canvasWidth = $(this).innerWidth();
            //
            //         // draw the chart into the new canvas
            //         pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
            //         pdfctxX += canvasWidth + buffer;
            //
            //         // our report page is in a grid pattern so replicate that in the new canvas
            //         if (index % 2 === 1) {
            //             pdfctxX = 0;
            //             pdfctxY += canvasHeight + buffer;
            //         }
            //     });
            //
            //     // create new pdf and add our new canvas as an image
            //     var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
            //     pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
            //
            //     // download the pdf
            //     pdf.save('filename.pdf');
            // });

            function getDataGraphics(graphics)
            {
                const labels = Object.keys(graphics[0]);
                const labels2 = Object.keys(graphics[0]).map(date => {
                    var dates = new Date(date)
                    dates.setDate(dates.getDate() + 1)
                    return dates.toLocaleDateString("pt-BR");
                });
                const downloads = labels.map(date => formatBytes(parseInt(graphics[0][date].download)));
                // const downloads = labels.map(date => graphics[0][date].download);
                // const downloads = labels.map(date => graphics[0][date].download);
                const uploads = labels.map(date => formatBytes(parseInt(graphics[0][date].upload)));
                // const uploads = labels.map(date => graphics[0][date].upload);
                // const uploads = labels.map(date => graphics[0][date].upload);
                console.log(downloads, uploads)

                myChart = new Chart(ctx, {
                    type: 'line',
                    // type: 'bar',

                    data: {
                        labels: labels2,
                        datasets: [
                            {
                                label: 'Download',
                                data: downloads,
                                backgroundColor: 'rgba(2, 15, 38, 0.7)',
                                borderColor: 'rgba(2, 15, 38, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Upload',
                                data: uploads,
                                backgroundColor: 'rgba(220, 53, 69, 0.7)',
                                borderColor: 'rgba(220, 53, 69, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Include a dollar sign in the ticks
                                    callback: function(value, index, ticks) {
                                        // return Chart.Ticks.formatters.numeric.apply(this, [value, index, ticks])+ ' Mbps';
                                        return value.toFixed(2)+ ' Mbps';
                                    }
                                }
                            },

                        },
                        animation: {
                            duration: 2000,
                            onProgress: function(context) {
                                if (context.initial) {
                                    console.log('animation inicial');
                                } else {
                                    console.log('animation inicial2');
                                }
                            },
                            onComplete: function(context) {
                                if (context.initial) {
                                    console.log('Initial animation finished');
                                } else {
                                    console.log('animation finished');
                                }
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Total de tráfego'
                            },
                            customCanvasBackgroundColor: {
                                color: 'white',
                            }
                            // tooltip: {
                            //     callbacks: {
                            //         label: function(context) {
                            //             let label = context.dataset.label || '';
                            //
                            //             // if (label) {
                            //             //     label += ': ';
                            //             // }
                            //             // if (context.parsed.y !== null) {
                            //             //     label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                            //             // }
                            //             return label+' GB';
                            //         }
                            //     }
                            // }
                        },

                    }
                });

//                 var a = document.createElement('a');
//                 a.href = myChart.toBase64Image();
//                 a.download = 'my_file_name.png';
//
// // Trigger the download
//                 a.click();



                // document.getElementById('some-image-tag').src = myChart.toBase64Image();

                $("#loadingCharts").addClass('d-none')
            }

            // var downloadChartJs = () => {
            //     html2canvas(document.getElementById("chartContainer"), {
            //         onrendered: function (canvas) {
            //             var img = canvas.toDataURL(); //image data of canvas
            //             var doc = new jsPDF();
            //             doc.addImage(img, 10, 10);
            //             doc.save('test2.pdf');
            //         }
            //     });
            // }
            //
            // document.getElementById("btnDownload").addEventListener("click", downloadChartJs);

            $('#btnDownload').on('click',function (){
                // document.getElementById('canvas-img').src = myChart.toBase64Image();
                //add event listener to button

//donwload pdf from original canvas
                    var canvas = document.querySelector('#myChart');
                    //creates image
                    var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

                    //creates PDF from img
                    var doc = new jsPDF('landscape');
                    doc.setFontSize(20);
                    doc.text(15, 15, "Cool Chart");
                    doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150 );
                    doc.save('canvas.pdf');

//add event listener to 2nd button
//                 document.getElementById('download-pdf2').addEventListener("click", downloadPDF2);

//download pdf form hidden canvas
//                 function downloadPDF2() {
//                     var newCanvas = document.querySelector('#supercool-canvas');
//
//                     //create image from dummy canvas
//                     var newCanvasImg = newCanvas.toDataURL("image/jpeg", 1.0);
//
//                     //creates PDF from img
//                     var doc = new jsPDF('landscape');
//                     doc.setFontSize(20);
//                     doc.text(15, 15, "Super Cool Chart");
//                     doc.addImage(newCanvasImg, 'JPEG', 10, 10, 280, 150 );
//                     doc.save('new-canvas.pdf');
//                 }
            })
        });


    </script>

@endsection
