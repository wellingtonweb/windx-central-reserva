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
                                            <input type="text" placeholder="Data inicial" class="form-control" name="dtInicial" id="dtInicial">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pt-4">
                                    <div class="form-group">
                                        <div id="dtPkrEnd" class="datepicker date dtFinal input-group">
                                            <input type="text" placeholder="Data final" class="form-control" name="dtFinal" id="dtFinal">
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
                                <div class="col p-3">
                                    <button class="btn btn-primary mt-2" type="submit">Pesquisar</button>
                                </div>
                            </div>
                            <div class="row card-info mt-2">
                                <div class="col-12 ">
                                    <canvas id="myChart"></canvas>
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



    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.br.min.js"></script>--}}
    <script>
        $(document).ready(function() {
            //Teste graphics
            const ctx = document.getElementById('myChart').getContext('2d');
            const dt = [];
            const graphics = []

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

            $('#dtPkrStart').datepicker("setDate", new Date());

            var login = "097wdf";

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
                    console.log("Success:", result.obj);

                    const graphics = Object.entries(result.obj).map(([chave, valor]) => valor);

                    getDataGraphics(graphics)
                    console.log(graphics);


                } catch (error) {
                    console.error("Error:", error);
                }
            }

            $('#formFilterGraphics').submit(function (e){
                e.preventDefault();
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

            $('#fastFilter7').on('change', function (){
                getData($(this).val())
            })

            $('#fastFilter15').on('change', function (){
                getData($(this).val())
            })

            $('#fastFilter30').on('change', function (){
                getData($(this).val())
            })

            // new Chart(ctx, {
            //     type: 'bar',
            //     data: {
            //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            //         datasets: [{
            //             label: '# of Votes',
            //             data: [12, 19, 3, 5, 2, 3],
            //             borderWidth: 1
            //         }],
            //
            //     },
            //     options: {
            //         scales: {
            //             y: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });

            // Extrair datas, downloads e uploads
            function getDataGraphics(graphics){
                const labels = Object.keys(graphics[0]);
                const labels2 = Object.keys(graphics[0]).map(date => {
                    // return date
                    var dates = new Date(date)
                    return dates.toLocaleDateString("pt-BR");
                    // return format(new Date(date), 'dd/MM/yyyy', { locale: ptBR });
                });
                console.log(labels)
                const downloads = labels.map(date => graphics[0][date].download);
                const uploads = labels.map(date => graphics[0][date].upload);

                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels2,
                        datasets: [
                            {
                                label: 'Download',
                                data: downloads,
                                backgroundColor: 'rgba(2, 15, 38, 0.8)',
                                borderColor: 'rgba(2, 15, 38, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Upload',
                                data: uploads,
                                backgroundColor: 'rgba(220, 53, 69, 0.8)',
                                borderColor: 'rgba(220, 53, 69, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

        });
    </script>

@endsection
