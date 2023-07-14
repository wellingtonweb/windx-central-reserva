window.onload = function(){
    if(window.location.pathname != '/terminal/login'){
        //checkCookie();
    }
}

function checkCookie(){
    var cadastro = getCookie("cadastro-"+sectionId);
    if (!cadastro){
        Swal.fire({
            html: 'Favor entrar em contato com nosso setor comercial para atualizar seu cadastro!',
            icon: 'info',
            showConfirmButton: true,
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
        }).then(function (result) {
            if (result.isConfirmed) {
                setCookie("cadastro-"+sectionId, "Atualizar cadastro", 1);
            }
        })
    }
}

function setCookie(chave,valor,validadeDias){
    var validade = new Date();
    validade.setTime(validade.getTime() + validadeDias*24*60*60*1000);
    var validadeUTC = "expires=" + validade.toUTCString();
    document.cookie = chave + "=" + valor + ";" + validadeUTC + ";path=/";
}

function getCookie(chave){
    var chaveIgual = chave + "=";
    var pares = document.cookie.split(";");
    for (let i = 0; i < pares.length; i++){
        var par = pares[i];
        while(par.charAt(0) == " "){
            par = par.substring(1);
        }
        if (par.indexOf(chaveIgual) == 0){
            return par.substring(chaveIgual.length);
        }
    }
    return "";
}

function getIp(callback)
{
    function response(s)
    {
        callback(window.userip);

        s.onload = s.onerror = null;
        document.body.removeChild(s);
    }

    function trigger()
    {
        window.userip = false;

        var s = document.createElement("script");
        s.async = true;
        s.onload = function() {
            response(s);
        };
        s.onerror = function() {
            response(s);
        };

        s.src = "https://l2.io/ip.js?var=userip";
        document.body.appendChild(s);
    }

    if (/^(interactive|complete)$/i.test(document.readyState)) {
        trigger();
    } else {
        document.addEventListener('DOMContentLoaded', trigger);
    }
}

$(document).ready(function(){
    $('.loading').addClass('d-none');

    /* Slider OLW Contracts JS  */
    $("#contracts-slider").owlCarousel({
        items : 3,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["Contrato anterior","Próximo contrato"],
        pagination:false,
        autoPlay:false
    });

    /* Slider OLW Invoice JS  */
    // $(".owl-carousel").owlCarousel({
    $("#news-slider").owlCarousel({
        items : 3,
        itemsDesktop:[1199,3],
        itemsDesktopSmall:[980,2],
        itemsMobile : [600,1],
        navigation:true,
        navigationText:["Fatura anterior","Próxima fatura"],
        pagination:false,
        autoPlay:false
    });

    // var swiper = new Swiper(".swiper_invoices", {
    //     slidesPerView: 3,
    //     centeredSlides: true,
    //     spaceBetween: 0,
    //     // pagination: {
    //     //     el: ".swiper-pagination",
    //     //     type: "fraction",
    //     // },
    //     navigation: {
    //         nextEl: ".swiper-btn-next",
    //         prevEl: ".swiper-btn-prev",
    //     },
    // });
});

function notify(message){
    Swal.fire({
        position: 'top',
        showConfirmButton: false,
        text: message,
        showClass: {
            popup: 'animate__animated animate__fadeInDownBig',
            backdrop: undefined
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUpBig'
        },
        timer: 5000
    })
}

function notifySystem(code, status, error){
    // notifySystem(data.status, data.responseJSON.status, data.responseJSON.error);

    Swal.fire({
        icon: status,
        title: 'Erro '+code+'!',
        text: error,
        footer: 'Favor informar ao administrador!',
        timer: 7000
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            $('#form_checkout_card')[0].reset();
            $('#cart-card').modal('hide');
            location.reload();
        }
    })
}

function notifyMessage(code, status, message){
    Swal.fire({
        icon: status,
        title: code > 200 ? 'Erro '+code+'!' : code,
        html: message,
        timer: 7000
    });
}

function convertDateTime(date) {
    const dateOld = new Date(date);
    const newDate = new Date(dateOld - (-180 * 60 * 1000));
    return newDate.toLocaleString();
}

function checkFavored(id){
    let favored = '';
    switch (id){
        case 1:
            favored = 'PENHA DE SOUZA JAMARIQUELI COMÉRCIOS E SERVIÇOS DE TELECOMUNICAÇÃO LTDA - CNPJ: 01.771.952/0001-71';
            break;
        case 5:
            favored = 'J. DE S. JAMARIQUELI COM. E SERVIÇOS DE COMUNICAÇÃO E TELECOMUNICAÇÃO ME - CNPJ: 10.528.742/0001-48';
            break;
        case 6:
            favored = 'ANTONIO CARLOS DE SOUZA JAMARIQUELI - CNPJ: 44.053.846/0001-65';
            break;
    }
    return favored;
}

function dateNow(){
    const date = new Date();
    console.log(date);
    const today = String((date.getDay()-1)).padStart(2, '0')+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
    return today;
}

function genInvoicePdf(id_btn, payment){
    let container = $('#container-invoice');
    console.log(id_btn)
    renderInvoice(id_btn)
    container.removeClass('d-none');
    html2canvas(document.querySelector("#container-invoice"))
        .then(canvas => {
            var imgData = canvas.toDataURL('image/jpeg');
            // var doc = new jsPDF('p','mm','a4');
            var doc = new jsPDF('p','mm',[210, 297]);
            doc.addImage(imgData, 'jpeg', 2, 2);
            doc.save('boleto.pdf');
        });
    container.addClass('d-none');
};

function renderInvoice(id_btn){
    const invoice = JSON.parse($(`#${id_btn}`).attr('data-invoice'));
    $('.i-numero-banco').html('| '+invoice.NumeroBanco+'-0 |');
    $('.i-local-pagamento').html(invoice.LocalPagamento);
    $('.i-vencimento').html(convertDateTime(invoice.Vencimento));
    $('.i-id-empresa').html(checkFavored(invoice.Id_Empresa));
    $('.i-cod-cedente').html(invoice.CodigoCedente);
    $('.i-data-emissao').html(convertDateTime(invoice.Data_Emissao));
    $('.i-data-processamento').html(dateNow());
    $('.i-nosso-numero').html(invoice.NossoNumero);
    $('.i-valor').html((invoice.Valor).toFixed(2).toString().replace(".",","));
    $('.i-nome').html(invoice.Nome);
    $('.i-cpf-cgc').html(invoice.CpfCgc);
    $('.i-endereco').html(invoice.Endereco+', '+invoice.Bairro+', '+invoice.Cidade+'-'+invoice.UF+'('+invoice.CEP+')');
    $('.i-seu-numero').html(invoice.SeuNumero);
    $('.i-linha-digitavel').html(invoice.LinhaDigitavel);
    JsBarcode(".i-barcode", invoice.CodigoBarras, {
        format: "ITF",
        lineColor: "#000000",
        width: 2,
        height: 90,
        marginTop: -15,
        fontSize: 40,
        displayValue: false
    });
}

function genCouponPdf(id, payment){
    let container = $('#container-coupon');
    renderDataCoupon(payment)
    container.removeClass('d-none');
    html2canvas(document.querySelector("#container-coupon"))
        .then(canvas => {
            var imgData = canvas.toDataURL('image/jpeg');
            // var doc = new jsPDF('p','mm','a4');
            var doc = new jsPDF('p','mm',[80.41, 235.65]);
            doc.addImage(imgData, 'jpeg', 2, 2);
            doc.save('comprovante_'+id+'.pdf');
        });
    container.addClass('d-none');
};

function renderDataCoupon(payment)
{
    const date = convertDateTime(payment.created_at);
    const billets = []
    $.each(payment.billets, function (key, value) {
        billets.push(' '+ value.reference)
    })

    $('#coupon_reference').html(payment.reference)
    $('#coupon_id').html(payment.id)
    $('#coupon_created_at').html(date)
    $('#coupon_billets').html(billets)
    $('#coupon_payment_type').html(payment.payment_type == 'credit'? 'Crédito': 'Débito')
    $('#coupon_value').html(payment.amount)
    $('#coupon_amount').html(payment.amount)
}

function logout(){
    clearAllSections()
    $('.container-all').addClass('animate__animated animate__zoomOut animate__delay-2s');
    Swal.fire({
        icon: 'info',
        title: 'Agradecemos a sua visita!',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false,
        willClose: () => {
            window.location = route_logout;
        }
    });
}

let inactivitySession = function () {
    let time;
    let url = window.location
    if (url != route_login) {
        window.onload = resetTimer;
        document.onkeypress = resetTimer;
        document.onmousedown = resetTimer; // touchscreen presses
        document.ontouchstart = resetTimer;
        document.onclick = resetTimer;     // touchpad clicks
        // logout();
        function resetTimer() {
            // clearTimeout(counterBack);
            clearInterval(time);
            var i = 100;
            time = setInterval(function () {
                i--;
                if (i > 0) {
                    $('.progress-bar-system').css('width', i + '%');
                } else {
                    clearInterval(time);
                    logout()
                }
            }, 1000);
        }
    }
};

// inactivitySession();

function timeOutLogin(){
    var counterBack;
    document.onkeypress = resetTimer2;
    document.onmousedown = resetTimer2; // touchscreen presses
    document.ontouchstart = resetTimer2;
    document.onclick = resetTimer2;     // touchpad clicks
    function resetTimer2() {
        clearInterval(counterBack);
        var i = 100;
        counterBack = setInterval(function () {
            i--;
            if (i > 0) {
                $('.progress-bar').css('width', i + '%');
            } else {
                clearInterval(counterBack);
                $('.card-login').removeClass('is-flipped');
            }
        }, 500);
    }
}


function date_to_utc(date) {
    const date_utc = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate());
    return date_utc;
}

function date_to_br(date) {
    const date_utc = Date.UTC(date.getFullYear(), date.getMonth(), date.getDate());
    return date_utc;
}

function dias_atraso(date1, date2) {
    const date1utc = date_to_utc(date1);
    const date2utc = date_to_utc(date2);
    day = 1000 * 60 * 60 * 24;

    //Math.abs(value) -> Converte negativo para positivo
    return (date2utc - date1utc) / day
}

function calculaMulta(valor) {
    return ((valor * 2) / 100)
}

function calculaJuros(vencimento, valor) {

    const date1 = new Date(),
        date2 = new Date(vencimento),
        atraso = dias_atraso(date1, date2)
    let dados = {}
    let multa = 0, jurosCalculados = 0

    const vTit = Number(valor);

    if (atraso < 0) { //apenas calcula juros quando há dias em atraso
        jurosCalculados = Number((vTit * 0.2) / 100 * Math.abs(atraso));
        multa = Number(calculaMulta(valor).toFixed(2))

        // console.log('Dias atraso: '+Math.abs(atraso))
        // console.log('Juros: '+jurosCalculados.toFixed(2)  +' - '+ typeof(jurosCalculados))
        // console.log('Multa: '+multa.toFixed(2) +' - '+ typeof(multa) )
        // console.log('Valor: '+vTit.toFixed(2) +' - '+ typeof(vTit) )
        const total = parseFloat(vTit) + parseFloat(jurosCalculados) + parseFloat(multa);
        // const total = vTit + jurosCalculados + multa;

        dados = {
            'dias_atraso': Math.abs(atraso),
            'juros': jurosCalculados.toFixed(2),
            'multa': multa.toFixed(2),
            'valor': vTit.toFixed(2),
            'total': total.toFixed(2),
        }
    } else {
        dados = {
            'dias_atraso': 0,
            'juros': 0,
            'multa': 0,
            'valor': vTit.toFixed(2),
            'total': vTit.toFixed(2),
        }
    }
    return dados;

}


function clearAllSections(){
    sessionStorage.clear()
}

$('.btn').click(function (){
    $(this).addClass('scale-btn');
    setTimeout(() => {
        $(this).removeClass('scale-btn')
    }, 90)
});


$('#btn-logout').on('click', function() {
    console.log('Deslogou!')
    $('#principal').addClass('animate__animated animate__zoomOut');
    $('#header').addClass('animate__animated animate__fadeOutUp');
    $('#footer').addClass('animate__animated animate__fadeOutDown');
    logout();
});
