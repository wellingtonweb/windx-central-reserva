window.onload = function(){
    if(window.location.pathname != '/cliente/login'){
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

getIp(function (ip) {
    $('#ip_address').val(ip);
    console.log(ip);
});

$('[data-toggle="tooltip"]').tooltip();

$(document).on('show.bs.tooltip', function (e) {
    if ($(e.target).data('trigger') == 'click') {
        var timeoutDataName = 'shownBsTooltipTimeout';
        if ($(e.target).data(timeoutDataName) != null) {
            clearTimeout($(e.target).data(timeoutDataName));
        }
        var timeout = setTimeout(function () {
            $(e.target).click();
        }, 5000);
        $(e.target).data(timeoutDataName, timeout);
    }
});

$(document).on('hide.bs.tooltip', function (e) {
    if ($(e.target).data('trigger') == 'click') {
        var timeoutDataName = 'shownBsTooltipTimeout';
        if ($(e.target).data(timeoutDataName) != null) {
            clearTimeout($(e.target).data(timeoutDataName));
        }
    }
});

function notify(message){
    let mod = $('#modal-notify');
    mod.modal('show')
    $('#modal-msg-text').html(message)
    window.setTimeout(function () {
        $('#modal-notify').modal('hide')
    }, 3000);
}

// document.addEventListener("DOMContentLoaded", function(){
//     window.addEventListener('scroll', function() {
//         if (window.scrollY > 50) {
//             //document.getElementById('navbar_top').classList.add('fixed-top');
//             // add padding top to show content behind navbar
//             navbar_height = document.querySelector('.navbar').offsetHeight;
//             document.body.style.paddingTop = navbar_height + 'px';
//         } else {
//             //document.getElementById('navbar_top').classList.remove('fixed-top');
//             // remove padding top from body
//             document.body.style.paddingTop = '0';
//         }
//     });
// });

var inactivitySession = function () {
    var time;
    window.onload = resetTimer;
    // DOM Events
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
    document.onmousedown = resetTimer; // touchscreen presses
    document.ontouchstart = resetTimer;
    document.onclick = resetTimer;     // touchpad clicks

    Swal.fire({
        icon: 'info',
        title: 'Sessão encerrada por inatividade',
        html: 'Agradecemos a sua visita!',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
    });
    logout();
    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 20000)
        console.log(time);
        // time = setTimeout(logout, 60000)
    }
};

function clearAllSections(){
    sessionStorage.clear()
}

$('#btn-logout').click(function (){
    logout();
});

function logout(){
    clearAllSections()
    $('.container-all').addClass('animate__animated animate__zoomOut animate__delay-2s');
    window.location = "/cliente/logout";
}
