// ************************************************
// E-Cart - Fork Shopping Cart API
// ************************************************
var cartCopy = [];

var billetsCart = (function() {

    cart = [];

    // Constructor
    function Item(billet_id, reference, duedate, value, addition, discount, price, count) {
        this.billet_id = billet_id.toString().trim();
        this.reference = reference;
        this.duedate = duedate;
        this.value = value;
        this.addition = addition;
        this.discount = discount;
        this.price = price;
        this.count = count;

        console.log()
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('billetsCart', JSON.stringify(cart));
        $('#cartPayment').val(JSON.stringify(cart))
        $('#cartBillets').val(JSON.stringify(cart))
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('billetsCart'));
        // console.log(cart)
    }
    if (sessionStorage.getItem("billetsCart") != null) {
        loadCart();
    }

    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(billet_id, reference, duedate, value, addition, discount, price, count) {
        var item = new Item(billet_id, reference, duedate, value, addition, discount, price, count);

        // var itemCheck = cart.some(function(testItem) {
        //     return testItem.billet_id === item.billet_id;
        // });



        // if (!itemCheck && !check) {
            cart.push(item);
            saveCart();
        // }else{

            // console.log('A fatura de nº '+item.reference+' já foi paga!')
        // }
    }

    // Remove item from cart
    obj.removeItemFromCart = function(reference) {
        for(var item in cart) {
            if(cart[item].reference === reference) {
                cart[item].count --;
                if(cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        // console.log(totalCart.toFixed(2))
        return Number(totalCart.toFixed(2));
    }

    return obj;
})();

/* E-Cart Control */
var total = 0;
var count = 0;
var checkBillet = false;

// Add item to cart
$('.add-to-cart').click(function(event) {
    event.preventDefault();
    checkBillet = false;

    // var icon = $(this).find('i');
    // icon.removeClass('fa fa-check')
    //     .addClass('d-none')
    //     .addClass('fas fa-spinner fa-pulse')
    //     .removeClass('d-none')

    var btnId = $(this).attr('id');
    var billet_id = $(this).data('id');
    var reference = $(this).data('reference');
    var duedate = $(this).data('duedate');
    var value = $(this).data('value');
    var addition = $(this).data('addition');
    var discount = $(this).data('discount');
    var price = Number($(this).data('price'));

    checkBillet = getCheckBillet(billet_id)

    if(checkBillet === true){
        // icon.removeClass('fas fa-spinner fa-pulse')
        //     .addClass('d-none')
        //     .addClass('fa fa-check')
        //     .removeClass('d-none')

        // Swal.fire({
        //     icon: "error",
        //     title: 'Exite uma tentativa de pagamento para a fatura (nº '+ reference +')!',
        //     html: 'Confira na lista pagamentos',
        //     timer: 5000,
        //     willClose() {
        //         location.href = base_url + 'comprovantes/' + idCustomer
        //     }
        // })

        Swal.fire({
            icon: "warning",
            title: 'Exite uma tentativa de pagamento para a fatura (nº '+ reference +')!',
            html: 'Deseja conferir ou realizar uma nova tentativa?',
            // timer: 5000,
            confirmButtonColor: '#38c172',
            denyButtonColor: '#007bff',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Pagar',
            denyButtonText: `Conferir`,
        }).then((result) => {
            if (result.isConfirmed) {
                billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1);
                addPaintItem(btnId)
                displayCart();
                Swal.close();
            } else if (result.isDenied) {
                location.href = base_url + 'comprovantes/' + idCustomer
            }
        })
    }else {
        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1);
        addPaintItem(btnId)
        displayCart();
    }
});
// function addInvoiceToCart(data){
//     let btnId = data.id, billet_id = data.dataset.id, reference = data.dataset.reference,
//         value = data.dataset.value, addition = data.dataset.addition,
//         discount = data.dataset.discount, price = Number(data.dataset.price);
//
//     billetsCart.addItemToCart(billet_id, reference, value, addition, discount, price, 1);
//     addPaintItem(btnId)
//     displayCart();
// }

//Remove item to cart
$('.delete-item').on("click", function(event) {
    var id = $(this).attr('id');
    var reference = $(this).data('reference')
    deleteItemCart(id, reference)
})

function deleteItemCart(id, reference){
    billetsCart.removeItemFromCart(reference);
    removePaintItem(id)
    displayCart();
}
// function removeInvoiceToCart(data){
//     let btnId = data.id, reference = data.dataset.reference,
//         value = data.dataset.value, addition = data.dataset.addition,
//         discount = data.dataset.discount, price = Number(data.dataset.price);
//
//     billetsCart.removeItemFromCart(reference);
//     removePaintItem(btnId)
//     displayCart();
// }

function getCheckBillet(id){
    $.ajax({
        url: base_url + 'check/' + id,
        type: "GET",
        async: false,
        success:function (data){
            if(data === true){
                checkBillet = true;
            }
        }
    });
    return checkBillet
}


// Clear items of cart
$('.clear-cart').click(function() {
    // billetsCart.clearCart();
    clearAllSections();
    $('#v-pills-tab').removeClass('d-none')
    $('#v-pills-tabContent').addClass('d-none')
    // removePaintAll()
    // displayCart();
    notify('Todas as faturas foram removidas!')
    location.reload();
});

// Clear all sections
function clearAllSections() {
    billetsCart.clearCart();
    sessionStorage.clear();
    localStorage.clear();
    removePaintAll()
    displayCart();
}

// Remove paint all
function removePaintAll() {
    $('.invoice-slide').each(function (el) {
        $(this).removeClass('border-success text-windx-50');
        $('.delete-item').addClass('d-none not-active');
        $('.add-to-cart').removeClass('not-active d-none');
        $('.btn-copy').removeClass('not-active');
        $('.btn-print-billet').removeClass('not-active');
        $('.invoice-title').removeClass('text-windx-50');
    })
}

function changeTootip(id){
    $('#'+id).attr('title', 'Copiado!')
        .tooltip('fixTitle')
        .tooltip('show')
        .attr('title', "Copy to Clipboard")
        .tooltip('fixTitle');
}

// Copy barcode to clipboard
async function copyBarcode(id) {
    let code = $('#'+id).attr("data-code");
    await navigator.clipboard.writeText(code)
        .then(() => {
            notify('Copiado com sucesso!');
        })
        .catch((err) => {
            notify('Falha ao copiar: '+ err);
        });
}

// Add paint and disable buttons
function addPaintItem(btn_id) {
    const id = parseInt(btn_id.replace(/[^0-9]/g, ''));
    // console.log(id)
    $('#invoice-'+id).addClass('border-success text-windx-50');
    $('#title-'+id).addClass('text-windx-50');
    $('#select-billet-'+id).addClass('d-none').addClass('not-active');
    $('#remove-billet-'+id).removeClass('d-none not-active');
    $('#copy-barcode-'+id).addClass('not-active');
    $('#print-billet-'+id).addClass('not-active');
    sessionStorage.setItem(id, 'add');
}

// Remove paint item and enable buttons
function removePaintItem(btn_id) {
    const id = parseInt(btn_id.replace(/[^0-9]/g, ''));
    $('#invoice-'+id).removeClass('border-success text-windx-50');
    $('#title-'+id).removeClass('text-windx-50');
    $('#select-billet-'+id).removeClass('d-none').removeClass('not-active');
    $('#remove-billet-'+id).addClass('d-none not-active');
    $('#copy-barcode-'+id).removeClass('not-active');
    $('#print-billet-'+id).removeClass('not-active');
    sessionStorage.removeItem(id);
}

/* Session paint components */
function paintBilletSession(){
    let billet_Id = '';
    let card_data_id = '';

    if (sessionStorage.getItem("billetsCart") != null) {
        billetsSession = JSON.parse(sessionStorage.getItem("billetsCart"))
        $.each(billetsSession, function(i, v) {
            billet_Id = billetsSession[i].billet_id;
            $('.invoice-slide').each(function (el) {
                card_data_id = $(this).attr('data-id')
                if(card_data_id == billet_Id){
                    $(this).addClass('border-success text-windx-50')
                    // $('.invoice-title').addClass('text-windx-50')
                    $('.invoice-title').each(function() {
                        if ($(this).attr('data-id') == card_data_id){
                            $(this).addClass('text-windx-50');
                        }
                    });
                    $('.btn.btn-copy').each(function() {
                        if ($(this).attr('data-id') == card_data_id){
                            $(this).addClass('not-active');
                        }
                    });
                    $('.btn.btn-print-billet').each(function() {
                        if ($(this).attr('data-id') == card_data_id){
                            $(this).addClass('not-active');
                        }
                    });
                    $('.btn.add-to-cart').each(function() {
                        if ($(this).attr('data-id') == card_data_id){
                            $(this).addClass('d-none');
                        }
                    });
                    $('.btn.delete-item').each(function() {
                        if ($(this).attr('data-id') == card_data_id){
                            $(this).removeClass('d-none');
                        }
                    });
                }
            });
        });
    }
}

paintBilletSession()

// Show checkout information on dashboard
function displayCart() {
    var total = billetsCart.totalCart();
    var count = billetsCart.totalCount();

    $('.total-cart').html(total.toFixed(2).replace(".",","));
    $('.total-count').html(count);
    $('.display-text').html(count > 1 ? ' faturas via ':' fatura via ');

    if (count != 0) {
        $('.checkout-controls button').each(function(){
            $(this).prop("disabled", false);
        });
    } else {
        $('.checkout-controls button').each(function(){
            $(this).prop("disabled", true);
        });
    }
}

// $('.add-to-cart').click(function(event) {
//     event.preventDefault();
//     let invoice = $(this).data('invoice');
//     console.log(invoice);
//     var btnId = $(this).attr('id');
//     var billet_id = $(this).data('id');
//     var reference = $(this).data('reference');
//     var value = $(this).data('value');
//     var addition = $(this).data('addition');
//     var discount = $(this).data('discount');
//     var price = Number($(this).data('price'));
//
//     billetsCart.addItemToCart(billet_id, reference, value, addition, discount, price, 1);
//     addPaintItem(btnId)
//     displayCart();
// });
// $('.delete-item').on("click", function(event) {
//     var id = $(this).attr('id');
//     var reference = $(this).data('reference')
//     billetsCart.removeItemFromCart(reference);
//     removePaintItem(id)
//     displayCart();
// })


displayCart();


// function timerOut(){
//     window.onload = resetTimer;
//     // DOM Events
//     document.onmousemove = resetTimer;
//     document.onkeypress = resetTimer;
//     document.onmousedown = resetTimer; // touchscreen presses
//     document.ontouchstart = resetTimer;
//     document.onclick = resetTimer;     // touchpad clicks
//     // logout();
//     function resetTimer() {
//         clearTimeout(time);
//         time = setTimeout(() => {
//             $('.card-login').removeClass('is-flipped');
//         }, 15000)
//         // time = setTimeout(logout, 60000)
//     }
// }

/* Tries reload callback = 5 */
let tries = 0;
let paymentType = '';
var callback = '';
let transactionId  = '';

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

$('#modal-payment-form').on('hidden.bs.modal', function (event) {
    resetCardFields();
})

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
            $('#method').val('tef');
            //$('#terminal_id').val('2');
            // $('#reference').val();
            // $('#modal-payment-form').modal('show');
            // Swal.fire('Aguardando aprovação do pagamento!')
            $('#form_checkout').submit();
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
                callbackPrintCoupon(id)
            }
            msgStatusTransaction(data.status)
            console.log('Message: ', data)
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
                title: 'Pagamento via '+getPaymentText(payment.paymentType),
                html: payment.method == 'picpay' || payment.method == 'pix' ? 'Gerando qrcode...':'Validando dados...',
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
                /* Read more about isConfirmed, isDenied below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    displayMessageErrorPayment('Servidor indisponível')
                }
            })
        },
        success: function(response) {
            console.log(response)
            if (response != false || response.original.status != 'error' || response.data === undefined) {
                sessionStorage.setItem('transactionId', response.data.id)
                transactionId = sessionStorage.getItem("transactionId");

                if (payment.paymentType == 'picpay' || payment.paymentType == 'pix') {
                    setQrcode(response.data.qrCode, payment.paymentType, response.data.copyPaste)
                }else{
                    if(response.status != 422){
                        $('#modal-payment-form').modal('hide')
                        displayMessageWaitingPayment()
                    }else{
                        console.log('Verifique os campos em vermelho!')
                    }
                }
                callback = setInterval(function () {
                    if (transactionId != 'undefined' || transactionId != null) {
                        callbackTransaction(transactionId)
                    }
                }, 5000);
            } else {
                console.log('Servidor indisponível')
                clearInterval(callback)
                //displayMessageErrorPayment('Servidor indisponível')
                return;
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
                    console.log('Mais de um erro!')
                    $.each(data.responseJSON.errors, function (key, value) {
                        // $('#err').append(key+": "+value+"<br>");
                        if($('input[name='+key+']').is( ":hidden" )){
                            //$('div.text-display-error').html('Erro: 422 - Favor informar ao administrador!').removeClass('d-none');
                            //Criar rotina de notificação por e-mail
                            console.log(key, value[0])
                            alert('Erro: 422 - Dados inválidos')
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

/* Display qrcode for payment */
function setQrcode(qrcode, payment_type, qrString){
    // console.log(qrcode, payment_type, qrString)
    let timerInterval
    let pref64 = 'data:image\\/png;base64,';
    displayCart()

    if(payment_type == 'pix'){
        $('#qrcode-img').attr('src', pref64 + qrcode)
    }

    //callbackTransaction()
    Swal.fire({
        // title: 'Windx Telecomunicações',
        // html: '<div id="modal-qrcode" class="text-center justify-content-center">Pagamento de <strong>'+count+'</strong> '+ (count>1?"faturas":"fatura")+' via <strong class="text-capitalize">'+payment_type+'</strong>' +
        //     '<br><br>Total à pagar: <b>R$ </b><span class="font-weight-bold">'+$('.total-cart').html()+'</span>' +
        //     '<div id="container-qrcode"><div class="body-popup-qrcode"><div class="qrcode-container"><img id="qrcode-img" class="w-75-" src="'+(payment_type=="pix"?pref64:"")+qrcode+'"></div></div>' +
        //     '<p>Leia o QRCode com seu app</p>' +
        //     // '<p id="labelPixCopyPaste" class="'+ (payment_type=="pix"?"":"d-none")+'"></p>' +
        //     // '<p id="msgPixCopyPaste" class="text-success animate__animated d-none">Copiado para área de transferência!</p>' +
        //     // '<p id="btnPixCopyPaste" class="animate__animated d-none"><a id="copyPix" href="#" class="card-link text-primary" ' +
        //     // 'onclick="pixCopyPaste(this)" data-qrcodestring="'+qrString+'">Pix Copia e Cola</a></p></div>' +
        //     '<p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none">Aguardando confirmação de pagamento...</p>' +
        //     '<p id="timer" class="text-danger"></p></div>',
        // timer: 10000,
        // timer: 60000,
        // timer: 90000,//1.5min
        // timer: 120000,//2min
        timer: 120000,//3min
        timerProgressBar: false,
        showConfirmButton: false,
        showDenyButton: true,
        denyButtonText: '<i class="fas fa fa-times pr-1" aria-hidden="true"></i>CANCELAR',
        denyButtonColor: '#d33',
        didOpen: () => {
            if(payment_type == 'pix'){
                $('#btnPixCopyPaste').removeClass('d-none');
            }
            Swal.hideLoading()
            //$('.swal2-loader').addClass('d-none');
            countdown();
            setTimeout(() => {
                $('#labelWaitingPayment').removeClass('d-none');
            }, 60000)
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
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer || result.isDismissed) {
            // displayMessageWaitingPayment()
            msgStatusTransaction('expired')
        }
        else if (result.isDenied) {
            tries = 5;
            clearAllSections()
            msgStatusTransaction('canceled')
            window.location.reload()
        }
    })

}

/* Functions Display Messages */
function msgStatusTransaction(status){
    if(status){
        switch (status){
            case 'approved':
                clearInterval(callback)
                displayMessageStatusTransaction('Pagamento realizado com sucesso!','success', 5000)
                return true;
                break;
            case 'expired':
                clearInterval(callback)
                displayMessageStatusTransaction('Tempo expirado!','error', 5000)
                return false;
                break;
            case 'refused':
                clearInterval(callback)
                displayMessageStatusTransaction('Pagamento recusado!','error', 5000)
                return false;
                break;
            case 'canceled':
                clearInterval(callback)
                displayMessageStatusTransaction('Pagamento cancelado!','error', 5000)
                return false;
                break;
            case 'created':
                console.log('Status: ', status)
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
            //callbackTransaction()
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
    clearInterval(callback)
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
        },
        willClose: () => {
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
    clearInterval(callback)
    Swal.fire({
        title: dTitle,
        icon: dIcon,
        timer: dTimer,
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
    //     .then(function (result) {
    //     // clearInterval(timerInterval)
    //     clearAllSections()
    //     // callbackTransaction()
    //     // displayMessageQuestionFinish()
    // })
}
