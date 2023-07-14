/* Payment */
// const transaction_status = sessionStorage.getItem("transactionStatus");
// const transaction_id = sessionStorage.getItem("transactionId");

$('#cart-card').on('hidden.bs.modal', function (event) {
    //checkStatusTransaction();
//    msgStatusTransaction(status)
    //modalMsg('modalMessage','Aguarde!', 'Estamos processando o pagamento', true)
    clearAllSections()
    location.reload();
})

// Submit form card
$('#form_checkout_card').submit(function (e){
    e.preventDefault();
    let payment_type = $('#payment_type_card').val();
    let actionForm = $(this).attr('action');
    let methodForm = $(this).attr('method');
    let dataForm = $(this).serializeArray();
    let data = {};
    dataForm.forEach(i =>{
        data[i.name] = i.value;
    });
    data = JSON.stringify(data)
    console.log("Form serializado" + data)
    paymentCard(actionForm, methodForm, payment_type,data)
});

function paymentCard(actionForm, methodForm, payment_type, data){
    fetch(actionForm,
        {
            method: methodForm,
            body: data,
            mode:"cors",
            headers: {"Content-type":"application/json;charset=utf-8"}
        })
        .then(async response => { response.json()
            .then(data => {
                //copyCode(JSON.stringify(data))
                sessionStorage.setItem('transactionId', data.data.id)
                callbackTransaction()
                console.log(data.data)
                const count = Object.keys(data.data.billets).length
            })
        })
        .catch(error => console.log(error.message))
        .finally(() => console.log("Finalizado"));
    // Swal.fire({
    //     title: 'Aguarde!',
    //     html: methodForm == 'picpay' ? 'Gerando QRCode...':'Gerando pagamento...',
    //     icon: 'info',
    //     timer: 20000,//60000 = 1 min to scan
    //     timerProgressBar: true,
    //     showConfirmButton: false,
    //     didOpen: () => {
    //         Swal.showLoading()
    //     },
    //     willClose: () => {
    //         clearInterval(timerInterval)
    //     },
    //     allowOutsideClick: () => {
    //         const popup = Swal.getPopup()
    //         popup.classList.remove('swal2-show')
    //         setTimeout(() => {
    //             popup.classList.add('animate__animated', 'animate__headShake')
    //         })
    //         setTimeout(() => {
    //             popup.classList.remove('animate__animated', 'animate__headShake')
    //         }, 500)
    //         return false
    //     }
    // })

}

function serializeToObj(form){
    let data = {};
    form.forEach(item=>{
        data[item.name] = item.value;
    });
    return data;
}

function paymentQRCode(){
    var form = $('#form_checkout_qrcode');
    let payment_type = $('#payment_type').val();

    fetch(form.attr('action'),
        {
            method: form.attr('method'),
            body: JSON.stringify(
                {
                    _token: $('#token').val(),
                    customer: $('#customer').val(),
                    billets: $('#cartBillets').val(),
                    full_name: $('#full_name').val(),
                    email: $('#email').val(),
                    cpf_cnpj: $('#cpf_cnpj').val(),
                    phone: $('#phone').val(),
                    payment_type: $('#payment_type').val()
                }),
            mode:"cors",
            headers: {"Content-type":"application/json;charset=utf-8"}
        })
        .then(async response => { response.json()
            .then(data => {
                copyCode(JSON.stringify(data))
                sessionStorage.setItem('transactionId', data.data.id)
                callbackTransaction()
                console.log(data.data)
                const count = Object.keys(data.data.billets).length
                setQrcode(data.data.qrCode, payment_type, count)
            })
        })
        .catch(error => console.log(error.message))
        .finally(() => console.log("Done"));
    Swal.fire({
        title: 'Aguarde!',
        html: 'Gerando QRCode...',
        icon: 'info',
        timer: 20000,//60000 = 1 min to scan
        timerProgressBar: true,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading()
        },
        willClose: () => {
            clearInterval(timerInterval)
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
}

function setQrcode(data, payment_type, count){
    let timerInterval
    Swal.fire({
        title: 'Windx Telecomunicações',
        html: 'Pagamento de <strong>'+count+'</strong> boleto via <strong class="text-capitalize">'+payment_type+'</strong>' +
            '<img id="qrcode-img" class="w-75" src="'+data+'">' +
            '<p>Leia o QRCode com seu app</p>',
        timer: 20000,
        timerProgressBar: true,
        showConfirmButton: false,
        willClose: () => {
            clearInterval(timerInterval)
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
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            Swal.fire({
                title: 'Aguarde!',
                html: 'Processando pagamento...',
                // timer: 20000,
                // timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
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
        }
    })
}

function callbackTransaction(){
    const id = sessionStorage.getItem("transactionId");
    console.log('Transaction ID: '+id)
    if(id != 'undefined' && id != 0){
        fetch('/cliente/callback/'+id, { method: 'GET' })
            .then(response => response.json())
            .then(text => {
                //sessionStorage.setItem('transactionStatus', text.data.status)
                //checkStatusTransaction();
                msgStatusTransaction(text.data.status);
            })
            .catch(err => console.log(err.message))
    }
}

// function checkStatusTransaction(){
//     const status = sessionStorage.getItem('transactionStatus');
//     if (status === 'completed') {
//         msgStatusTransaction(status)
//         console.log('Pagou!')
//     } else {
//         msgStatusTransaction(status)
//         setTimeout(() => { callbackTransaction() }, 15000);
//     }
// }




function msgStatusTransaction(status){
    //const status = sessionStorage.getItem('transactionStatus');
    if(status){
        switch (status){
            case 'created':
                console.log('Pagamento criado!')
                setTimeout(() => { callbackTransaction() }, 15000);
                break;
            case 'expired':
                Swal.fire({
                    icon: 'error',
                    title: 'O prazo de pagamento expirou!',
                    timer: 5000,
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
                    clearAllSections()
                    questionMessage()
                })
                return false;
                break;
            case 'canceled':
                Swal.fire({
                    icon: 'error',
                    title: 'O pagamento foi cancelado!',
                    timer: 5000,
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
                    clearAllSections()
                    questionMessage()
                })
                return false;
                break;
            default:
                Swal.fire({
                    title: 'Pagamento realizado com sucesso!',
                    icon: "success",
                    timer: 7000,
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
                    questionMessage()
                })
                clearAllSections()
                return true;
                break;
        }
    }else{
        alert('Pagamento criado!')
        setTimeout(() => { callbackTransaction() }, 15000);
    }
}

let labelCopy;

function displayLabel(){
    labelCopy = setInterval(setLabelCopy, 2000);
}

function setLabelCopy(){
    $('#copy-key-pix-info').removeClass('d-none').html('Copiado com sucesso!')
}

async function copyCode(code){
    await navigator.clipboard.writeText(code)
        .then(() => {
            displayLabel();
            //document.getElementById(id).setAttribute('title', 'Copiado com sucesso!');
        })
        .catch((err) => {
            console.error('Falha ao copiar: ', err);
        });
}

$('#copy-key-pix').click(function(){
    $(this).addClass('d-none')
    let code = 'Texto copiado aqui do pix'
    copyCode(code);
})

function questionMessage(){
    Swal.fire({
        title: 'Deseja realizar outro pagamento?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sim',
        denyButtonText: 'Não',
        timer: 7000,
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            clearAllSections()
            location.reload();
            setTimeout(() => { callbackTransaction() }, 15000);
        } else if (result.dismiss || result.isDenied) {
            logout()
        }
    })
}

function logout(){
    clearAllSections()
    window.location = "/central/logout";
}


// $('#cart-qrcode').on('show.bs.modal', function (event) {
//     //var form = $('#form_checkout_qrcode');
//
//     if(form.attr('method') == "Pix"){
//         $('#copy-qrcode-container').removeClass('d-none');
//         $('#labelReadQrcode').addClass('d-none');
//     }
//     //var data = form.serialize()
//     //console.log($('#payment_type_qr').val())
//     fetch(form.attr('action'),
//         {
//             method: form.attr('method'),
//             body: JSON.stringify(
//                 {
//                     _token: $('#token').val(),
//                     customer: $('#customer').val(),
//                     billets: $('#cartBillets').val(),
//                     full_name: $('#full_name').val(),
//                     email: $('#email').val(),
//                     cpf_cnpj: $('#cpf_cnpj').val(),
//                     phone: $('#phone').val(),
//                     payment_type: $('#payment_type').val()
//                 }),
//             mode:"cors",
//             headers: {"Content-type":"application/json;charset=utf-8"}
//         })
//         .then(async response => { response.json()
//
//             .then(data => {
//
//                 setQrcode(data.data.qrCode)
//                 copyCode(JSON.stringify(data))
//                 sessionStorage.setItem('transactionId', data.data.id)
//                 callbackTransaction()
//                 console.log(data)
//             })
//         })
//         .catch(error => console.log(error.message))
//         .finally(() => console.log("Done"));
//
//     // counter($(this).attr('id'));
// })

// $('#cart-qrcode').on('hidden.bs.modal', function (event) {
//     //checkStatusTransaction();
// //    msgStatusTransaction(status)
//     //modalMsg('modalMessage','Aguarde!', 'Estamos processando o pagamento', true)
//
// })


// function counter(id_modal){
//     var i = 30//100
//     var counterBack = setInterval(function(){
//         i--;
//         if (i > 0){
//             $('.progress-bar').css_old('width', i+'%');
//         } else {
//             clearInterval(counterBack);
//             $('#'+id_modal).modal('hide');
//             $('.progress').addClass('animate animate__bounceOutLeft');
//         }
//     }, 600);
// }
