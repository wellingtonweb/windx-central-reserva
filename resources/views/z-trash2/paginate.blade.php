@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <main role="main" class="p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <section>
                        <div class="text-windx bg-light">
                            <h2>Paginate</h2>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                </tr>
                                @foreach($data as $post)
                                    {{--                                {{dd($post)}}--}}
                                    <tr>
                                        <td>{{ $post['id'] }}</td>
                                        <td>{{ $post['title'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>
                        </div>

                    </section>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('css_old')
    <link rel="stylesheet" href="{{ asset('assets/css_old/print.coupon.css_old') }}">
@endsection

@section('js')
    {{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('assets/central/js/jquery-3.5.1.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('assets/central/js/bootstrap2.bundle.min.js') }}"></script>--}}


{{--    <script type="text/javascript" src="{{ asset('assets/central/js/printThis.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('assets/central/js/functions.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
    <script>
        // inactivitySession();

        $('#showPaymentsAll').click(function () {
            if ($('#table-coupons-list tr').hasClass('canceled') || $('#table-coupons-list tr').hasClass('created')){
                if($('#table-coupons-list tr').hasClass('d-none')){
                    $(this).html('<i class="fas fa fa-minus-square pr-1" aria-hidden="true"></i>Mostrar aprovados')
                    $('#table-coupons-list tr').removeClass('d-none')
                    $('#alert-coupons-zero').addClass('d-none')
                }else{
                    $(this).html('<i class="fas fa fa-plus-square pr-1" aria-hidden="true"></i>Mostrar todos')
                    $('#table-coupons-list tr').addClass('d-none')
                    $('#alert-coupons-zero').removeClass('d-none')
                }
            }
        });

        $('.btn-payment-details').click(function (){
            var row = $(this).closest('tr');
            var status = row.find('td:nth-child(8)').text().trim();
            // $('#details_payment_customer').text();
            $('#details_payment_id').text(row.find('td:nth-child(1)').text().trim());
            $('#details_payment_reference').text(row.find('td:nth-child(9)').text().trim());
            $('#details_payment_created_at').text(row.find('td:nth-child(4)').text().trim());
            $('#details_payment_billets').text(row.find('td:nth-child(2)').text().trim());
            $('#details_payment_type').text(row.find('td:nth-child(6)').text().trim());
            $('#details_payment_modality').text(row.find('td:nth-child(7)').text().trim());
            $('#details_payment_value').text('R$ '+row.find('td:nth-child(10)').text().trim());
            $('#details_payment_fees').text('R$ '+row.find('td:nth-child(11)').text().trim());
            $('#details_payment_amount').text(row.find('td:nth-child(5)').text().trim());
            $('#details_payment_status').text(status);

        })

        $('.coupon-pdf').click(function (){
            const id = $(this).attr('id')
            if(id != 'undefined' && id != null){
                $(this).children('i').removeClass('fa-download').addClass('fa-spinner fa-spin')
                Swal.fire({
                    title: 'Aguarde!',
                    html: 'Gerando comprovante!',
                    timer: 20000,
                    timerProgressBar: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
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
                    }
                })
                setTimeout(() => {
                    $(this).children('i').removeClass('fa-spinner fa-spin').addClass('fa-download')
                }, 5000)
            }
        });
    </script>
@endsection
