/* E-Cart Control */
var total = 0;
var count = 0;
var checkBillet = false;
var isAgreement = false;

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
        nextStepCheckout();
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
                    html: '<small>Este pagamento permitirá apenas uma fatura, com valor único e parcelado conforme a determinação da empresa.</small> <br><br>Deseja pagar o acordo em <b>'+ installment +'</b> vezes no <b>cartão de crédito</b>?',
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
                        sessionStorage.setItem('isAgreement', JSON.stringify(true));
                        $('input#installment').val(installment);
                        $('input.bpmpi_installments').val(installment);
                        clearAllSections();
                        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
                        addPaintItem(btnId)
                        displayCart();
                        Swal.close();
                        getPaymentType($('button#btn-credit'))
                    }else{
                        deleteItemCart(btnId, reference)
                        Swal.close();
                    }
                })
            }else{
                $('#select-billet-'+btnId).html('Pagar')
                sessionStorage.setItem('isAgreement', JSON.stringify(false));

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
                        nextStepCheckout();
                    }
                    // else {
                    //     clearAllSections();
                    // }
                })
            }
        }else{
            sessionStorage.setItem('isAgreement', JSON.stringify(false));
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
                    nextStepCheckout();
                }
            })
        }
    }
}

function nextStepCheckout(){
    Swal.fire({
        icon: "question",
        title: 'Deseja prosseguir com o pagamento ou adicionar outra fatura?',
        confirmButtonColor: '#38c172',
        cancelButtonColor: '#007bff',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Prosseguir',
        cancelButtonText: `Adicionar`,
        reverseButtons: true,
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
            Swal.fire({
                title: `Selecione a forma <br>de pagamento`,
                html: `
                <div id="v-pills-tab" class="checkout-controls mt-4 px-3">
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-debit" type="button">
                            <span class="pl-3">DÉBITO</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-credit" type="button">
                            <span class="pl-3">CRÉDITO</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-pix"
                            data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                            role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                            <span class="pl-3">PIX</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-3">
                        <button onclick="getPaymentType(this)" class="btn btn-windx mb-1 btn-payment-type mt-4 btn-block d-flex justify-content-between" id="btn-picpay"
                                data-toggle="pill" data-target="#v-pills-qrcode" type="button"
                                role="tab" aria-controls="v-pills-qrcode" aria-selected="false">
                            <span class="pl-3">PICPAY</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="10" viewBox="0 0 320 512" class="mr-3">
                                <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                            </svg>
                        </button>
                    </div>
                `,
                confirmButtonColor: '#38c172',
                denyButtonColor: '#c82333',
                showDenyButton: true,
                // showCancelButton: false,
                showConfirmButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: `CANCELAR`,
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
                if (result.isDenied) {
                    clearAllSections();
                    refreshSliderCards()
                }
            })
        }else{
            Swal.close();
        }
    })
}

$('.btn-payment-type').click(function (){
    Swal.close();
})

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
    if(cart.length != 0){
        clearAllSections();
        $('#v-pills-tab').removeClass('d-none')
        $('#v-pills-tabContent').addClass('d-none')
        swiper.slideTo(0);
        notify('Todas as faturas foram removidas!')
    }else{
        notify('Nenhuma fatura foi selecionada!')
    }
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
    $('input.bpmpi_totalamount').val(Math.round(total.toFixed(2) * 100));
    $('.total-count').html(count);
    $('.display-text').html(count > 1 ? ' faturas via ':' fatura via ');
    $('.total-fees').html(fees.toFixed(2).replace(".",","));
    $('.total-sum').html(totalSum.toFixed(2).replace(".",","));

    if (count != 0) {
        $('.checkout-controls button,i').each(function(){
            $(this).prop("disabled", false);
            $('#methodTitle').removeClass('text-muted').addClass('text-dark')
        });
        $('#trashIcon').removeClass('fa-trash').addClass('fa-trash-alt');
    } else {
        $('.checkout-controls button,i').each(function(){
            $(this).prop("disabled", true);
            $('#methodTitle').removeClass('text-dark').addClass('text-muted')
        });
        $('#trashIcon').removeClass('fa-trash-alt').addClass('fa-trash');
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
    grabCursor: true,
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
                                                    <small class="card-text">
                                                    ${billets.data[billet].LinhaDigitavel}
                                                    </small>
                                                </div>
                                                <div>
                                                    ${billets.data[billet].copy}
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center">
                                                ${billets.data[billet].download}
                                            </div>
                                            <div class="col-12" style="border-top: 2px solid #CCCCCC; width: 100%">
                                                <small class="payment-info72 text-muted">
                                                * Pagamento do boleto sujeito a compensação do banco (até 72h úteis)
                                                </small>
                                            </div>
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
