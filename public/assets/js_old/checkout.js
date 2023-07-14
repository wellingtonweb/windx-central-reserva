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
    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('billetsCart'));
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

// Clear items of cart
$('.clear-cart').click(function() {
    billetsCart.clearCart();
    clearAllSections();
    removePaintAll()
    displayCart();
});

// Clear all sections
function clearAllSections() {
    sessionStorage.clear();
    localStorage.clear();
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

// Delete item button
$('.delete-item').on("click", function(event) {
    var id = $(this).attr('id');
    var reference = $(this).data('reference')
    billetsCart.removeItemFromCart(reference);
    removePaintItem(id)
    displayCart();
})

displayCart();

/* Payment */
// const transaction_status = sessionStorage.getItem("transactionStatus");
// const transaction_id = sessionStorage.getItem("transactionId");


$('#modal-payment-form').on('show.bs.modal', function (event) {
    console.log('Modal aberto!')
})

$('#modal-payment-form').on('hidden.bs.modal', function (event) {
    //checkStatusTransaction();
//    msgStatusTransaction(status)
    //modalMsg('modalMessage','Aguarde!', 'Estamos processando o pagamento', true)
    clearAllSections()
    location.reload();
})

//Button payment type

//Submit form checkout

//sendPayment

//setQrCode function

function callbackTransaction(){
    const id = sessionStorage.getItem("transactionId");
    if(id != 'undefined' && id != null){
        fetch('/cliente/callback/'+id, { method: 'GET' })
            .then(response => response.json())
            .then(text => {
                msgStatusTransaction(text.data.status);
            })
            .catch(err => console.log(err.message))
    }
}

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

let labelCopy;

function displayLabel(){
    labelCopy = setInterval(setLabelCopy, 2000);
}

function setLabelCopy(){
    $('#copy-key-pix-info').removeClass('d-none').html('Copiado com sucesso!')
}
//
// async function copyCode(code){
//     await navigator.clipboard.writeText(code)
//         .then(() => {
//             notify('Copiado com sucesso!');
//             //document.getElementById(id).setAttribute('title', 'Copiado com sucesso!');
//         })
//         .catch((err) => {
//             console.error('Falha ao copiar: ', err);
//         });
// }

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
            //setTimeout(() => { callbackTransaction() }, 15000);
        } else if (result.dismiss || result.isDenied) {
            logout()
        }
    })
}


$('table.listBillets tr').each(function (el) {
    var idRow = $(this).attr('id');
    if (sessionStorage.getItem(idRow)) {
        $('#'+idRow).addClass('font-weight-bold bg-success-windx');
        $('#select-billet-'+idRow).addClass('d-none');
        $('#remove-billet-'+idRow).removeClass('d-none');
        $('#copy-barcode-'+idRow).prop('disabled', true);
        $('#print-billet-'+idRow).prop('disabled', true);
        $('#print-billet-mobile-'+idRow).prop('disabled', true);
    }else {
        $('#remove-billet-'+idRow).addClass('d-none');
        $('#select-billet-'+idRow).removeClass('d-none').prop('disabled', false);
        $('#copy-barcode-'+idRow).prop('disabled', false);
        $('#print-billet-'+idRow).prop('disabled', false);
        $('#print-billet-mobile-'+idRow).prop('disabled', false);
    }
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle-msg="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover()
})

function modalMsg(id, title, text, load) {
    if ($('#'+id).length) {
        $('#'+id).modal('show');
        $('#modalMessageTitle').html(title);
        $('#modalMessageText').html(text).addClass('animate animate__fadeOut');
        if (load) {
            $('.loader-msg').removeClass('d-none');
        }
    } else {
        console.log(id + Error)
    }
}



