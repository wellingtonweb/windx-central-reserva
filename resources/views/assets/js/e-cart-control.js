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
    var company_id = Number(billet.company);
    var installment = Number(billet.installment);
    var installmentValue = 0;
    console.log('Empresa: '+ company_id)
    console.log('Installment: '+ installment)
    $('input[name="installment"]').val("1");

    if(installment == 1){
        billetsCart.addItemToCart(billet_id, reference, duedate, value, addition, discount, price, 1, company_id);
        addPaintItem(btnId)
        displayCart();
        console.log(billetsCart)
    }else if(installment > 1){
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
