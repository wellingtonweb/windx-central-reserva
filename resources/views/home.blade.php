@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container">

                <div class="row mt-3">
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                        <a href="{{route('central.contract')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="icon text-center text-custom h1 shadow rounded" >
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg>--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 24 24" width="1em">--}}
{{--                                          <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>--}}
{{--                                        </svg>--}}

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>

{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">--}}
{{--                                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>--}}
{{--                                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>--}}
{{--                                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>--}}
{{--                                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>--}}
{{--                                        </svg>--}}
                                    </span>
                                </div>
                                <div class="content mt-4">
                                    <h4 class="title">Contrato</h4>
                                    <p class="text-muted mt-3 mb-0">Visualise suas informações de cadastro, como endereço, plano e dados pessoais.</p>

                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg>--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                        <a href="{{route('central.contract')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
                                <div class="icon text-center text-custom h1 shadow rounded" >
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg>--}}
                                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 24 24" width="1em">--}}
                                        {{--                                          <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>--}}
                                        {{--                                        </svg>--}}

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">
                                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                    </span>
                                </div>
                                <div class="content mt-4">
                                    <h4 class="title">Pagamento</h4>
                                    <p class="text-muted mt-3 mb-0">Pague suas faturas com PIX, PICPAY, CRÉDITO, DÉBITO ou baixe a segunda via.</p>

                                </div>
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em"><rect width="20" height="15" x="2" y="3" class="uim-tertiary" rx="3"></rect><path class="uim-primary" d="M16,21H8a.99992.99992,0,0,1-.832-1.55469l4-6a1.03785,1.03785,0,0,1,1.66406,0l4,6A.99992.99992,0,0,1,16,21Z"></path></svg>--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin"  viewBox="0 0 18 18" width="1.2em">
                                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div><!--end col-->
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                        <a href="{{route('central.payments')}}" class="text-custom">
                            <div class="card service-wrapper rounded border-0 shadow p-4">
{{--                                <div class="d-sm-block">--}}
                                    <div class="icon text-center text-custom h1 shadow rounded">
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M15,2c-3.3772,0.00142-6.27155,2.41462-6.88025,5.73651c2.90693-1.59074,6.553-0.52375,8.14374,2.38317c0.98206,1.79462,0.98206,3.96594,0,5.76057c3.8013-0.69634,6.31837-4.3424,5.62202-8.14369C21.27662,4.41261,18.37925,1.99872,15,2z"></path><circle cx="7" cy="17" r="5" class="uim-primary"></circle><path class="uim-tertiary" d="M11,7c-3.08339,0.00031-5.66461,2.33759-5.97,5.40582c2.5358-1.08949,5.47469,0.08297,6.56418,2.61877c0.54113,1.25947,0.54113,2.68593,0,3.94541c3.29729-0.32786,5.7045-3.26663,5.37664-6.56392C16.66569,9.33735,14.08386,6.99972,11,7z"></path></svg>--}}
                                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">--}}
                                        {{--                                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>--}}
                                        {{--                                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>--}}
                                        {{--                                        </svg>--}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="content mt-4">
                                        <h4 class="title">Comprovantes</h4>
                                        <p class="text-muted mt-3 mb-0">Acompanhe suas faturas pagas ou baixe a segunda via de seus comprovantes.</p>

                                    </div>
{{--                                </div>--}}
                                <div class="big-icon h1 text-custom">
                                    <span class="uim-svg">
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" width="1em"><path class="uim-quaternary" d="M15,2c-3.3772,0.00142-6.27155,2.41462-6.88025,5.73651c2.90693-1.59074,6.553-0.52375,8.14374,2.38317c0.98206,1.79462,0.98206,3.96594,0,5.76057c3.8013-0.69634,6.31837-4.3424,5.62202-8.14369C21.27662,4.41261,18.37925,1.99872,15,2z"></path><circle cx="7" cy="17" r="5" class="uim-primary"></circle><path class="uim-tertiary" d="M11,7c-3.08339,0.00031-5.66461,2.33759-5.97,5.40582c2.5358-1.08949,5.47469,0.08297,6.56418,2.61877c0.54113,1.25947,0.54113,2.68593,0,3.94541c3.29729-0.32786,5.7045-3.26663,5.37664-6.56392C16.66569,9.33735,14.08386,6.99972,11,7z"></path></svg>--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-text" viewBox="0 0 18 18" width="1.2em">--}}
{{--                                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>--}}
{{--                                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>--}}
{{--                                        </svg>--}}

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 18 18" width="1.2em">
                                          <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                          <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div><!--end col-->
                    @if(session('customer')->status === 'B')
                    <div class="col-lg-3 col-md-6 col-12 mt-4 pt-2">
                            <a href="{{route('central.contract')}}" class="text-custom">
                                <div class="card service-wrapper rounded border-0 shadow p-4">
                                    <div class="icon text-center text-custom h1 shadow rounded" >
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em">
                                              <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="content mt-4">
                                        <h4 class="title">Desbloqueio</h4>
                                        <p class="text-muted mt-3 mb-0">Desbloqueie seu cadastro por até 48h, a fim de regularizar seus débitos.</p>
                                    </div>
                                    <div class="big-icon h1 text-custom">
                                        <span class="uim-svg">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-unlock" viewBox="0 0 18 18" width="1.2em">
                                              <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div><!--end col-->
                    @endif
                </div><!--end row-->
            </div>

        </section>
    </main>
@endsection

@section('css')
    <style>
        .windx-red {background-color:#E82528}
        .windx-red-70 {background-color:#ED454C}

        .service-container {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .icon {
            margin-top: 5%;
            font-size: 38px;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .icon-2 {
            height: 70px;
            width: 70px;
            line-height: 80px;
            border-radius: 64% 36% 55% 45% / 76% 72% 28% 24% !important;
            border-color: #f89d36 !important;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .icon-2 i {
            font-size: 30px;
        }

        .service-container .number-icon .number {
            position: absolute;
            top: 0;
            right: 70px;
            left: 0;
            height: 35px;
            width: 35px;
            margin: 0 auto;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container .number-icon .number span {
            line-height: 30px;
        }

        .service-container .content .number {
            font-size: 40px;
            color: #dee2e6;
        }

        .service-container .content .title {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container.hover-bg {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-container.hover-bg .smooth-icon {
            position: absolute;
            bottom: -40px;
            right: -20px;
            font-size: 60px;
            color: #f8f9fa;
            -webkit-transition: all 0.8s ease;
            transition: all 0.8s ease;
        }

        .service-container.hover-bg:hover {
            background-color: #f89d36;
        }

        .service-container.hover-bg:hover .content .title {
            color: #ffffff !important;
        }

        .service-container.hover-bg:hover .content .serv-pera {
            color: #fafafb !important;
        }

        .service-container.hover-bg:hover .smooth-icon {
            font-size: 100px;
            opacity: 0.2;
            bottom: -20px;
            right: 10px;
        }

        .service-container:hover {
            background-color: #ffffff;
            -webkit-box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
        }

        .service-container:hover .icon {
            color: #f89d36;
            -webkit-animation: mover 1s infinite alternate;
            animation: mover 1s infinite alternate;
        }

        .service-container:hover .number-icon .icon-2 {
            background-color: #f89d36;
            border-radius: 50% !important;
        }

        .service-container:hover .number-icon .icon-2 i {
            color: #ffffff !important;
        }

        .service-container:hover .number-icon .number {
            color: #ffffff;
            background: #f89d36 !important;
            border-color: #ffffff !important;
        }

        .service-container:hover .content .title {
            color: #f89d36;
        }

        .service-container a:hover,
        .service-container a .title:hover {
            color: #f89d36 !important;
        }

        @-webkit-keyframes mover {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-15px);
                transform: translateY(-15px);
            }
        }

        @keyframes mover {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-15px);
                transform: translateY(-15px);
            }
        }

        .service-wrapper {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-wrapper .icon {
            background-color: #e96a70;
            width: 60px;
            height: 60px;
            line-height: 45px;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;

            display: flex;
            justify-content: center; /* Alinhamento horizontal */
            align-items: center; /* Alinhamento vertical */
        }

        .service-wrapper .content .title {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            font-weight: 500;
        }

        .service-wrapper .big-icon {
            position: absolute;
            right: 0;
            bottom: 0;
            opacity: 0.05;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .service-wrapper:hover {
            -webkit-box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            box-shadow: 0 10px 25px rgba(47, 60, 78, 0.15) !important;
            background: #ffffff;
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
            border-color: transparent !important;
        }

        .service-wrapper:hover .icon {
            background: #ED454C !important;
            color: #ffffff !important;
        }

        .service-wrapper:hover .big-icon {
            z-index: -1;
            opacity: 0.1;
            font-size: 160px;
        }

        .text-custom {
            color: #ED454C !important;
        }

        .uim-svg {
            display: inline-block;
            /*height: 1em;*/
            vertical-align: -0.125em;
            font-size: inherit;
            fill: var(--uim-color, currentColor);
        }

    </style>
@endsection

@section('js')
    <script>

    </script>
@endsection
