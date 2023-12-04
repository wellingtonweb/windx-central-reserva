/* Tries reload callback = 5 */
let tries = 0;
let paymentType = '';
var callback = '';
let transactionId  = '';
let responseObj = null;

clearAllSections();

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

$('#modalCard').on('show.bs.modal', function (event) {
    resetCardFields();
    countdown();
})

$('#modalCard').on('hidden.bs.modal', function (event) {
    resetCardFields();
    clearAllSections()
    refreshSliderCards()
})

$('#btnCloseModalCard').click(function (){
    msgStatusTransaction('canceled')
});

function resetCardFields() {
    $('#cc-numero').val('');
    $('#cc-nome').val('');
    $('#expiration_month').val('');
    $('#expiration_year').val('');
    $('#cc-cvv').val('');
}

/* Button payment type */
$('button.btn-payment-type').click(function (){
    $('#methodTitle').text($(this).text())
    $('#v-pills-tab').addClass('d-none')
    $('#v-pills-tabContent').removeClass('d-none')

    switch (this.id){
        case 'btn-picpay':
        case 'btn-pix':
            $('#payment_type').val((this.id == 'btn-picpay'?'picpay':'pix'));
            $('#method').val((this.id == 'btn-picpay'?'picpay':'ecommerce'));
            resetCardFields();
            $('#form_checkout').submit();
            break
        default:
            $('#payment_type').val((this.id == 'btn-credit'?'credit':'debit'));
            $('#method').val('ecommerce');
            $('#modalCard').modal('show');
            break
    }
});

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

function callbackPrintCoupon(id){
    console.log(base_url + 'coupon/' + id)
    window.location = base_url + 'coupon/'+ id;
    displayMessageStatusTransaction('Imprimindo cupom', 'info', 30000)
    // $.ajax({
    //     url: base_url + 'coupon/' + id,
    //     type: "GET",
    //     dataType: "JSON",
    //     data: JSON.stringify({}),
    //     success:function (data){
    //         // msgStatusTransaction(JSON.stringify(data.status))
    //         console.log('Finalizou!')
    //     }
    // })
}

function callbackTransaction(id){
    if(typeof id != undefined){
        console.log(base_url + 'callback/' + id)
    }else{
        console.log("ID indefinido :(")
    }

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
            if(xhr.status === 200 || xhr.status === 201){
                if (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') {
                    sessionStorage.setItem('transactionId', response.id)
                    transactionId = sessionStorage.getItem("transactionId");
                    setQrcode(response)
                    callback = setInterval(function () {
                        callbackTransaction(response.id)
                    }, 5000);

                }else{
                    if(response.status === 'approved'){
                        msgStatusTransaction(response.status)
                    }else{
                        sessionStorage.setItem('transactionId', response.id)
                        transactionId = sessionStorage.getItem("transactionId");
                        $('#modalCard').modal('hide')
                        displayMessageWaitingPayment()
                    }
                }
            }else{
                msgStatusTransaction(response.status)
                $('#modalCard').modal('hide')
            }
        },
        error: function(data) {
            console.log('Data error: ',data);
            $('#payment-form-dialog').removeClass('d-none')
            if(!data.responseJSON){
                console.log(data);
                $('div.text-display-error').html(data.responseText).removeClass('d-none');
            }else{
                swal.close()
                if(data.responseJSON.error) {
                    console.log(data)
                    notifySystem(data.status, data.responseJSON.status, data.responseJSON.error);
                } else {
                    $.each(data.responseJSON.errors, function (key, value) {
                        if($('input[name='+key+']').is( ":hidden" )){
                            console.log(key, value[0])
                        } else {
                            $('small.'+key+'_error').text(value[0]);
                            $('div.text-display-error').html('Verifique os dados informados!').removeClass('d-none');
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
                <div class="box-price-qrcode-card pb-1">
                    <h4 class="text-danger pt-2 font-weight-bold">Valor total: <span>${amount}</span></h4>
                    <p>Faturas selecionadas: <span class="font-weight-bold total-count"></span></p>
                </div>
                <small class="pt-2 text-black-50">Use seu app de pagamento e leia o qrcode</small>
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
                        class="mt-2 animate__animated text-primary d-none"
                        onclick="pixCopyPaste(this)" data-code="${payment.copyPaste}">
                        Copiar código do PIX
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
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            clearAllSections()
            msgStatusTransaction('expired')
        } else if(result.isDenied || result.isDismissed) {
            clearAllSections()
            msgStatusTransaction('canceled')
        }
    })
}

/* Functions Display Messages */
function msgStatusTransaction(status){
    if(status){
        switch (status){
            case 'approved':
                clearInterval(callback)
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento confirmado com sucesso!','success', 10000)
                return true;
                break;
            case 'expired':
                clearInterval(callback)
                refreshSliderCards()
                displayMessageStatusTransaction('Tempo expirado!','error', 5000)
                return false;
                break;
            case 'refused':
                clearInterval(callback)
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento recusado!','error', 5000)
                return false;
                break;
            case 'canceled':
                clearInterval(callback)
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

function displayMessageWaitingPayment(){
    Swal.fire({
        title: 'Aguarde!',
        html: 'Processando pagamento...',
        timer: 120000,
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
        },
        willClose: () => {
            $('#modalCard').modal('hide')
            displayMessageQuestionFinish()
        }
    })
}

function displayMessageStatusTransaction(dTitle, dIcon, dTimer){
    var dButton =
        `<a href="${base_url}comprovante/${transactionId}/download"
        class="download-pdf btn btn-primary btn-sm" target="_blank">
            <i class="fa fa-download pr-1"></i>
            Baixar comprovante
        </a>`;

    Swal.fire({
        title: dTitle,
        icon: dIcon,
        timer: dTimer,
        html: dIcon === 'success' ? dButton : '',
        didOpen: () => {
            Swal.hideLoading()
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
        tempo = 120;
        msgStatusTransaction('expired')
    }
}
