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
                                <div class="col p-3 d-flex flex-column">
                                    <button class="btn btn-primary mt-2" type="submit"><i class="fas fa-search pr-2"></i>Pesquisar</button>
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
    <link rel="stylesheet" href="{{ asset('assets/css/pages/graphics.css') }}">
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script>
        $(document).ready(function() {

            //Teste graphics
            const ctx = document.getElementById('myChart').getContext('2d');
            const dt = [];
            const graphics = []
            var myChart = {};

            $('.datepicker').datepicker({
                language: "pt-BR",
                format: "dd/mm/yyyy",
                endDate: "date",
                todayHighlight: true,
                autoclose: true,
                locale: 'pt-br'
            })

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
                const inputDtStart = $("#dtInicial").val()
                const inputDtEnd = $("#dtFinal").val()

                if(inputDtStart == '' || inputDtEnd == ''){
                    swal.fire('Informe corretamente o período desejado!')
                }else{
                    let chartStatus = Chart.getChart("myChart"); // <canvas> id
                    if (chartStatus != undefined) {
                        chartStatus.destroy();
                        $("#loadingCharts").removeClass('d-none')
                    }

                    postJSON({'_token': $(this).serializeArray()[0].value,'dtStart': $(this).serializeArray()[1].value,'dtEnd': $(this).serializeArray()[2].value});
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

                myChart = new Chart(ctx, {
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
