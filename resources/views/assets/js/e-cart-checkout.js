let tries = 0;
let paymentType = '';
var callback = '';
let transactionId  = null;
let responseObj = null;

function getPaymentText(payment_type){
    switch (payment_type){
        case 'credit':
            return 'cartão de crédito';
            break;
        case 'debit':
            return 'cartão de débito';
            break;
        case 'picpay':
            return 'Picpay';
            break;
        default:
            return 'PIX';
            break;
    }
}

$('#cc-numero').blur(function (){
    $(this).val($(this).val().replace(/\D/g, ''))
})

$('#cc-cvv').blur(function (){
    $(this).val($(this).val().replace(/\D/g, ''))
});

$('#modalCard').on('show.bs.modal', function (event) {
    Swal.close();
    countdown();
})

$('#modalCard').on('hidden.bs.modal', function (event) {
    resetCardFields();
    clearAllSections()
    refreshSliderCards()
    clearInterval(callback)
})

$('#btnCloseModalCard').click(function (){
    msgStatusTransaction('canceled')
});

function resetCardFields() {
    $('#cc-nome').val('');
    $('#cc-numero').val('');
    $('#expiration_month option:first').prop('selected',true).trigger("change");
    $('#expiration_year option:first').prop('selected',true).trigger("change");
    $('#cc-bandeira option:first').prop('selected',true).trigger("change");
    $('#cc-cvv').val('');
    $('#form_checkout').find('small').text('')
    $('#form_checkout').find('input').removeClass('is-invalid')
    $('.text-display-error').addClass('d-none').html('')
}

/* Button payment type */
function getPaymentType(e){
    switch (e.id){
        case 'btn-picpay':
        case 'btn-pix':
            $('#payment_type').val((e.id == 'btn-picpay'?'picpay':'pix'));
            $('#method').val((e.id == 'btn-picpay'?'picpay':'ecommerce'));
            resetCardFields();
            $('#form_checkout').submit();
            break
        default:
            e.id == 'btn-debit'? getAccessToken() : '';
            paymentType = (e.id == 'btn-credit'?'credit':'debit');
            $('#payment_type').val((e.id == 'btn-credit'?'credit':'debit'));
            $('#method').val('ecommerce');
            $('#modalCard').modal('show');
            break
    }
}

/* Submit form checkout */
$('#form_checkout').submit(function (e){
    e.preventDefault();
    let dataForm = $(this).serializeArray();
    if(dataForm['1'].value == ''){
        displayMessageErrorPayment('Erro: 422 - Dados inválidos')
    }
    let payment = {
        'paymentType': $('#payment_type').val(),
        'actionForm': $(this).attr('action'),
        'methodForm': $(this).attr('method'),
        'dataForm': $(this).serialize(),
        'methodCheckout': dataForm['8'].value,
    }
    if(payment != null){
        sessionStorage.setItem('payment', JSON.stringify(payment));
        sendPayment(payment)
    }else{
        clearAllSections()
        displayMessageErrorPayment('Sessão de pagamento inválida!')
    }

});

function callbackTransaction(id)
{
    if (id != null && transactionId != null) {
        $.ajax({
            url: base_url + 'callback/' + id,
            type: "GET",
            dataType: "JSON",
            data: JSON.stringify({}),
            success:function (data){
                if(data.status === 'approved'){
                    resetCardFields();
                }
                msgStatusTransaction(data.status)
                resetTimer()
            }
        })
    }else{
        return;
    }
}

/* Send payment */
function sendPayment(payment){
    $(document).find('small.error-text').text('');

    $.ajax({
        type: payment.methodForm,
        url: payment.actionForm,
        data: payment.dataForm,
        beforeSend: function (){
            Swal.fire({
                title: 'Pagamento com '+getPaymentText(payment.paymentType),
                html: (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') ? 'Gerando qrcode...':'Validando dados...',
                timer: 60000,
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
                },
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    displayMessageErrorPayment('Servidor indisponível')
                }
            })
        },
        success: function(response, textStatus, xhr) {
            console.log(response, textStatus, xhr.status)

            if(xhr.status === 200 || xhr.status === 201){
                localStorage.setItem('transactionId', response.id)
                transactionId = localStorage.getItem("transactionId");
                if (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') {
                    setQrcode(response)
                    runCallBack();
                }else{
                    // if(response.status === 'approved')
                    // {
                    //     $('#modalCard').modal('hide')
                    //     msgStatusTransaction(response.status)
                    // }else{
                        $('#modalCard').modal('hide')
                        // transactionId = null
                        clearAllSections()
                        msgStatusTransaction(response.status)
                    // }
                }
            }else{
                msgStatusTransaction(response.status)
                $('#modalCard').modal('hide')
            }
        },
        error: function(data) {
            if(data.status === 422){

                console.log('Error')
                // Swal.fire({
                //     icon: 'error',
                //     title: 'Erro nos dados de pagamento!',
                //     timer: 15000,
                //     timerProgressBar: false,
                //     confirmButtonText: 'Ok',
                //     showDenyButton: false,
                //     didOpen: () => {
                //         Swal.hideLoading()
                //         clearInterval(callback)
                //         clearAllSections()
                //     },
                // })
            }
            if(!data.responseJSON){
                Swal.fire({
                    icon: 'error',
                    title: 'Preencha campos corretamente!',
                    timer: 15000,
                    timerProgressBar: false,
                    confirmButtonText: 'Ok',
                    showDenyButton: false,
                    didOpen: () => {
                        Swal.hideLoading()
                        clearInterval(callback)
                        clearAllSections()
                    },
                })
            }else{
                if(data.responseJSON.error) {
                    notifySystem(data.status, data.responseJSON.status, data.responseJSON.error);
                } else {
                    $.each(data.responseJSON.errors, function (key, value) {
                        if(!$('input[name='+key+']').is( ":hidden" )){
                            $('small.'+key+'_error').text(value[0]);
                            Swal.fire({
                                icon: 'error',
                                title: 'Preencha campos corretamente!',
                                timer: 15000,
                                timerProgressBar: false,
                                confirmButtonText: 'Ok',
                                showDenyButton: false,
                                didOpen: () => {
                                    Swal.hideLoading()
                                    clearInterval(callback)
                                    clearAllSections()
                                },
                            })
                            $('input[name='+key+']').addClass('is-invalid');
                        }
                    });
                }
            }
        }
    });
}

/* Display qrcode for payment */
function setQrcode(payment){

    let amount = (payment.amount).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});

    Swal.fire({
        title: `Pagamento nº ${payment.id} com ${(payment.payment_type == 'pix' ? 'PIX' : 'PICPAY')}`,
        html: `
            <div id="modal-qrcode" class="bg-white text-center justify-content-center">
                <div class="box-price-qrcode-card">
                    <h4 class="text-danger pt-2 font-weight-bold">Valor total: <span>${amount}</span></h4>
                    <p>Faturas selecionadas: <span class="font-weight-bold total-count"></span></p>
                </div>
                <small class="pt-2 text-black-50 ${(payment.payment_type == 'pix' ? '' : 'd-none')}">
                Utilize seu app de pagamento para ler o qrcode <br> ou a código pix copia e cola abaixo
                </small>
                <small class="pt-2 text-black-50 ${(payment.payment_type == 'pix' ? 'd-none' : '')}">
                Utilize seu Picpay para ler o qrcode <br>ou o link de pagamento abaixo
                </small>
                <div id="container-qrcode">
                    <small id="timerPaymentQrCode" class="text-danger"><b></b></small>
                    <div class="body-popup-qrcode">
                        <div class="qrcode-container">
                            <img id="qrcode-img" src="${payment.qrCode}">
                        </div>
                    </div>
                    <div class="form-floating group-pix-copy-paste d-none">
                        <input type="text" class="form-control" value="${payment.copyPaste}" />
                        <label for="pixcopypaste">Código do Pix Copia e Cola</label>
                    </div>
                    <div class="py-1">
                        <a href="javascript:void(0)"
                        id="btnPixCopyCode"
                        class="mt-2_ animate__animated text-primary d-none"
                        onclick="pixCopyPaste(this)" data-code="${payment.copyPaste}">
                       <i class="fas fa-copy pr-1"></i>Copiar código do PIX
                        </a>
                    </div>
                    <div class="py-1">
                        <a href="${payment.paymentUrl}" target="_blank"
                        id="btnPicpayLink"
                        class="mt-2_ animate__animated text-primary ${(payment.payment_type == 'pix' ? 'd-none' : '')}">
                        Quero pagar com link de pagamento!
                        </a>
                    </div>
                </div>
                <p id="labelWaitingPayment" class="mt-2 text-black-50 animate__animated animate__fadeIn d-none"></p>
            </div>
            `,
        timer: 120000,//2min
        timerProgressBar: false,
        showConfirmButton: false,
        showDenyButton: true,
        denyButtonText: '<i class="fas fa fa-times pr-1" aria-hidden="true"></i>CANCELAR',
        denyButtonColor: '#d33',
        didOpen: () => {
            resetTimer()
            displayCart()
            Swal.hideLoading()
            if(payment.payment_type == 'pix'){
                $('#btnPixCopyCode').removeClass('d-none');
                $('.group-pix-copy-paste').removeClass('d-none');
            }

            const b = Swal.getHtmlContainer().querySelector('b')

            timerInterval = setInterval(() => {
                const timerLeftInSeconds = Swal.getTimerLeft() / 1000;
                const minutes = Math.floor(timerLeftInSeconds / 60);
                const seconds = Math.floor(timerLeftInSeconds % 60);
                const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
                const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;

                b.textContent = `${formattedMinutes}:${formattedSeconds}`;
                if(formattedSeconds == '00'){
                    $('#timerPaymentQrCode').fadeOut();
                }
            }, 100);
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
        },
    })
        .then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            waitingPayment()
        } else
        if(result.isDenied) {
            clearAllSections()
            transactionId = null;
            clearInterval(callback)
            msgStatusTransaction('canceled')
        }
    })
}

/* Functions Display Messages */
function msgStatusTransaction(status){
    if(status){
        switch (status){
            case 'approved':
                // clearInterval(callback)
                clearAllSections()
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento confirmado com sucesso!','success', 15000)
                return true;
                break;
            case 'expired':
                // clearInterval(callback)
                clearAllSections()
                refreshSliderCards()
                displayMessageStatusTransaction('Tempo expirado!','error', 5000)
                return false;
                break;
            case 'refused':
                // clearInterval(callback)
                clearAllSections()
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento recusado!','error', 5000)
                return false;
                break;
            case 'canceled':
                // clearInterval(callback)
                clearAllSections()
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento cancelado!','error', 5000)
                return false;
                break;
            case 'created':
                return false;
                break;
            default:
                return false;
        }
    }else{
        displayMessageStatusTransaction('Não houve nenhum pagamento criado!','error', 5000)
    }
}

function runCallBack()
{
    callback = setInterval(function () {
        if (transactionId != null) {
            callbackTransaction(transactionId)
        }else{
            clearAllSections()
            clearInterval(callback)
            return;
        }
    }, 5000);
}

transactionId = localStorage.getItem("transactionId");

if (transactionId != null && (paymentType != 'credit' || paymentType != 'debit' || paymentType != undefined )) {
    waitingPayment()
}else{
    clearAllSections()
}

function waitingPayment(){
    Swal.fire({
        title: 'Pagamento Nº '+transactionId,
        text: 'Aguardando a confirmação...',
        icon: 'info',
        timer: 90000,
        timerProgressBar: true,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: '<i class="fas fa fa-times pr-1" aria-hidden="true"></i>CANCELAR',
        cancelButtonColor: '#d33',
        didOpen: () => {
            runCallBack()
        },
        willClose: () => {
            clearAllSections()
            transactionId = null;
            clearInterval(callback)
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
            msgStatusTransaction('expired')
        } else if(result.isDenied || result.isDismissed) {
            msgStatusTransaction('canceled')
        }
    })
}

function displayMessageErrorPayment(title){
    Swal.fire({
        icon: 'error',
        title: title,
        html: '<h4>Não foi possível concluir o pagamento!</h4>',
        timer: 5000,
        timerProgressBar: false,
        confirmButtonText: 'Ok',
        showDenyButton: false,
        didOpen: () => {
            Swal.hideLoading()
            clearInterval(callback)
            clearAllSections()
        },
        willClose: () => {
            $('#modalCard').modal('hide')
            displayMessageQuestionFinish()
        }
    })
}

function displayMessageError(title){
    Swal.fire({
        icon: 'error',
        title: title,
        timer: 15000,
        timerProgressBar: false,
        confirmButtonText: 'Ok',
        showDenyButton: false,
        didOpen: () => {
            Swal.hideLoading()
            clearInterval(callback)
            clearAllSections()
        },
        willClose: () => {
            displayMessageQuestionFinish()
        }
    })
}

function displayMessageStatusTransaction(dTitle, dIcon, dTimer){
    // var idPayment =
    var dButton =
        `<a href="${base_url}comprovante/${transactionId}/download" onclick="downloadClick()"
        class="download-pdf btn btn-primary btn-sm" target="_blank">
            <i class="fa fa-download pr-1"></i>
            Baixar comprovante
        </a>`;

    Swal.fire({
        title: dTitle,
        icon: dIcon,
        timer: dTimer,
        didOpen: () => {
            Swal.hideLoading()
            transactionId = null;
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
        },
        willClose: () => {
            refreshSliderCards()
            clearAllSections()
            if(dIcon === 'success'){
                console.log('Botão', dButton);
                Swal.fire({
                    title: 'Download do comprovante',
                    icon: 'info',
                    timer: 60000,
                    html: "Baixe seu comprovante ou acesse em Comprovantes para obter a 2ª via.<br><br>"+dButton,
                    didOpen: () => {
                        Swal.hideLoading()
                        clearInterval(callback)
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
                    },
                    willClose: () => {
                        displayMessageQuestionFinish()
                    }
                })
            }else{
                displayMessageQuestionFinish()
            }
        }
    })
}



var tempo = 120;

function countdown() {
    if ((tempo - 1) >= -1) {
        var min = parseInt(tempo / 60);
        var seg = tempo % 60;

        if (min < 10) {
            min = "0" + min;
            min = min.substr(0, 2);
        }
        if (seg <= 9) {
            seg = "0" + seg;
        }

        $("#timerPaymentQrCode").text(min + ':' + seg);
            setTimeout('countdown(tempo)', 1000);
        tempo--;
    }
    else {
        $("#timerPaymentQrCode").fadeOut(1000)
        $("#v-pills-qrcode").fadeOut(1000)
        $('#methodTitle').text('').fadeOut(1000)
        $('#modalCard').modal('hide')
        msgStatusTransaction('expired')
        tempo = 120;
    }
}
