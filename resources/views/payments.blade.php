@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-5 mt-md-0">


                <main role="main" class="p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <section>

{{--                        {{dd($data)}}--}}

                        {{$test = 'Arrays teste'}}
                        <table id="example" class="display" style="width:100%; color: #ffffff">

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

        const urlCoupons = '{{route('central.coupons')}}'
        fetch(urlCoupons)
            .then((response) => response.json())
            .then((data) => {
                console.log('Data: ', data)
                console.log('Details: ', data.id)
                // $(document).ready(function() {
                    $('#example').DataTable({
                        data: data,
                        columns: [
                            { title: 'ID', data: 'id' },
                            { title: 'Customer', data: 'customer' },
                            { title: 'Referência', data: 'reference' }
                        ]
                    });
                // });

            });


    </script>
@endsection
