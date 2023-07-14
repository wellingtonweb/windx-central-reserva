// ************************************************
// E-Cart - Fork Shopping Cart API
// ************************************************
var cartCopy = [];

var billetsCart = (function() {

    cart = [];

    // Constructor
    function Item(billet_id, reference, value, addition, discount, price, count) {
        this.billet_id = billet_id.toString().trim();
        this.reference = reference;
        this.value = value;
        this.addition = addition;
        this.discount = discount;
        this.price = price;
        this.count = count;
    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('billetsCart', JSON.stringify(cart));
        $('#cartPayment').val(JSON.stringify(cart))
        $('#cartBillets').val(JSON.stringify(cart))
        console.log(JSON.stringify(cart))
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('billetsCart'));
        console.log(cart)
    }
    if (sessionStorage.getItem("billetsCart") != null) {
        loadCart();
    }

    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(billet_id, reference, value, addition, discount, price, count) {
        var item = new Item(billet_id, reference, value, addition, discount, price, count);
        cart.push(item);
        saveCart();
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

// Add item to cart
$('.add-to-cart').click(function(event) {
    event.preventDefault();
    var btnId = $(this).attr('id');
    var billet_id = $(this).data('id');
    var reference = $(this).data('reference');
    var value = $(this).data('value');
    var addition = $(this).data('addition');
    var discount = $(this).data('discount');
    var price = Number($(this).data('price'));
    billetsCart.addItemToCart(billet_id, reference, value, addition, discount, price, 1);
    addPaintItem(btnId)
    displayCart();
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
    billetsCart.removeItemFromCart(reference);
    removePaintItem(id)
    displayCart();
})
// function removeInvoiceToCart(data){
//     let btnId = data.id, reference = data.dataset.reference,
//         value = data.dataset.value, addition = data.dataset.addition,
//         discount = data.dataset.discount, price = Number(data.dataset.price);
//
//     billetsCart.removeItemFromCart(reference);
//     removePaintItem(btnId)
//     displayCart();
// }



// Clear items of cart
$('.clear-cart').click(function() {
    // billetsCart.clearCart();
    clearAllSections();
    // removePaintAll()
    // displayCart();
    notify('Todas as faturas foram removidas!')
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

/* Button payment type */
$('button.btn-payment-type').click(function (){
    switch (this.id){
        case 'btn-picpay':
        case 'btn-pix':
            $('.payment_type_label').text((this.id == 'btn-picpay'?'Picpay':'Pix'));
            $('#payment_type').val((this.id == 'btn-picpay'?'picpay':'pix'));
            $('#method').val((this.id == 'btn-picpay'?'picpay':'ecommerce'));
            $('#form_checkout').submit();
            break
        default:
            $('.payment_type_label').text((this.id == 'btn-credit'?'Crédito':'Débito'));
            $('#payment_type').val((this.id == 'btn-credit'?'credit':'debit'));
            $('#method').val('tef');
            $('#terminal_id').val('2');
            $('#reference').val();
            $('#form_checkout').submit();
            // $('#modal-payment-form').modal('show');
            Swal.fire('Aguarde a conexão com a operadora do cartão!')
            break
    }
});

/* Submit form checkout */
$('#form_checkout').submit(function (e){
    e.preventDefault();
    let payment_type = $('#payment_type').val();
    let actionForm = $(this).attr('action');
    let methodForm = $(this).attr('method');
    let dataForm = $(this).serializeArray();
    let methodCheckout = dataForm['9'].value
    sendPayment(actionForm, methodForm, payment_type, methodCheckout)
});

/* Send payment */
function sendPayment(actionForm, methodForm, payment_type, methodCheckout){
    $(document).find('small.error-text').text('');
    // console.log(data)
    $.ajax({
        type: methodForm,
        url: actionForm,
        //Inicio da mudança
        // async: true,
        // crossDomain: true,
        // method: "POST",
        // headers: {
        //     "Accept": "application/json",
        //     "Content-Type": "application/json",
        //     "Authorization": "Bearer 26|9heai2cp8Am4A1lS9Rljdzrzstloja4Y5k25Ztsf"
        // },
        // processData: false,
        //fim da mudança
        data: $('#form_checkout').serialize(),
        beforeSend: function (){
            Swal.fire({
                title: 'Aguarde!',
                html: 'Validando os dados de pagamento',
                timer: 20000,
                timerProgressBar: true,
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
        },
        success: function(data) {
            $json = JSON.parse(data.resp);
            sessionStorage.setItem('transactionId', $json.data.id)
            callbackTransaction()
            console.log($json.data)
            const count = Object.keys($json.data.billets).length
            if((payment_type == 'picpay') || (payment_type == 'pix' )){
                setQrcode($json.data.qrCode, payment_type, count)
            }else{
                console.log($json.data.status);
                $('#payment-form-dialog').addClass('d-none animate__animated animate__zoomOutDown');
            }
        },
        error: function(data) {
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
                        // $('#err').append(key+": "+value+"<br>");
                        if($('input[name='+key+']').is( ":hidden" )){
                            $('div.text-display-error').html('Erro: 422 - Favor informar ao administrador!').removeClass('d-none');
                            //Criar rotina de notificação por e-mail
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
function setQrcode(qrcode, payment_type, count){
    let timerInterval
    displayCart()
    callbackTransaction()
    Swal.fire({
        // title: 'Windx Telecomunicações',
        html: 'Pagamento de <strong>'+count+'</strong> boleto via <strong class="text-capitalize">'+payment_type+'</strong>' +
            '<br><br>Total à pagar: <b>R$ </b><span class="font-weight-bold">'+$('.total-cart').html()+'</span>' +
            '<div class="body-popup-qrcode"><div class="qrcode-container"><img id="qrcode-img" class="w-75-" src="'+qrcode+'"></div></div>' +
            '<p>Leia o QRCode com seu app</p>',
        // timer: 20000,
        timer: 60000,
        timerProgressBar: true,
        showConfirmButton: false,
        showDenyButton: true,
        denyButtonText: 'Cancelar',
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
                timer: 120000,
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                    callbackTransaction()
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
        }else if(result.isDenied){
            Swal.close();
        }
    })
}

/* Check payment callback */
function callbackTransaction(){
    const id = sessionStorage.getItem("transactionId");
    if(id != 'undefined' && id != null){
        fetch('/callback/'+id, { method: 'GET' })
            .then(response => response.json())
            .then(text => {
                msgStatusTransaction(text.data.status);
            })
            .catch(err => console.log(err.message))
    }
}

/* Display status message */
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
                    clearAllSections()
                    questionMessage()
                })
                return false;
                break;
            case 'canceled':
                Swal.fire({
                    icon: 'error',
                    title: 'O pagamento foi cancelado!',
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
        console.log('Não houve nenhum pagamento criado!')
    }
}

/* Question after payment */
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
            //setTimeout(() => { callbackTransaction() }, 15000);
        } else if (result.dismiss || result.isDenied) {
            logout()
        }
    })
}
