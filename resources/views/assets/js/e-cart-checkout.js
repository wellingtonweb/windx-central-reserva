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
    // msgStatusTransaction('canceled')
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
            // $('.payment_type_label').text((this.id == 'btn-picpay'?'Picpay':'Pix'));
            $('#payment_type').val((this.id == 'btn-picpay'?'picpay':'pix'));
            $('#method').val((this.id == 'btn-picpay'?'picpay':'ecommerce'));
            resetCardFields();
            $('#form_checkout').submit();
            break
        default:
            // $('.payment_type_label').text((this.id == 'btn-credit'?'Crédito':'Débito'));
            $('#payment_type').val((this.id == 'btn-credit'?'credit':'debit'));
            $('#method').val('ecommerce');
            //$('#terminal_id').val('2');
            // $('#reference').val();
            $('#modalCard').modal('show');
            // Swal.fire('Aguardando aprovação do pagamento!')
            // $('#form_checkout').submit();
            break
    }
});

/* Submit form checkout */
$('#form_checkout').submit(function (e){
    e.preventDefault();
    let dataForm = $(this).serializeArray();
    console.log('Dataform', dataForm)
    if(dataForm['1'].value == ''){
        // swal.fire('Erro: carrinho sem boletos!')
        displayMessageErrorPayment('Erro: 422 - Dados inválidos')
    }
    let payment = {
        'paymentType': $('#payment_type').val(),
        'actionForm': $(this).attr('action'),
        'methodForm': $(this).attr('method'),
        'dataForm': $(this).serialize(),
        'methodCheckout': dataForm['9'].value,
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
    console.log(base_url + 'callback/' + id)
    $.ajax({
        url: base_url + 'callback/' + id,
        type: "GET",
        dataType: "JSON",
        data: JSON.stringify({}),
        success:function (data){
            // msgStatusTransaction(JSON.stringify(data.status))

            if(data.status === 'approved'){
                resetCardFields();
                // alert('Mostrar alert com link para download do comprovante PDF')
                // callbackPrintCoupon(id)
            }
            msgStatusTransaction(data.status)
            resetTimer()
            // console.log('Message: ', data)
        }
    })
}

/* Send payment */
function sendPayment(payment){
// function sendPayment(actionForm, methodForm, payment_type, methodCheckout){
    $(document).find('small.error-text').text('');
    // var pay = JSON.parse(sessionStorage.getItem('payment'))

    $.ajax({
        type: payment.methodForm,
        url: payment.actionForm,
        data: payment.dataForm,
        beforeSend: function (){
            Swal.fire({
                title: 'Pagamento com '+getPaymentText(payment.paymentType),
                html: (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') ? 'Gerando qrcode...':'Validando dados...',
                timer: 60000,
                // timerProgressBar: true,
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
                willClose: () => {
                    // clearInterval(timerInterval)
                },
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    displayMessageErrorPayment('Servidor indisponível')
                }
            })
        },
        success: function(response, textStatus, xhr) {
            console.log('Resposta do servidor: ', response)
            if(xhr.status === 404 || xhr.status === 500){
                alert(response.data.message)
                // msgStatusTransaction(response.data.status)
                $('#modalCard').modal('hide')
            }else if(xhr.status === 200){
                if(typeof response.data != "undefined"){
                    if(response.data.status === 'approved'){
                        $('#modalCard').modal('hide')
                        // refreshSliderCards()
                        msgStatusTransaction(response.data.status)
                    }else{
                        responseObj = getResponseError(response.original)
                        displayMessageErrorPayment(responseObj)
                        // msgStatusTransaction(response.data.status)
                    }
                }else{
                    console.log('Erro')
                    // if(typeof response.original != "undefined"){
                        responseObj = getResponseError(response.original)
                    // alert('Erro indefinido: '+ responseObj)
                    displayMessageErrorPayment(responseObj)
                        console.log(responseObj)
                    // }else{
                    //     console.log('Erro 500!')
                    // }
                }
            }else{
                alert('outro erro')
                console.log(response.data)
            }

            // if (response.data.id == undefined) {
            //     console.log(response.data.message)
            //     displayMessageErrorPayment(response.data.message)
            //     return;
            // } else {
            //     if(response.status === 200){
            //         msgStatusTransaction(response.data.status)
            //     }else{
            //         sessionStorage.setItem('transactionId', response.data.id)
            //         transactionId = sessionStorage.getItem("transactionId");
            //
            //         callback = setInterval(function () {
            //             callbackTransaction(response.data.id)
            //         }, 5000);
            //
            //         if (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') {
            //             setQrcode(response.data)
            //         }else{
            //             if(response.status != 422){
            //                 $('#modalCard').modal('hide')
            //                 displayMessageWaitingPayment()
            //                 console.log('Aguardando status do pagamento')
            //             }else{
            //                 console.log('Verifique os campos em vermelho!')
            //             }
            //         }
            //     }
            // }
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
                    console.log('Mais de um erro!')
                    $.each(data.responseJSON.errors, function (key, value) {
                        // $('#err').append(key+": "+value+"<br>");
                        if($('input[name='+key+']').is( ":hidden" )){
                            //$('div.text-display-error').html('Erro: 422 - Favor informar ao administrador!').removeClass('d-none');
                            //Criar rotina de notificação por e-mail
                            console.log(key, value[0])
                            // alert('Erro: 422 - Dados inválidos')
                            // displayMessageErrorPayment('Erro: 422 - Dados inválidos')
                            //notifySystem('422', 'error', 'Dados inválidos!')
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

function getResponseError(ObjData)
{
    var startIndex = ObjData.error.indexOf('{');
    var endIndex = ObjData.error.lastIndexOf('}') + 1;
    var jsonStr = ObjData.error.substring(startIndex, endIndex);
    var jsonObj = JSON.parse(jsonStr);

    return jsonObj.message
}

/* Display qrcode for payment */
function setQrcode(payment){
    let amount = (payment.amount).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});

    Swal.fire({
        title: `Pagamento nº ${payment.id} com ${(payment.payment_type == 'Pix' ? 'PIX' : 'PICPAY')}`,
        html: `
            <div id="modal-qrcode" class="bg-white text-center justify-content-center">
                <small id="timerPaymentQrCode" class="text-danger">02:00</small>
                <div class="box-price-qrcode-card pb-1">
                    <h4 class="text-danger pt-2"><b>Valor total: </b><span class="font-weight-bold">${amount}</span></h4>
                    <p>Faturas selecionadas: <b class="total-count"></b></p>
                </div>
                <small class="pt-2 text-black-50">Use seu app de pagamento e leia o qrcode</small>
                <div id="container-qrcode">
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
            countdown();
            displayCart()
            Swal.hideLoading()
            if(payment.payment_type == 'Pix'){
                $('#btnPixCopyCode').removeClass('d-none');
                $('.group-pix-copy-paste').removeClass('d-none');
            }
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
            // refreshSliderCards()
        } else if(result.isDenied || result.isDismissed) {
            clearAllSections()
            msgStatusTransaction('canceled')
            // refreshSliderCards()
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
                displayMessageStatusTransaction('Pagamento realizado com sucesso!','success', 5000)
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
                // console.log('Status: ', status)
                return false;
                break;
            default:
                return false;
            // break;
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
            // clearInterval(callback)
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
        // showConfirmButton: false,
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
    //     .then((result) => {
    //     if (result.dismiss) {
    //         Swal.fire({
    //             title: 'Deseja realizar um novo pagamento?',
    //             showDenyButton: true,
    //             showCancelButton: true,
    //             confirmButtonText: 'Sim',
    //             denyButtonText: `Não`,
    //         }).then((result) => {
    //             /* Read more about isConfirmed, isDenied below */
    //             if (result.isConfirmed) {
    //                 //Swal.fire('Saved!', '', 'success')
    //                 clearAllSections()
    //                 window.location.reload()
    //             } else if (result.dismiss || result.isDenied) {
    //                 // Swal.fire('Changes are not saved', '', 'info')
    //                 logout()
    //             }
    //         })
    //     }
    // })

    // Swal.fire({
    //     title: 'Deseja realizar um novo pagamento?',
    //     showDenyButton: true,
    //     showCancelButton: false,
    //     confirmButtonText: 'Sim',
    //     denyButtonText: 'Não',
    //     timer: 15000,
    //     customClass: {
    //         actions: 'my-actions',
    //         cancelButton: 'order-1 right-gap',
    //         confirmButton: 'order-2',
    //         denyButton: 'order-3',
    //     }
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         clearAllSections()
    //         location.reload();
    //         //setTimeout(() => { callbackTransaction() }, 15000);
    //     } else if (result.dismiss || result.isDenied) {
    //         logout()
    //     }
    // })
}

function displayMessageStatusTransaction(dTitle, dIcon, dTimer){
    Swal.fire({
        title: dTitle,
        icon: dIcon,
        timer: dTimer,
        didOpen: () => {
            Swal.hideLoading()
            // clearInterval(callback)
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
    //     .then(function (result) {
    //     // clearInterval(timerInterval)
    //     clearAllSections()
    //     // callbackTransaction()
    //     // displayMessageQuestionFinish()
    // })
}



var tempo = 120;
// var tempo = 60;

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
        // console.log('Tempo de pagamento: ', tempo)
    }
    else {
        $("#timerPaymentQrCode").fadeOut(1000)
        $("#v-pills-qrcode").fadeOut(1000)
        $('#methodTitle').text('').fadeOut(1000)
        // displayMessageStatusTransaction('Tempo expirado!', 'error', 10000)
    }
}
