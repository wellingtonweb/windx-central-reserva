<div class="contact-client">
    <a href="#" id="btn-contact">
        <img src="{{asset('assets/img/whatsapp.svg')}}" alt="">
    </a>
</div>
<div id="card-contact" class="card card-contact animate__animated d-none">
    <button type="button" class="close" id="close-contact">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="card-img">
        <img src="{{asset('assets/img/logox.svg')}}" class="logo" alt="...">
{{--        <h6 class="font-weight-bold">WhatsApp Windx</h6>--}}
        <h6 class="font-weight-bold">Windx Telecomunicações</h6>
{{--        <small>Contato do WhatsApp</small>--}}
        <img src="{{asset('assets/img/qrcontact2.jpg')}}" class="qrcode-img"  alt="">
    </div>
    <div class="card-body">
        <p class="card-text">
            Escaneie o código com seu celular<br> ou clique no botão abaixo</p>
        <a href="{{ env('WHATSAPP_SERVICE') }}" target="_blank" class="btn btn-success btn-sm py-1 btn-block">WhatsApp Windx</a>
    </div>
</div>
