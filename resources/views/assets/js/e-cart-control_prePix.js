/* E-Cart Control */
var total = 0;
var count = 0;

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
