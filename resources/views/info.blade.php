@extends('layouts.app')

@section('content')
    <main>
        <section>
            <div class="container-fluid mt-lg-3 mt-md-0">
                <div class="row contents p-1 inner animate__animated animate__fadeInUpBig animate__delay-1s">
                    <div id="infoCustomerActive" class="d-flex col-12 order-0 px-lg-0 px-md-1 mb-2">
                        <a href="{{route('central.home')}}" class="btn btn-secondary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"  class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path style="fill:white !important;" fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                            Voltar
                        </a>
                    </div>
{{--                    {{dd($customer)}}--}}
                    <div class="col-12">
                        <div class="row d-none" style="gap: 10px">
                            <div class="card-info col-md-4">
                                <h2>Heading</h2>
                                <p>Will you do the same for me? It's time to face the music I'm no longer your muse. Heard it's beautiful, be the judge and my girls gonna take a vote. I can feel a phoenix inside of me. Heaven is jealous of our love, angels are crying from up above. Yeah, you take me to utopia.</p>
                                <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                            </div>
                            <div class="card-info col-md-4">
                                <h2>Heading</h2>
                                <p>Standing on the frontline when the bombs start to fall. Heaven is jealous of our love, angels are crying from up above. Can't replace you with a million rings. Boy, when you're with me I'll give you a taste. There’s no going back. Before you met me I was alright but things were kinda heavy. Heavy is the head that wears the crown.</p>
                                <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                            </div>
                            <div class="card-info col-md-4">
                                <h2>Heading</h2>
                                <p>Playing ping pong all night long, everything's all neon and hazy. Yeah, she's so in demand. She's sweet as pie but if you break her heart. But down to earth. It's time to face the music I'm no longer your muse. I guess that I forgot I had a choice.</p>
                                <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Dados Pessoais</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Nome:
                                                <span class="text-black-50 text-right">{{ $customer->full_name }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                CPF/CNPJ:
                                                <span class="text-black-50 text-right">{{ $customer->document }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Data de nascimento:
                                                <span class="text-black-50 text-right">{{ date("d/m/Y", strtotime($customer->dt_trust)) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Endereço e Contato</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Endereço:
                                                <span class="text-black-50 text-right">{{ $customer->street }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Referência:
                                                <span class="text-black-50 text-right">{{ $customer->reference }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Cidade:
                                                <span class="text-black-50 text-right">{{ $customer->city }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                CEP:
                                                <span class="text-black-50 text-right">{{ $customer->cep }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Telefone:
                                                <span class="text-black-50 text-right">{{ $customer->phone }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Celular:
                                                <span class="text-black-50 text-right">{{ $customer->cell }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                E-mail:
                                                <span class="text-black-50 text-right">{{ $customer->email }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h4 class="card-title font-weight-bold">Dados da Conta</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Dia de Vencimento:
                                                <span class="text-black-50 text-right">15</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Cliente Desde:
                                                <span class="text-black-50 text-right">01/05/2004</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Status:
                                                @switch($customer->status)
                                                    @case('B')
                                                    <span class="badge badge-pill badge-danger">BLOQUEADO</span>
                                                    @break
                                                    @case('L')
                                                    <span class="badge badge-pill badge-primary">LIBERADO</span>
                                                    @break
                                                    @case('X')
                                                    <span class="badge badge-pill badge-secondary">DESATIVADO</span>
                                                    @break
                                                @endswitch
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        h2 {
            color: #002046;
        }

        .card-info {
            background-color: white;
            border-radius: .5rem;
            gap: 5px;
        }
    </style>

@endsection

@section('js')
{{--    <script type="text/javascript" defer>inactivitySession();</script>--}}

@endsection
