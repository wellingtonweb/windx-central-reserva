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
    navigation:false,
    navigationText:["Fatura anterior","Próxima fatura"],
    pagination:false,
    autoPlay:false
});

async function copyBarcode3(btnThis){
    let code = btnThis.getAttribute("data-code")
    // console.log(code);
    await navigator.clipboard.writeText(code)
        .then(() => {
            notify('Copiado para área de transferência!')
        })
        .catch((err) => {
            notify('Falha ao copiar: '+ err);
            setTimeout(() => {
                location.reload()
            }, 1000)
        });
}

function displayMessageQuestionFinish(){
    clearInterval(callback)
    Swal.fire({
        title: 'Deseja realizar outro pagamento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: 'Não',
        timer: 10000,
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        },
        didOpen: () => {
            Swal.hideLoading()
        },
    }).then((result) => {
        if (result.isConfirmed) {
            clearAllSections()
            location.reload();
            //setTimeout(() => { callbackTransaction() }, 15000);
        } else if (result.dismiss || result.isDenied) {
            logout()
        }
    })
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
        console.log(document.body)
    }

    if (/^(interactive|complete)$/i.test(document.readyState)) {
        trigger();
    } else {
        document.addEventListener('DOMContentLoaded', trigger);
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
        html: '<p>'+error+'</p>',
        // footer: 'Favor informar ao administrador!',
        timer: 7000,
        showConfirmButton: false
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer || result.isDismissed || result.isConfirmed) {
            $('#form_checkout')[0].reset();
            $('#cart-card').modal('hide');
            displayMessageQuestionFinish()
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

function notify5(msgr){
    $('#modalMessageText').text(msgr)
    $('#modalMessage').modal('show')
    $('body').addClass('overflow-hidden')
    setTimeout(() => {
        $('#modalMessage').modal('hide')
        $('body').removeClass('overflow-hidden')
    }, 3000)
}

function getFirstName(str) {
    var arr = str.split(' ');
    var keep = arr[1][0].toUpperCase() != arr[1][0];
    return arr.slice(0, keep ? 2 : 1).join(' ');
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

        const total = parseFloat(vTit) + parseFloat(jurosCalculados) + parseFloat(multa);

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

function logout(){
    clearAllSections()
    $('.sideMenu').removeClass('open');
    $('.container-all').addClass('animate__animated animate__zoomOut animate__delay-1s');

    Swal.fire({
        icon: 'info',
        title: 'Agradecemos a sua visita!',
        timer: 2000,
        timerProgressBar: false,
        showConfirmButton: false,
        willClose: () => {
            $('.loading').removeClass('d-none')
            window.location = route_logout;
        }
    });
}

let inactivitySession = function () {
    let time;
    document.onkeypress = resetTimer;
    document.onmousedown = resetTimer; // touchscreen presses
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer;     // touchpad clicks
    // window.onload = resetTimer;
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
};

$('.container-fluid').trigger('click');

function setPaymentType(payment_type){
    switch (payment_type){
        case 'credit':
            return 'crédito';
            break;
        case 'debit':
            return 'débito';
            break;
        case 'picpay':
            return 'picpay';
            break;
        default:
            return 'PIX';
            break;
    }
}

function setPaymentMethod(method){
    switch (method){
        case 'ecommerce':
            return 'Central do Assinante';
            break;
        case 'tef':
            return 'Autoatendimento';
            break;
        default:
            return 'picpay';
            break;
    }
}



// $("#table-coupons-list tbody tr").on('click', function(){
//     $(this).find("a.btn-payment-details")[0].click();
// });

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

