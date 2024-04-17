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
                    <div class="header-app col-12 font-weight-bolder d-lg-none d-flex justify-content-between" >
                        <a href="javascript:history.back();"><i class="fas fa-arrow-left pr-3"></i></a>
                        <span>{{$header}}</span>
                        <span class="px-3"></span>
                    </div>
                    <div class="contract-info col-12 px-0">
                        <div class="cards d-flex flex-column flex-lg-row flex-md-row flex-sm-column bd-highlight mb-3">
                            <div class="card bg-white flex-fill">
                                <div class="card-body w-100">
                                    <h5 class="card-title font-weight-bold">Consumo em Tempo Real</h5>
                                    <p class="card-text">Login <b id="labelLogin">{{ session('customer.login') }}</b> conectado</p>
                                    <div id="reportPage2">
                                        <div id="loadingChartsTime" class="w-100">
                                            <i class="fas fa-spinner fa-2x fa-spin"></i>
                                        </div>
                                        <div id="chartContainerTime" class="container-fluid_ w-100 d-none">
                                            <canvas id="realTimeChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-white flex-fill">
                                <div class="card-body w-100">
                                    <h5 class="card-title font-weight-bold">Consumo por período</h5>
                                    <p class="card-text">Selecione o período desejado</p>
{{--                                    <div class="col-12">--}}
                                        <form id="formFilterGraphics">
                                            <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}"/>
{{--                                            <div id="labelFilter" class="d-flex justify-content-end align-items-center">--}}
{{--                                                Período:--}}
{{--                                            </div>--}}
                                            <div class="date input-group">
                                                <input type="text" placeholder="Data" name='period' id='period' class="form-control kt-input">
                                                <div class="input-group-append btn_calendar">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </form>
{{--                                    </div>--}}
                                    <div id="reportPage">
                                        <div id="loadingCharts" class="w-100">
                                            <i class="fas fa-spinner fa-2x fa-spin"></i>
                                        </div>
                                        <div id="chartContainer" class="container-fluid_ w-100">
                                            <canvas id="graphicsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-none container-fluid">
                            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 ">
                                <div class="col">
                                    <div class="card bg-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Consumo em Tempo Real</h5>
                                            <p class="card-text">Login <b id="labelLogin">{{ session('customer.login') }}</b> conectado</p>
                                            <div id="reportPage2">
                                                <div id="loadingChartsTime" class="w-100">
                                                    <i class="fas fa-spinner fa-2x fa-spin"></i>
                                                </div>
                                                <div id="chartContainerTime" class="container-fluid w-100 d-none">
                                                    <canvas id="realTimeChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card bg-white">
                                        <div class="card-body">
                                            <h5 class="card-title">Consumo por período</h5>
                                            <p class="card-text">Acompanhe o consumo de sua internet no período desejado</p>
                                            <div class="col-12">
                                                <form id="formFilterGraphics">
                                                    <input id="token" type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        Selecione o período:
                                                    </div>
                                                    <div class="date input-group">
                                                        <input type="text" placeholder="Data" name='period' id='period' class="form-control kt-input">
                                                        <div class="input-group-append btn_calendar">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="reportPage">
                                                <div id="loadingCharts" class="w-100">
                                                    <i class="fas fa-spinner fa-2x fa-spin"></i>
                                                </div>
                                                <div id="chartContainer" class="container-fluid w-100">
                                                    <canvas id="graphicsChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none row card-info_ mt-2">
                            <div class="col-lg-6 col-md-6 col-sm-12">

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">

                            </div>

                            {{--                            <div class="col-12">Grafico Tempo Real--}}
                            {{--                                <div id="reportPage2">--}}
                            {{--                                    <div id="loadingChartsTime" class="w-100">--}}
                            {{--                                        <i class="fas fa-spinner fa-2x fa-spin"></i>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div id="chartContainerTime" class="container-fluid w-100" style="height: 40vh">--}}
                            {{--                                        <canvas id="graphicsChartTime"></canvas>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/graphics.css') }}">
    <style>


        .daterangepicker .calendar-table th,
        .daterangepicker .calendar-table td {
            color: #888888;
        }

        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #357ebd;
            border-color: transparent;
            color: #fff !important;
        }

        #formFilterGraphics {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: .5rem 0;
            /*padding: .5rem 1rem;*/
        }

        #formFilterGraphics .date {
            width: 300px;
        }

        #formFilterGraphics .date {
            margin-left: 5px;
        }

        .contract-info .card {
            min-width: 50%;
            padding: 1rem;
        }

        canvas {
            min-height: 280px;
        }

        .contract-info .cards {
            gap: .5rem;
        }

        @media (max-width: 575.98px) {
            #labelFilter {
                display: none !important;
            }

            .daterangepicker.show-calendar .ranges {
                 margin-top: 0 !important;
            }

            #chartContainerTime canvas {
                display: inline !important;
                min-height: 140px !important;
            }
            #chartContainer canvas {
                min-height: 250px !important;
            }

            /*#formFilterGraphics .date {*/
            /*    width: 100% !important;*/
            /*}*/

            #formFilterGraphics {
                /*padding: 1rem;*/
                display: flex;
                flex-direction: column;
            }

            .daterangepicker {
                width: 300px !important;
            }

            .daterangepicker .drp-calendar {
                max-width: 300px !important;
            }

            .daterangepicker table tr td:nth-child(2),
            .daterangepicker table tr th:nth-child(2),
            .daterangepicker table tr td:nth-child(6),
            .daterangepicker table tr th:nth-child(6) {
                display: revert !important;
            }

            .daterangepicker td.off,
            .daterangepicker td.off.in-range,
            .daterangepicker td.off.start-date,
            .daterangepicker td.off.end-date {
                color: #dbdada !important;
            }

            .daterangepicker td{
                color: #357ebd;
            }

            /*.daterangepicker td.active,*/
            /*.daterangepicker td.active:hover {*/
            /*    background-color: #357ebd;*/
            /*    border-color: transparent;*/
            /*    color: #fff;*/
            /*}*/
            .daterangepicker td:hover,
            .daterangepicker td.available:hover,
            .daterangepicker th.available:hover {
                /*background-color: #eee;*/
                /*border-color: transparent;*/
                color: #357ebd !important;
            }

            .contract-info .card {
                min-width: 100% !important;
                gap: 20px 5px;
            }
        }



    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/FileSaver.js') }}"></script>
    <script>
        var data = {
            labels: [0],
            datasets: [
                {
                    label: 'Download',
                    data: [0],
                    borderColor: 'rgba(2, 45, 163, 1)',
                    backgroundColor: 'rgba(2, 45, 163, 1)',
                    lineTension: .5
                },
                {
                    label: 'Upload',
                    data: [0],
                    borderColor: 'rgba(220, 53, 69, 1)',
                    backgroundColor: 'rgba(220, 53, 69, 1)',
                    lineTension: .5
                },
            ]
        };

        var config = {
            type: 'line',
            data: data,
            options: {
                responsive: true
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, ticks) {
                            return value.toFixed(2)+ ' Mbps';
                        }
                    }
                },

            },
        }

        var realTimeChart = new Chart(
            document.querySelector('#realTimeChart'),
            config
        )

        setInterval(getRealTimeData, 5000);

        function getRealTimeData(){
            // const axios = require('axios');
            const realData = {
                login:'',
                download: 0,
                upload: 0
            }
            axios.get('/graficos2')
                .then(function (response) {

                    // handle success
                    console.log(response.data?.obj);
                    if(response.data?.obj != null){
                        realData.login = response.data?.obj.message.Username
                        realData.download = response.data?.obj.message.Download
                        realData.upload = response.data?.obj.message.Upload
                        setRealTimeData(realData)
                    }
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                    $('#loadingChartsTime').addClass('d-none')
                    $('#chartContainerTime').removeClass('d-none')
                });

        }
        getRealTimeData()

        function setRealTimeData(realData){
            data.labels.push(moment().format('HH:mm:ss'));
            console.log(realData)
            data.datasets[0].data.push(realData.download);
            data.datasets[1].data.push(realData.upload);
            realTimeChart.update();
        }
    </script>

    <script>
        let startDate = moment().format('DD/MM/YYYY')
        let dateEnd = moment().format('DD/MM/YYYY')

        $("#period").daterangepicker({
            timePicker: false,
            autoApply: true,
            opens: 'right',
            startDate: moment().format('DD/MM/YYYY'),
            endDate: moment().format('DD/MM/YYYY'),
            maxDate: moment(),
            locale: {
                "format": 'DD/MM/YYYY',
                "separator": ' - ',
                "applyLabel": 'Confirmar',
                "cancelLabel": 'Cancelar',
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez"
                ],
                "firstDay" : 0
            }
        });

        $("#period").on('apply.daterangepicker', function(e, picker) {
            e.preventDefault();
            startDate = picker.startDate.format('DD/MM/YYYY');
            dateEnd = picker.endDate.format('DD/MM/YYYY');
            $('#formFilterGraphics').submit()
        })

        // var file = new File(["Hello, world!"], "hello_world.txt", {type: "text/plain;charset=utf-8"});
        // saveAs(file);

        $('.btn_calendar').click(function (){
            $('#period').focus();
        })

        $(document).ready(function() {

            //Teste graphics
            const ctx = document.getElementById('graphicsChart').getContext('2d');
            const dt = [];
            const graphics = []
            var graphicsChart = {};


            // $('.dtpkr').on('change', function (){
            //     $(".form-check-input").prop('checked', false);
            // });

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
                const inputDtStart = startDate
                const inputDtEnd = dateEnd

                if(inputDtStart == '' || inputDtEnd == ''){
                    swal.fire('Informe corretamente o período desejado!')
                }else{
                    let chartStatus = Chart.getChart("graphicsChart"); // <canvas> id
                    if (chartStatus != undefined) {
                        chartStatus.destroy();
                        $("#loadingCharts").removeClass('d-none')
                    }

                    postJSON({'_token': $(this).serializeArray()[0].value,
                        'dtStart': startDate,
                        'dtEnd': dateEnd});
                }

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
                // $('#fastFilter7').on('change', function (){
                //     getData($(this).val())
                // }).trigger("click")
                $('#formFilterGraphics').submit()
            })()
            //
            // $('#fastFilter7').on('change', function (){
            //     getData($(this).val())
            // }).trigger("click")
            //
            // $('#fastFilter15').on('change', function (){
            //     getData($(this).val())
            // })
            //
            // $('#fastFilter30').on('change', function (){
            //     getData($(this).val())
            // })

            function bitsToMegabits(bits) {
                return bits / 1000000;
            }

            function formatBytes(bytes) {
                var i = -1;
                var byteUnits = [' kbps', ' Mbps', ' Gbps', ' Tbps', 'Pbps', 'Ebps', 'Zbps', 'Ybps'];
                do {
                    bytes = bytes / 1024;
                    i++;
                } while (bytes > 1024);

                return Math.max(bytes, 0.1).toFixed(2);
            }

            function getDataGraphics(graphics)
            {
                const labels = Object.keys(graphics[0]);
                const labels2 = Object.keys(graphics[0]).map(date => {
                    var dates = new Date(date)
                    dates.setDate(dates.getDate() + 1)
                    return dates.toLocaleDateString("pt-BR");
                });
                const downloads = labels.map(date => formatBytes(parseInt(graphics[0][date].download)));
                const uploads = labels.map(date => formatBytes(parseInt(graphics[0][date].upload)));

                graphicsChart = new Chart(ctx, {
                    // type: 'line',
                    type: 'bar',

                    data: {
                        labels: labels2,
                        datasets: [
                            {
                                label: 'Download',
                                data: downloads,
                                backgroundColor: 'rgba(2, 45, 163, 1)',
                                borderColor: 'rgba(2, 45, 163, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Upload',
                                data: uploads,
                                backgroundColor: 'rgba(220, 53, 69, 1)',
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
                                    callback: function(value, index, ticks) {
                                        return value.toFixed(2)+ ' Mbps';
                                    }
                                }
                            },

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

                        },

                    }
                });

                $("#loadingCharts").addClass('d-none')
            }
        });
    </script>
@endsection
