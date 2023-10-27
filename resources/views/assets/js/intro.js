$('.open_reset_password').click(function() {
    $('#form_login').fadeOut().hide();
    $('#form_reset_password').fadeIn(300).show();
});

$('.close_reset_password').click(function() {
    $('#form_reset_password').fadeOut().hide();
    $('#form_login').fadeIn(200).show();
});

$('#form_login').submit(async function (e){
    e.preventDefault();
    $('.loading').removeClass('d-none')

    let formData = $(this).serializeArray()
    let url = "/assinante/logon";
    $('#btn-login').fadeIn().text('Entrando...')

    setTimeout(() => {
        $('#btn-login').fadeIn().text('Validando...')
    }, 1000)

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

        if(data.error === undefined && response.status > 200){
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

        if(response.status > 200){

            $('#btn-login').text('Entrar')
            if(data.error.login){
                $('small.login_error').text(data.error.login)
            }else if(data.error.password){
                $('small.password_error').text(data.error.password)
            }else{
                shakeError('form-signin')
                if(response.status === 404){
                    Swal.fire({
                        title: data.error,
                        text: 'Solicite seu cadastro em nossa Central de Atendimento.',
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
                }else{
                    Swal.fire({title: data.error, icon: (response.status === 423 ? 'warning' : 'error' ), timer: 4000, timerProgressBar: false, showCloseButton: true})
                }
            }
        }

        if(response.status === 200){
            $('#container-logo').addClass('animate__animated animate__fadeOutUp');
            $('#footer').addClass('animate__animated animate__fadeOutDown');
            $(this)[0].reset();
            $('#btn-login').text('Entrar')
            $('.form-signin').removeClass('animate__fadeInUp').addClass('animate__fadeOutUpBig')
            $('.loader').removeClass('d-none');
            location.href = `/assinante/home`;
        }
    }catch(error) {
        console.log(error);
    }
})

$('#form_reset_password').submit(async function (e){
    e.preventDefault();
    let formData = $(this).serializeArray()
    let url = "/assinante/forgot-password";
    $('#btn-send-mail').text('Enviando...')


    await fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": formData[0].value
        },
        body: JSON.stringify({login: formData[1].value}),
    })
        .then((response) => response.json())
        .then((data) => {
            if(!data.error){
                $('#btn-send-mail').text('Enviar')
                Swal.fire({
                    icon: 'success',
                    title: 'Enviado com sucesso!',
                    html: data.message,
                    timer: 4000,
                    timerProgressBar: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        $(this)[0].reset();
                    },
                    willClose: () => {
                        $('.close_reset_password').click()
                    }
                })
            }else{
                $('#btn-send-mail').text('Enviar')
                shakeError('form-signin')
                $('small.login_reset_error').text(data.error)
                $('#inputLoginReset').addClass('is-invalid');

                if(data.message){
                    Swal.fire({
                        title: data.error,
                        text: data.message,
                        icon: 'warning',
                        confirmButtonColor: '#208637',
                        confirmButtonText: 'Central de Atendimento',
                        showCloseButton: true,
                        willClose: () => {
                            window.location.reload()
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("https://api.whatsapp.com/send?phone=558000282309&text=Desejo%20falar%20com%20atendimento%20Windx!");
                        }
                    })
                }
            }
        })
        .catch((error) => {
            $('#btn-send-mail').text('Enviar - Catch')
            shakeError('form-signin')
            Swal.fire({
                title: 'Ops, login não cadastrado!',
                text: 'Solicite seu cadastro em nossa Central de Atendimento.',
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
        });
})

function shakeError(elementClass)
{
    $('.'+elementClass).removeClass('animate__fadeInUp').addClass('animate__shakeX')
    setTimeout(() => {
        $('.'+elementClass).removeClass('animate__shakeX')
    }, 1000);
}

setTimeout(() => {
    $('.full-screen-splash').addClass('animate__animated animate__fadeOut_ animate__zoomOut d-none')
    $('.logo-windx').removeClass('d-none').addClass('animate__animated animate__fadeInDown')
    $('.form-signin').removeClass('d-none').addClass('animate__animated animate__fadeInUp')
    $('.mastfoot').removeClass('d-none').addClass('animate__animated animate__fadeInUp')
    $('.button-card-contact').removeClass('d-none').addClass('animate__animated animate__slideInRight')
}, "3000");
