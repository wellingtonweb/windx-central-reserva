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



let labelCopy;

function displayLabel(){
    labelCopy = setInterval(setLabelCopy, 2000);
}

function setLabelCopy(){
    $('#copy-key-pix-info').removeClass('d-none').html('Copiado com sucesso!')
}

$('#copy-key-pix').click(function(){
    $(this).addClass('d-none')
    let code = 'Texto copiado aqui do pix'
    copyCode(code);
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



