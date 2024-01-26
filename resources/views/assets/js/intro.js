$('.open_reset_password').click(function() {
    $('small.text-danger').text('');
    // $('#form_forgot_password')[0].reset();
    // $('#form_forgot_password').prop("disabled", false).fadeIn(300).show();
    $('input').removeClass('is-invalid');
});

$('.close_reset_password').click(function() {
    $('small.text-danger').text('');
    // $('#form_login')[0].reset();
    // $('#form_login').prop("disabled", false).fadeIn(200).show();
    $('input').removeClass('is-invalid');
});

$('#form_login').submit(async function (e){
    e.preventDefault();
    $('.loading').removeClass('d-none')
    $('small.text-warning').text('');

    let formData = $(this).serializeArray()
    let url = "/logon";
    $('#btn-login').fadeIn().html("<span class='pr-2'>Validando <i class='fas fa-spinner fa-pulse'></i></span>")

    try {
        let response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": formData[0].value
            },
            body: JSON.stringify({
                login: formData[1].value,
                password: formData[2].value,
            }),
        });
        let data = await response.json();

        console.log('Status: ', response.status);

        shakeError('form-signin')
        if(response.status == 419)
        {
            // Swal.fire({
            //     title: 'Sessão expirada!',
            //     icon: 'info',
            //     timer: 60000,
            //     showConfirmButton: false,
            //     willClose: () => {
            //         location.reload();
            //     }
            // })
        }

        if(data.error === undefined && response.status > 200){
            $('#btn-login').text('Entrar')
            Swal.fire({
                title: '403 - Serviço indisponível!',
                html: "Informe em nossa<br> Central de Atendimento.",
                icon: 'error',
                confirmButtonColor: '#208637',
                confirmButtonText: 'Central de Atendimento',
                showCloseButton: true,
                willClose: () => {
                    $(this)[0].reset();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                }
            })
        }

        if(response.status > 200)
        {


            if(data.error.login)
            {
                $('small.login_error').text(data.error.login)
            }
            if(data.error.password)
            {
                $('small.password_error').text(data.error.password)
            }
            if(response.status != 422){
                Swal.fire({
                    title: data.error,
                    text: 'Confirme seus dados de acesso em nossa Central de Atendimento.',
                    icon: 'warning',
                    confirmButtonColor: '#208637',
                    confirmButtonText: 'Central de Atendimento',
                    showCloseButton: true,
                    willClose: () => {
                        $(this)[0].reset();
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                    }
                })
            }
        }

        if(response.status === 200){
            $('#container-logo').addClass('animate__animated animate__fadeOutUp');
            $('#btn-contact').addClass('animate__animated animate__fadeOutRight');
            $('#footer').addClass('animate__animated animate__fadeOutDown');
            $(this)[0].reset();
            $('#btn-login').text('Entrar')
            $('#main').removeClass('animate__fadeInUp').addClass('animate__fadeOutUpBig')
            $('.loader').removeClass('d-none');
            location.href = `/home`;
        }
    }catch(error) {
        //console.log(error);
    }
})

function shakeError(elementClass)
{
    $('#btn-login').fadeIn().text('Entrar')
    $('.'+elementClass).removeClass('animate__fadeInUp').addClass('animate__shakeX')
    setTimeout(() => {
        $('.'+elementClass).removeClass('animate__shakeX')
    }, 1000);
}

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

$(".reload").click(function () {
    $(".captcha img").click();
    $(this).addClass("fa-spin");
    setTimeout(() => {
        $(this).removeClass("fa-spin")
    }, 800);
})

setTimeout(() => {
    $('.full-screen-splash').addClass('animate__animated animate__fadeOut_ animate__zoomOut d-none')
    $('.logo-windx').removeClass('d-none').addClass('animate__animated animate__fadeInDown')
    $('#main').addClass('animate__animated animate__fadeInUp')
    document.getElementById('main').style.display = 'flex';
    $('.mastfoot').removeClass('d-none').addClass('animate__animated animate__fadeInUp')
    $('.button-card-contact').removeClass('d-none').addClass('animate__animated animate__slideInRight')
}, "3000");
