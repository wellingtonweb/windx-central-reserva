// ************************************************
// E-Cart - Fork Shopping Cart API
// ************************************************
var cartCopy = [];

var billetsCart = (function() {

    cart = [];

    // Constructor
    function Item(billet_id, reference, duedate, value, addition, discount, price, count, installment) {
        this.billet_id = billet_id.toString().trim();
        this.reference = reference;
        this.duedate = duedate;
        this.value = value;
        this.addition = addition;
        this.discount = discount;
        this.price = price;
        this.count = count;
        this.installment = installment;
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
        console.log('Cart: ', cart)
    }
    if (sessionStorage.getItem("billetsCart") != null) {
        loadCart();
    }

    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(billet_id, reference, duedate, value, addition, discount, price, count, installment) {
        var item = new Item(billet_id, reference, duedate, value, addition, discount, price, count, installment);

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
    obj.removeItemFromCart = function(billetId) {
        for(var item in cart) {
            if(cart[item].billet_id == billetId) {
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

    // Total fees
    obj.totalFees = function() {
        var totalFees = 0;
        for(var item in cart) {
            if(cart[item].addition != 0) {
                totalFees += parseFloat(cart[item].addition);
            }
        }
        console.log(totalFees)
        return Number(totalFees.toFixed(2));
    }

    // Total sum
    obj.totalSum = function() {
        var totalSum = 0.00;

        for(var item in cart) {
            if(cart[item].value != 0){
                totalSum += cart[item].value;
            }
        }
        // console.log(totalCart.toFixed(2))
        return Number(totalSum.toFixed(2));
    }

    return obj;
})();

import('e-cart');

/* E-Cart Control */
var total = 0;
var count = 0;
var checkBillet = false;

// Add item to cart
function addToCartBtn(data){
    var billet = JSON.parse(data);
    checkBillet = false;
    var btnId = billet.id;
    var billet_id = billet.id;
    var reference = billet.reference;
    var duedate = billet.duedate;
    var value = billet.value;
    var addition = billet.addition;
    var discount = billet.discount;
    var price = Number(billet.price);
    var installment = Number(billet.installment);
    var installmentValue = 0;

    if(installment == 1){
        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, 1);
        addPaintItem(btnId)
        displayCart();
    }else if(installment > 1){
        installmentValue = (parseFloat(value) / parseInt(installment));

        if(installment <= maxInstallment){
            if(installmentValue >= minInstallmentValue){
                Swal.fire({
                    icon: "info",
                    title: 'Pagamento de acordo!',
                    html: 'Deseja pagar o acordo em '+ installment +' vezes no cartão de crédito?',
                    confirmButtonColor: '#38c172',
                    denyButtonColor: '#6c757d',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: `Cancelar`,
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
                    if (result.isConfirmed) {
                        clearAllSections();
                        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, installment);
                        addPaintItem(btnId)
                        displayCart();
                        Swal.close();
                        $('button#btn-credit').click();
                    }else{
                        deleteItemCart(btnId, reference)
                        Swal.close();
                    }
                })
            }else{
                $('#select-billet-'+btnId).html('Pagar')
                Swal.fire({
                    icon: 'error',
                    title: 'Acordo não autorizado!',
                    text: 'Deseja realizar o pagamento à vista?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, 1);
                        addPaintItem(btnId)
                        displayCart();
                    }
                    // else {
                    //     clearAllSections();
                    // }
                })
            }
        }else{
            $('#select-billet-'+btnId).html('Pagar')
            Swal.fire({
                icon: 'error',
                title: 'Parcelamento não autorizado!',
                text: 'Deseja realizar o pagamento à vista?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, 1);
                    console.log(btnId)
                    addPaintItem(btnId)
                    displayCart();
                    console.log(cart);
                }
                // else {
                //     clearAllSections();
                // }
            })
        }
    }

    // checkBillet = getCheckBillet(billet_id)

    // if(checkBillet === true){
    //     // icon.removeClass('fas fa-spinner fa-pulse')
    //     //     .addClass('d-none')
    //     //     .addClass('fa fa-check')
    //     //     .removeClass('d-none')
    //
    //     // Swal.fire({
    //     //     icon: "error",
    //     //     title: 'Exite uma tentativa de pagamento para a fatura (nº '+ reference +')!',
    //     //     html: 'Confira na lista pagamentos',
    //     //     timer: 5000,
    //     //     willClose() {
    //     //         location.href = base_url + 'comprovantes/' + idCustomer
    //     //     }
    //     // })
    //
    //     Swal.fire({
    //         icon: "warning",
    //         title: 'Exite uma tentativa de pagamento para a fatura (nº '+ reference +')!',
    //         html: 'Deseja conferir ou realizar uma nova tentativa?',
    //         // timer: 5000,
    //         confirmButtonColor: '#38c172',
    //         denyButtonColor: '#007bff',
    //         showDenyButton: true,
    //         showCancelButton: false,
    //         confirmButtonText: 'Pagar',
    //         denyButtonText: `Conferir`,
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1);
    //             addPaintItem(btnId)
    //             displayCart();
    //             Swal.close();
    //         } else if (result.isDenied) {
    //             location.href = base_url + 'comprovantes/' + idCustomer
    //         }
    //     })
    // }else {
    //     billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1);
    //     addPaintItem(btnId)
    //     displayCart();
    // }
}

function deleteItemCart(id){
    billetsCart.removeItemFromCart(id);
    removePaintItem(id)
    displayCart();
}

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
    clearAllSections();
    $('#v-pills-tab').removeClass('d-none')
    $('#v-pills-tabContent').addClass('d-none')
    swiper.slideTo(0);
    notify('Todas as faturas foram removidas!')
});

// Clear all sections
function clearAllSections() {
    billetsCart.clearCart();
    sessionStorage.clear();
    localStorage.clear();
    removePaintAll()
    displayCart();
    clearInterval(callback)
}

// Remove paint all
function removePaintAll() {
    $('.swiper-slide').each(function (el) {
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
function addPaintItem(id) {
    $('#billet_'+id).addClass('text-windx-50');
    $('#title-'+id).addClass('text-windx-50');
    $('#select-billet-'+id).addClass('d-none').addClass('not-active');
    $('#remove-billet-'+id).removeClass('d-none not-active');
    $('#copy-barcode-'+id).addClass('not-active');
    $('#print-billet-'+id).addClass('not-active');
    sessionStorage.setItem(id, 'add');
}

// Remove paint item and enable buttons
function removePaintItem(id) {
    $('#billet_'+id).removeClass('text-windx-50');
    $('#title-'+id).removeClass('text-windx-50');
    $('#select-billet-'+id).removeClass('d-none').removeClass('not-active');
    $('#remove-billet-'+id).addClass('d-none not-active');
    $('#copy-barcode-'+id).removeClass('not-active');
    $('#print-billet-'+id).removeClass('not-active');
    sessionStorage.removeItem(id);
}
var count = 0;

// Show checkout information on dashboard
function displayCart() {
    var total = billetsCart.totalCart();
    count = billetsCart.totalCount();
    var fees = billetsCart.totalFees();
    var totalSum = billetsCart.totalSum();

    $('.total-cart').html(total.toFixed(2).replace(".",","));
    $('.total-count').html(count);
    $('.display-text').html(count > 1 ? ' faturas via ':' fatura via ');
    $('.total-fees').html(fees.toFixed(2).replace(".",","));
    $('.total-sum').html(totalSum.toFixed(2).replace(".",","));

    if (count != 0) {
        $('.checkout-controls button').each(function(){
            $(this).prop("disabled", false);
            $('#methodTitle').removeClass('text-muted').addClass('text-dark')
        });
    } else {
        $('.checkout-controls button').each(function(){
            $(this).prop("disabled", true);
            $('#methodTitle').removeClass('text-dark').addClass('text-muted')
        });
    }
}

async function pixCopyPaste(e){
    let code = $(e).data('code');

    if(code != undefined){
        await navigator.clipboard.writeText(code)
            .then(() => {
                notify5('Copiado para área de transferência!')
            })
            .catch((err) => {
                notify5('Falha ao copiar chave pix: '+ err);
                setTimeout(() => {
                    location.reload()
                }, 1000)
            });
    }else{
        notify5('Falha ao copiar chave pix');
    }
}

function isDue(dueDate)
{
    let today = new Date();
    let pay = (dueDate).split("/");
    let payFormat = Date.parse(pay[2]+'-'+pay[1]+'-'+pay[0]);

    if(payFormat < today){
        return true;
    }
    return false;
}

/* Swiper Slider Billets Cards */
var slider = '';
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    initialized: true,
    freeMode: true,
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        type: "fraction",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    navigation: {
        nextEl: ".slider-button-next",
        prevEl: ".slider-button-prev",
    },
    on: {
        init: function () {
            getBillets()
        },
    },
});

async function getBillets(){
    const response = await fetch(urlGetBillets);
    const billets = await response.json();
    let sliderBillets = document.querySelector('.mySwiper');

    if(billets.data.length === 0){
        sliderBillets.innerHTML = '<h4 class="p-3">Não existem faturas à pagar!</h4>';
    }else{
        $('.tns-controls').removeClass('d-none');
        $('#infoCheckout').removeClass('d-none');
        $('#buttonsCheckout').removeClass('d-none');
        window.addEventListener('load', inicializeSlider());
        function inicializeSlider(){
            swiper.removeAllSlides();
            for(let billet in billets.data){
                swiper.appendSlide(`
                                <div id="billet_${billets.data[billet].Id}" class="card swiper-slide  `+
                    (isDue(billets.data[billet].dtEmissao) ? 'card-overdue' : '') +`">
                                    <div class="card-header d-flex justify-content-center `+
                    (isDue(billets.data[billet].dtEmissao) ? 'card-header-overdue' : '') +`">
                                        <div class="title font-weight-bold">${billets.data[billet].Referencia}</div>
                                        <span class="pl-1 font-weight-bold">(${billets.data[billet].NossoNumero})</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row letter-1">
                                            <div class="col-12 py-1 d-flex justify-content-between" >
                                                <small style="border-bottom: 2px solid #CCCCCC; width: 100%"
                                                       class="card-text font-weight-bold text-muted text-left">
                                                    RESUMO DA FATURA
                                                </small>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between font-weight-bold">
                                                <span class="card-text ">
                                                    Total à pagar: </span>
                                                <span class="card-text">${billets.data[billet].total}</span>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between">
                                                <span class="card-text">Valor: </span>
                                                <span class="card-text">${billets.data[billet].valor}</span>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between">
                                                <span class="card-text">Juros + Multa:</span>
                                                <span class="card-text">${billets.data[billet].fees}</span>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between">
                                                <span class="card-text">Vencimento: </span>
                                                <span class="card-text">${billets.data[billet].dtEmissao}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex py-3" style="vertical-align: middle">
                                            <small class="card-text px-2">
                                                ${billets.data[billet].LinhaDigitavel}
                                            </small>
                                            ${billets.data[billet].copy}
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            ${billets.data[billet].download}
                                        </div>
                                        <div class="pt-2">
                                            <small class="text-muted">* Pagamento do boleto sujeito a compensação do banco (até 72h úteis)</small>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        ${billets.data[billet].add}
                                        ${billets.data[billet].remove}
                                    </div>
                                </div>
                    `);
            }
            $('.lds-ellipsis').addClass('d-none');
        }
    }
}

function refreshSliderCards()
{
    swiper.removeAllSlides();
    $('.lds-ellipsis').removeClass('d-none')
    getBillets()
}

displayCart();

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
            $('#method').val('ecommerce');
            //$('#terminal_id').val('2');
            // $('#reference').val();
            $('#modal-payment-form').modal('show');
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
        success: function(response) {
            console.log('Resposta do servidor: ', response)

            if (response.data.id == undefined) {
                console.log(response.data.message)
                displayMessageErrorPayment(response.data.message)
                return;
            } else {
                sessionStorage.setItem('transactionId', response.data.id)
                transactionId = sessionStorage.getItem("transactionId");

                callback = setInterval(function () {
                    callbackTransaction(response.data.id)
                }, 5000);

                if (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') {
                    setQrcode(response.data)
                    // setQrcode(response.data.qrCode, payment, response.data.copyPaste)
                }else{
                    if(response.status != 422){
                        $('#modal-payment-form').modal('hide')
                        // displayMessageWaitingPayment()
                        console.log('Aguardando status do pagamento')
                    }else{
                        console.log('Verifique os campos em vermelho!')
                    }
                }
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
function setQrcode(payment){
    console.log('Valor: ', payment.amount)
let amount = (payment.amount).toLocaleString('pt-BR');
    let paymentId = payment.id;

    Swal.fire({
        title: `Pagamento nº ${payment.id} com PIX`,
        // html: '<div id="modal-qrcode" class="text-center justify-content-center">Pagamento de <strong class="total-count"></strong> '+ (billetsCart.totalCount()>1?"faturas":"fatura")+' via <strong class="text-capitalize">'+payment.payment_type+'</strong>' +
        //     '<br><br>Total à pagar: <b>R$ </b><span class="font-weight-bold">'+amount+'</span>' +
        //     '<p>Leia o QRCode com seu app</p>' +
        //     '<div id="container-qrcode"><div class="body-popup-qrcode"><div class="qrcode-container"><img id="qrcode-img" class="w-50" src="'+payment.qrCode+'"></div></div>' +
        //
        //     '<p id="btnPixCopyPaste" class="animate__animated text-primary d-none" onclick="pixCopyPaste(this)" data-code="'+payment.copyPaste+'">' +
        //     'Pix Copia e Cola</p>' +
        //     '</div>' +
        //     '<p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none"></p>' +
        //     '<p id="timerPaymentQrCode" class="text-danger"></p></div>',

        html: `
            <div id="modal-qrcode" class="bg-white text-center justify-content-center">
                <small id="timerPaymentQrCode" class="text-danger">00:00</small>
                <div class="box-price-qrcode-card pb-1">
                    <h4 class="text-danger pt-2"><b>Valor total: </b><span class="font-weight-bold">${amount}</span></h4>
                    <p> Faturas selecionadas: <b class="total-count"></b></p>
                </div>
                <small class="pt-2 text-black-50">Use seu app de pagamento e leia o qrcode</small>
                <div id="container-qrcode">
                    <div class="body-popup-qrcode">
                        <div class="qrcode-container">
                            <img id="qrcode-img" class="w-50_" src="${payment.qrCode}">
                        </div>
                    </div>
                    <div class="form-floating group-pix-copy-paste">
                        <input type="text" class="form-control" value="${payment.copyPaste}" />
                        <label for="pixcopypaste">Código do Pix Copia e Cola</label>
                    </div>
                    <span id="btnPixCopyPaste" class="animate__animated text-primary d-none_" onclick="pixCopyPaste(this)" data-code="${payment.copyPaste}">
                    Copiar código do PIX
                    </span>
                </div>
                <p id="labelWaitingPayment" class="pt-3 text-black-50 animate__animated animate__fadeIn d-none"></p>
            </div>
            `,
        timer: 120000,//2min
        timerProgressBar: false,
        showConfirmButton: false,
        showDenyButton: true,
        denyButtonText: '<i class="fas fa fa-times pr-1" aria-hidden="true"></i>CANCELAR',
        denyButtonColor: '#d33',
        didOpen: () => {
            if(payment_type == 'pix'){
                $('#btnPixCopyPaste').removeClass('d-none');
            }
            displayCart()
            Swal.hideLoading()
            console.log('Valor: ', payment.amount)


            // Swal.showLoading()
            //$('.swal2-loader').addClass('d-none');
            // countdown(120);
            // setTimeout(() => {
            //     $('#labelWaitingPayment').removeClass('d-none');
            // }, 10000)
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
        if (result.dismiss === Swal.DismissReason.timer) {
            clearAllSections()
            msgStatusTransaction('expired')
            refreshSliderCards()
        }else
        if (result.isDenied || result.isDismissed) {
            clearAllSections()
            msgStatusTransaction('canceled')
            refreshSliderCards()
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


// var tempo = 120;
// var tempo = 60;

function countdown(tempo) {
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
        console.log('Tempo de pagamento: ', tempo)
    }
    else {
        $("#timerPaymentQrCode").fadeOut(1000)
        $("#v-pills-qrcode").fadeOut(1000)
        $('#methodTitle').text('').fadeOut(1000)
        // displayMessageStatusTransaction('Tempo expirado!', 'error', 10000)
    }
}
