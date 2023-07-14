@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <div class="row div-title">
                    <div class="col-12 animate__animated animate__fadeInDown animate__delay-1s">
                        <h3 class="page-title">Terminal de Autoatendimento</h3>
                        <h5 class="page-subtitle">Contratos</h5>
                    </div>
                </div>
                <main role="main" class="inner animate__animated animate__fadeInLeft animate__delay-1s">
                    <div class="row animate__animated animate__fadeIn central-home">
                        <div class="col-xl-6 col-lg-6 col-md-12">
                            <div class="cta-home">
{{--                                <h1 class="text-white display-4 fw-bold pe-lg-8">Seja bem vind{{$customer['gender'] == 'Feminino' ? 'a,' : 'o,'}}--}}
{{--                                    <span id="customer_full_name" class="font-weight-bold">{{  $customer['full_name']}}</span>!</h1>--}}
{{--                                <span class="pl-4 d-none">{{ $check_birth = \App\Services\Functions::checkBirth($customer['birth_date']) }}</span>--}}
                                <p class="text-white mb-4 lead">
                                    Se deseja pagar sua fatura, utilize o botão abaixo.
                                </p>
                                <a href="{{ Route('terminal.invoices') }}" class="btn btn-danger nav-click font-weight-bold">
                                    Faturas
                                </a>
                            </div>
                        </div>
                        <div class=" col-xl-6 col-lg-6 col-md-12 text-lg-end text-center pt-6">
                        </div>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection

@section('js')
{{--    <script type="text/javascript" src="{{ asset('assets/central/js/swiper-bundle.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('assets/central/js/swiper.custom.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>

    <script>
        {{--sessionStorage.setItem('section_id', '{{ $customer['id'] }}');--}}
        {{--sessionStorage.setItem('section_full_name', '{{ $customer['full_name'] }}');--}}



{{--    @if (trim($customer['email']) == 'teste@teste.com' || trim($customer['email']) == 'teste@teste.com.br')--}}
{{--        checkCookie();--}}
{{--    @endif--}}


    </script>
{{--@if ($check_birth == true)--}}
{{--    <script>--}}
{{--    Swal.fire('Feliz aniversário <br><br>'+sessionStorage.getItem('section_full_name')+'!');--}}
{{--    </script>--}}
{{--@endif--}}

@endsection
