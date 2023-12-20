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
    if(typeof transactionId != "undefined"){
        transactionId = null;
    }
}

// Remove paint all
function removePaintAll() {
    $('table.listBillets tr').each(function (el) {
        if ($(this).is( ".bg-success-windx" )) {
            $(this).removeClass('font-weight-bold bg-success-windx');
            $('.delete-item').addClass('d-none');
            $('.add-to-cart').prop('disabled', false).removeClass('d-none');
            $('.btn-copy').prop('disabled', false);
            $('.btn-print-billet').prop('disabled', false);
            $('.btn-print-billet-mobile').prop('disabled', false);
        }
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
    let barcode = $('#'+id).attr("data-code");
    await navigator.clipboard.writeText(barcode)
        .then(() => {
            shortMessage('Copiado com sucesso!');
        })
        .catch((err) => {
            shortMessage('Falha ao copiar: '+ err);
        });
}

// Add paint and disable buttons
function addPaintItem(id) {
    if (id) {
        var rowId = parseInt(id.replace(/[^0-9]/g, ''));
        $('#'+rowId).closest('tr').addClass('font-weight-bold bg-success-windx');
        $('#'+id).addClass('d-none');
        $('#remove-billet-'+rowId).removeClass('d-none');
        $('#copy-barcode-'+rowId).prop('disabled', true);
        $('#print-billet-'+rowId).prop('disabled', true);
        $('#print-billet-mobile-'+rowId).prop('disabled', true);
        sessionStorage.setItem(rowId, 'add');
    }
}

// Remove paint item and enable buttons
function removePaintItem(id) {
    var rowId = parseInt(id.replace(/[^0-9]/g, ''));
    $('#'+rowId).closest('tr').removeClass('font-weight-bold bg-success-windx');
    $('#'+id).addClass('d-none');
    $('#select-billet-'+rowId).removeClass('d-none').prop('disabled', false);
    $('#copy-barcode-'+rowId).prop('disabled', false);
    $('#print-billet-'+rowId).prop('disabled', false);
    $('#print-billet-mobile-'+rowId).prop('disabled', false);
    sessionStorage.removeItem(rowId);
}

// Show checkout information on dashboard
function displayCart() {
    var total = billetsCart.totalCart();
    var count = billetsCart.totalCount()

    $('.total-cart').html(total.toString().replace(".",","));
    $('.total-count').html(count);
    $('.display-text').html(count > 1 ? ' boletos via ':' boleto via ');

    if (count != 0) {
        $('#container-btn-checkout button').each(function(){
            $(this).prop("disabled", false);
        });
    } else {
        $('#container-btn-checkout button').each(function(){
            $(this).prop("disabled", true);
        });
    }
}

// Delete item button
$('.cart-control').on("click", ".delete-item", function(event) {
    var id = $(this).attr('id');
    var reference = $(this).data('reference')
    billetsCart.removeItemFromCart(reference);
    removePaintItem(id)
    displayCart();
})

displayCart();
