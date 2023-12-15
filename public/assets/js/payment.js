// ************************************************
// E-Cart - Fork Shopping Cart API
// ************************************************
var cartCopy = [];

var billetsCart = (function() {

    cart = [];

    // Constructor
    function Item(billet_id, reference, duedate, value, addition, discount, price, count, company_id) {
        this.billet_id = billet_id.toString().trim();
        this.reference = reference;
        this.duedate = duedate;
        this.value = value;
        this.addition = addition;
        this.discount = discount;
        this.price = price;
        this.count = count;
        this.company_id = company_id;
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
    obj.addItemToCart = function(billet_id, reference, duedate, value, addition, discount, price, count, company_id) {
        var item = new Item(billet_id, reference, duedate, value, addition, discount, price, count, company_id);
        cart.push(item);
        saveCart();
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
        return Number(totalSum.toFixed(2));
    }

    return obj;
})();

// import('e-cart');

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
    var company_id = Number(billet.company_id);
    var installment = Number(billet.installment);
    var installmentValue = 0;

    $('input[name="installment"]').val("1");

    if(installment == 1)
    {
        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
        addPaintItem(btnId)
        displayCart();
    }
    else if(installment > 1)
    {
        installmentValue = (parseFloat(value) / parseInt(installment));

        if(installment <= maxInstallment){
            if(installmentValue >= minInstallmentValue)
            {
                $('input[name="installment"]').val(installment)

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
                        $('input#installment').val(installment);
                        clearAllSections();
                        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
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
                        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
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
                    billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
                    addPaintItem(btnId)
                    displayCart();
                }
            })
        }
    }
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
var swiper = new Swiper(".billetsSwiper", {
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
    let sliderBillets = document.querySelector('.billetsSwiper');
    $('.billetsSwiper').addClass('billetsSwiperLoading');

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
                                        <div class="row letter-1 resume">
                                            <div class="col-12 py-1 d-flex justify-content-between">
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
                                            <div class="col-12 py-1 d-flex justify-content-between info-plus">
                                                <span class="card-text">Valor: </span>
                                                <span class="card-text">${billets.data[billet].valor}</span>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between info-plus">
                                                <span class="card-text">Juros + Multa:</span>
                                                <span class="card-text">${billets.data[billet].fees}</span>
                                            </div>
                                            <div class="col-12 py-1 d-flex justify-content-between info-plus">
                                                <span class="card-text">Vencimento: </span>
                                                <span class="card-text">${billets.data[billet].dtEmissao}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 py-2 d-flex justify-content-between" style="vertical-align: middle; border-top: 2px solid #CCCCCC; width: 100%">
                                                <div>
                                                    <small class="card-text px-2 ">
                                                    ${billets.data[billet].LinhaDigitavel}
                                                    </small>
                                                </div>
                                                <div>
                                                    ${billets.data[billet].copy}
                                                </div>
                                            </div>
                                            <div class="col-12 py-2 d-flex justify-content-center">
                                                ${billets.data[billet].download}
                                            </div>
                                            <div class="col-12" style="border-top: 2px solid #CCCCCC; width: 100%">
                                                <small class="text-muted">
                                                * Pagamento do boleto sujeito a compensação do banco (até 72h úteis)
                                                </small>
                                            </div>
                                        </div>

                                        <div class="d-flex_ d-none py-3" style="vertical-align: middle; border-top: 2px solid #CCCCCC; width: 100%">
                                            <small class="card-text px-2">
                                                ${billets.data[billet].LinhaDigitavel}
                                            </small>
                                            ${billets.data[billet].copy}
                                        </div>
                                        <div class="d-flex_ d-none justify-content-center">
                                            ${billets.data[billet].download}
                                        </div>
                                        <div class="d-none pt-2" style="border-top: 2px solid #CCCCCC; width: 100%">
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
            $('.billetsSwiper').removeClass('billetsSwiperLoading');
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
$('button.btn-payment-type').click(function (){
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
            if(xhr.status === 200 || xhr.status === 201){
                if (payment.methodCheckout == 'picpay' || payment.paymentType == 'pix') {
                    localStorage.setItem('transactionId', response.id)
                    transactionId = localStorage.getItem("transactionId");
                    setQrcode(response)
                    runCallBack();
                }else{
                    if(response.status === 'approved')
                    {
                        $('#modalCard').modal('hide')
                        msgStatusTransaction(response.status)
                    }else{
                        sessionStorage.setItem('transactionId', response.id)
                        transactionId = sessionStorage.getItem("transactionId");
                        $('#modalCard').modal('hide')
                        waitingPayment()
                    }
                }
            }else{
                msgStatusTransaction(response.status)
                $('#modalCard').modal('hide')
            }
        },
        error: function(data) {
            if(data.status === 422){
                displayMessageError('Erro nos dados de pagamento!');
            }
            if(!data.responseJSON){
                displayMessageError('Verifique os dados informados!');
            }else{
                if(data.responseJSON.error) {
                    notifySystem(data.status, data.responseJSON.status, data.responseJSON.error);
                } else {
                    $.each(data.responseJSON.errors, function (key, value) {
                        if(!$('input[name='+key+']').is( ":hidden" )){
                            $('small.'+key+'_error').text(value[0]);
                            displayMessageError('Verifique os dados informados!');
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
                clearInterval(callback)
                refreshSliderCards()
                displayMessageStatusTransaction('Pagamento confirmado com sucesso!','success', 15000)
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

if (transactionId != null) {
    waitingPayment()
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
            if(dIcon === 'success'){
                Swal.fire({
                    title: 'Download do comprovante',
                    icon: 'info',
                    timer: 60000,
                    html: "Baixe seu comprovante ou acesse em Comprovantes para obter a 2ª via.<br><br>"+dButton,
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
                        clearAllSections()
                        displayMessageQuestionFinish()
                    }
                })
            }else{
                clearAllSections()
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
        tempo = 120;
    }
}
