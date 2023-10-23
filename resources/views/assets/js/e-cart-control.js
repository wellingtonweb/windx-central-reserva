/* E-Cart Control */
var total = 0;
var count = 0;
var checkBillet = false;

// Add item to cart

function addToCartBtn(data){
    var billet = JSON.parse(data);
    console.log('Data: ',billet);

// $('.add-to-cart').click(function(event) {
//     event.preventDefault();
    checkBillet = false;

    // var icon = $(this).find('i');
    // icon.removeClass('fa fa-check')
    //     .addClass('d-none')
    //     .addClass('fas fa-spinner fa-pulse')
    //     .removeClass('d-none')
    // $('#select-billet-'+billet.id).append("<i class='fas fa-spinner fa-pulse' aria-hidden='true'></i>")

    var btnId = billet.id;
    var billet_id = billet.id;
    var reference = billet.reference;
    var duedate = billet.duedate;
    var value = billet.value;
    var addition = billet.addition;
    var discount = billet.discount;
    var price = billet.price;
    var installments = billet.installments;

    console.log('btnId ',btnId ,'billet_id', billet_id)

    if(installments < maxInstallment){
        if(installments > 1){
            Swal.fire({
                icon: "info",
                title: 'Pagamento de acordo!',
                html: 'Deseja pagar o acordo em '+ installments +' vezes no cartão de crédito?',
                // timer: 5000,
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
                    console.log('Cart: ', billetsCart.totalCart())
                    billetsCart.addItemToCart(btnId, reference, duedate, value, addition, discount, price, 1, installments);
                    addPaintItem(btnId)
                    displayCart();
                    Swal.close();
                    swal.fire('Pop-up Card')
                    // $('#btn-credit').trigger();
                }else{
                    deleteItemCart(btnId, reference)
                    Swal.close();
                }
            })
        }else{
            // $('#select-billet-'+billet.id).html('Pagar')
            billetsCart.addItemToCart(btnId, reference, duedate, value, addition, discount, price, 1, installments);
            addPaintItem(btnId)
            displayCart();
        }
    }else{
        $('#select-billet-'+btnId).html('Pagar')
        clearAllSections();
        Swal.fire({
            icon: 'error',
            title: 'Parcelamento não autorizado!',
            text: 'Fale com nosso setor financeiro.',
        })
    }


    checkBillet = getCheckBillet(billet_id)

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
// });

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
// $('.delete-item').on("click", function(event) {
//     var id = $(this).attr('id');
//     // var reference = $(this).data('reference')
//     deleteItemCart(id.replace(/[^0-9]/g,''))
// })

function deleteItemCart(id){
    billetsCart.removeItemFromCart(id);
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
    //location.reload();
});

// Clear all sections
function clearAllSections() {
    billetsCart.clearCart();
    sessionStorage.clear();
    localStorage.clear();
    removePaintAll()
    displayCart();
    slider.destroy();
    slider = slider.rebuild();
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
function addPaintItem(id) {
    $('#invoice-'+id).addClass('border-success text-windx-50');
    $('#title-'+id).addClass('text-windx-50');
    $('#select-billet-'+id).addClass('d-none').addClass('not-active');
    $('#remove-billet-'+id).removeClass('d-none not-active');
    $('#copy-barcode-'+id).addClass('not-active');
    $('#print-billet-'+id).addClass('not-active');
    sessionStorage.setItem(id, 'add');
}

// Remove paint item and enable buttons
function removePaintItem(id) {
    // const id = parseInt(btn_id.replace(/[^0-9]/g, ''));
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

async function pixCopyPaste(){
    let code = $('p.qrcodestring').text()
    console.log(code);
    await navigator.clipboard.writeText(code)
        .then(() => {
            notify('Copiado para área de transferência!')
        })
        .catch((err) => {
            notify('Falha ao copiar: '+ err);
            setTimeout(() => {
                location.reload()
            }, 1000)
        });
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

var slider = '';

async function getBillets(){

    const response = await fetch(urlGetBillets);
    const billets = await response.json();
    let sliderBillets = document.querySelector('.billets-slider');

    if(billets.data.length === 0){
        sliderBillets.innerHTML = '<h4 class="p-3">Não existem faturas à pagar!</h4>';
    }else{
        $('.tns-controls').removeClass('d-none');
        $('#infoCheckout').removeClass('d-none');
        $('#buttonsCheckout').removeClass('d-none');
        window.addEventListener('load', inicializeSlider());
        function inicializeSlider(){
            let slides = '';
            for(let billet in billets.data){
                // let overDue = `<div id="billet_${billets.data[billet].Id}" class="card `+
                //     (isDue(billets.data[billet].dtEmissao) ? 'card-overdue' : '') +`">`
                slides += `
                                <div id="billet_${billets.data[billet].Id}" class="card `+
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
                    `
            }
            sliderBillets.innerHTML = slides;
        }

        slider = tns({
            container: '.billets-slider',
            items: 1,
            responsive: {
                640: {
                    edgePadding: 20,
                    gutter: 20,
                    items: 2
                },
                700: {
                    gutter: 10,
                    items: 3.2
                },
                900: {
                    // gutter: 10,
                    items: 4.5
                }
            },
            animateIn: "tns-fadeIn",
            mouseDrag: true,
            touch: true,
            nav: false,
            prevButton: false,
            nextButton: false,
            controls: false,
            slideBy: "page"
        });
    }
}

getBillets()

$('#refesh-slider').on('click', function (){
    // slider.destroy();
    // slider = slider.rebuild();
    slider.goTo(0);
    getBillets()
})

$('#tyne-next-btn').on('click', function (){
    slider.goTo('next');
})

$('#tyne-prev-btn').on('click', function (){
    slider.goTo('prev');
})


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
