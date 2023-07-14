@extends('layouts.app')

@section('content')
    <main role="main" class="inner cover mt-md-3">
        <section>
            <div id="main" class="container-logon">
                <div class="loader animate__animated animate__fadeInUp d-none">
                    <h2>
                        <span>C</span>
                        <span>a</span>
                        <span>r</span>
                        <span>r</span>
                        <span>e</span>
                        <span>g</span>
                        <span>a</span>
                        <span>n</span>
                        <span>d</span>
                        <span>o</span>
                    </h2>
                </div>


                <label class="flip-container" for="switch">
                    <div class="flipper">
                        <div class="front">
                            <img src="https://picsum.photos/id/411/300/200" />
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary" for="switch">
                                    <input type="checkbox" id="switch" /> Checked
                                </label>
                            </div>
                        </div>
                        <div class="back">
                            <img src="https://picsum.photos/id/249/300/200" />
                        </div>
                    </div>
                </label>
            </div>
        </section>
    </main>

@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css_old/loader.css_old') }}">--}}
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/intro.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swal2.js') }}"></script>
    @if ($errors->has('document'))
        <script>
            let message = `{{$errors->first('document')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro '+400+'!',
                text: message,
                timer: 7000
            });
        </script>
    @elseif(session('error'))
        <script>
            let session = `{{session('error')}}`;
            Swal.fire({
                icon: 'error',
                title: 'Erro '+400+'!',
                text: session,
                timer: 7000
            });
        </script>
    @endif
@endsection
