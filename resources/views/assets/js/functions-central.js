$('#show-all-switch').click(function (){
    if( $(this).is(":checked") == true ){
        $('#show-all-label').html('Mostrar aprovados')
        $('#table-coupons-list tbody tr').each(function(){
            if ($(this).hasClass('t-inactive')) {
                $(this).removeClass("d-none");
            }
        });
    }else {
        $('#show-all-label').html('Mostrar todos')
        $('#table-coupons-list tbody tr').each(function(){
            if ($(this).hasClass('t-inactive')) {
                $(this).addClass("d-none");
            }
        });
    }
});



$('.click-loader').on('click', function (){
    console.log('Clicou no link!')
    $(".overlay").trigger('click')
});

$('body').on('mouseenter mouseleave','.nav-item',function(e){
    if ($(window).width() > 750) {
        var _d=$(e.target).closest('.nav-item');_d.addClass('show');
        setTimeout(function(){
            _d[_d.is(':hover')?'addClass':'removeClass']('show');
        },1);
    }
});

$('#btn-logout').on('click', function() {
    logout();
});

// function timeOutLogin(){
//     var counterBack;
//     document.onkeypress = resetTimer2;
//     document.onmousedown = resetTimer2; // touchscreen presses
//     document.ontouchstart = resetTimer2;
//     document.onclick = resetTimer2;     // touchpad clicks
//     function resetTimer2() {
//         clearInterval(counterBack);
//         var i = 100;
//         counterBack = setInterval(function () {
//             i--;
//             if (i > 0) {
//                 $('.progress-bar').css('width', i + '%');
//             } else {
//                 clearInterval(counterBack);
//                 $('.card-login').removeClass('is-flipped');
//             }
//         }, 500);
//     }
// }


$('.btn-contract-selected').click(function () {
    let customer_id = $(this).attr('id').replace(/\D/g, '')
    let invoices = JSON.parse($(this).attr('data-invoices'));
    // console.log($(this).attr('id'))

    $('.row-customer-invoices').addClass('d-none')


    if ($("div#"+customer_id).length) {
        $("div#"+customer_id).removeClass('d-none');
    }

    // console.log(invoices.length)

    if (invoices.length != 0) {
        loadInvoices(customer_id, invoices);
        hiddenContracts()

        $('#payment-title').text('Contrato Nº: ' + customer_id + ' - (Checkout)')
        // $('#contracts-container').addClass('animate__animated animate__fadeOutUp d-none')
        // $('#invoices-container').addClass('animate__animated animate__fadeInUp ').removeClass('animate__fadeOutDown d-none')
        // $('.owl-carousel').removeClass('d-none')
    } else {
        alert('O cadastro ' + customer_id + ' não possuí boletos em aberto!')
    }

});

// function hiddenContracts(){
//     // $('#payment-title').text('Contrato Nº: ' + customer_id + ' - (Checkout)')
//     $('#contracts-container').addClass('animate__animated animate__fadeOutUp d-none')
//     $('#invoices-container').addClass('animate__animated animate__fadeInUp ').removeClass('animate__fadeOutDown d-none')
// }
//
// $('#back-to-contracts').click(function () {
//     clearAllSections()
//     // $('#clear-cart').trigger('click');
//     $('#payment-title').text('Pagamento (Contratos)')
//     $('#contracts-container').addClass('animate__animated animate__fadeInDown').removeClass('animate__fadeOutUp d-none')
//     $('#invoices-container').addClass('animate__animated animate__fadeOutDown d-none')
// });
//
//
// let juros;
//
//
// var owl = $("#owl-demo");
//
// owl.owlCarousel({
//     items : 3,
//     itemsDesktop:[1199,3],
//     itemsDesktopSmall:[980,2],
//     itemsMobile : [600,1],
//     // afterMove: function (elem) {
//     //     var current = this.currentItem;
//     //     var src = elem.find(".owl-item").eq(current).find("div.invoice-slide").attr('title');
//     //     console.log('Title ' + src);
//     // }
// });

// function calculaJuros(){

//
// function calcTotal(juros,valor){
//
// }

// jQuery(document).ready(function() {
//
//     let obJson = {
//         "owl" : [
//             {"item" : "<span class='item'><h1>1</h1></span>"},
//             {"item" : "<span class='item'><h1>2</h1></span>"},
//             {"item" : "<span class='item'><h1>3</h1></span>"},
//             {"item" : "<span class='item'><h1>4</h1></span>"},
//             {"item" : "<span class='item'><h1>5</h1></span>"},
//             {"item" : "<span class='item'><h1>6</h1></span>"},
//             {"item" : "<span class='item'><h1>7</h1></span>"},
//             {"item" : "<span class='item'><h1>8</h1></span>"},
//             {"item" : "<span class='item'><h1>9</h1></span>"},
//             {"item" : "<span class='item'><h1>10</h1></span>"},
//             {"item" : "<span class='item'><h1>11</h1></span>"},
//             {"item" : "<span class='item'><h1>12</h1></span>"},
//             {"item" : "<span class='item'><h1>13</h1></span>"},
//             {"item" : "<span class='item'><h1>14</h1></span>"}
//         ]
//     }
//
//     console.log(obJson)
//
//     // jQuery("#owl-demo").owlCarousel({
//     //     jsonPath : "../assets/js/data.json"
//     // });
//
//     jQuery("#owl-demo").owlCarousel({
//         json : obJson,
//         jsonSuccess : customDataSuccess
//     });
//
//     function customDataSuccess(data){
//         console.log(data)
//         var content = "";
//         for(var i in data["items"]){
//
//             var img = data["items"][i].img;
//             var alt = data["items"][i].alt;
//
//             content += "<img src=\"" +img+ "\" alt=\"" +alt+ "\">"
//         }
//         jQuery("#owl-demo").html(content);
//     }
//
//
//
// });

function printInvoice(id_btn) {
    // const invoice = btn.title;
    const invoices = $('#getInvoices').attr('data-invoices')
    const invoice = $(`#${id_btn}`).attr('data-invoice');
    console.log(invoices)
    // $.each(invoice, function (key, item) {
    //     console.log(key)
    //     console.log(item.Id)
    //     // console.log(invoice)
    // });


};

function loadInvoices(customer_id, invoices) {



    // var content = '<div class="card">'+customer_id+'</div>'

    // owl.data('owlCarousel').addItem(content,0);

    let calculo = 0, total = 0
    $('#news-slider').html('')
    owl.html('');

    // var arr = invoices.map(function(obj) {
    //     return obj;
    //     // return Object.keys(obj).map(function(key) {
    //     //     return obj[key];
    //     // });
    // })
    // console.log(arr);



    // console.log('Faturas: '+invoices.length)

    $.each(invoices, function (key, invoice) {


        // console.log(arr);

        const billet = JSON.stringify(invoice, true);
        calculo = calculaJuros(invoice.Vencimento, invoice.Valor)
        total = Number(calculo.total);
        let data = {
            'reference': invoice.NossoNumero,
            'value': invoice.Valor,
            'id': invoice.Id,
            'discount': 0,
            'price': calculo.total,
            'addition': calculo.juros
        }
        // console.log(data)
        let vencimento = new Date(invoice.Vencimento)
        var content = '<div id="invoice-' + key + '" class="invoice-slide swiper-slide ' +
            (invoice.Valor != calculo.total ? 'text-danger' : '')
            + '" data-id="' + invoice.Id + '" title="' + invoice.Id + '">' +
            '<div class="invoice-content">' +
            '<h3 id="title-' + key + '" class="invoice-title" data-id="' + invoice.Id + '">' + invoice.Referencia + '</h3>' +
            '<ul class="list-group list-group-flush ' + invoice.Vencimento + '">' +
            '<li class="list-group-item"><b>Nosso nº: </b><span id="reference">' + invoice.NossoNumero + '</span></li>' +
            '<li class="list-group-item"><b>Vencimento: </b><span id="payday">' + vencimento.toLocaleDateString() + '</span></li>' +
            '<li class="list-group-item"><b>Valor:  </b><span id="value">' +
            (invoice.Valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '</span></li>' +
            '<li class="list-group-item"><b>Valor atual: </b><b><span id="total">' +
            total.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) + '</span></b></li>' +
            '</ul>' +
            '<ul class="list-group list-group-flush pt-0 pb-0">' +
            '<li class="list-group-item invoice-actions">' +
            // '<a href="/invoice/' + invoice.Id + '" id="print-billet-' + key + '"' +
            // 'class="btn btn-info btn-print-billet" data-id="' + invoice.Id + '">' +
            // '<i class="fa fa-print" aria-hidden="true"></i> <span class="action-name">imprimir</span>' +
            // '</a>' +
            '<a href="#" id="print-billet-' + key + '"' +
            'class="btn btn-info btn-print-billet" data-invoice="' + invoice.Id + '" onclick="printInvoice(this.id)">' +
            '<i class="fa fa-print" aria-hidden="true"></i> <span class="action-name">imprimir</span>' +
            '</a>' +
            '<a href="#" id="select-billet-' + key + '"' + 'class="add-to-cart btn btn-success"' +
            'data-reference="' + invoice.NossoNumero + '" data-value="' + invoice.Valor + '"' +
            'data-id="' + invoice.Id + '" data-discount="' + 0 + '"' +
            'data-price="' + calculo.total + '"' + 'data-invoice="' + data + '"' +
            'data-addition="' + calculo.juros + '" onclick="addInvoiceToCart(this)">' +
            '<i class="fa fa-check" aria-hidden="true"></i> <span class="action-name">pagar</span>' +
            '</a>' +
            '<a href="#" id="remove-billet-' + key + '" class="btn btn-danger delete-item d-none"' +
            'data-reference="' + invoice.NossoNumero + '" data-id="' + invoice.Id + '" onclick="removeInvoiceToCart(this)">' +
            '<i class="fa fa-times" aria-hidden="true"></i> <span class="action-name">remover</span>' +
            '</a>' +
            '</li>' +
            '</ul>' +
            '</div>' +
            '<div class="container-icon-move-hand' + (invoice.length < 4 ? "d-none" : "") + '">' +
            '<i class="fa fa-long-arrow-alt-left icon-arrow-left"></i>' +
            '<i class="fa fa-hand-pointer icon-move-hand"></i>' +
            '</div>' +
            '</div>';
        // owl.data('owlCarousel').replace(content,0)
        // owl.data('owlCarousel').initialize()
        // owl.data('owlCarousel').destroy();
        // owl.owlCarousel({
        //     items: 3,
        // });

        owl.data('owlCarousel').addItem(content,0);

        let owlItem = owl.data('owlCarousel').$owlItems

        // $.each(owlItem, function (key, item) {
        //     console.log(key)
        //     console.log(item)
        // });
        // swiper.removeAllSlides();
        // swiper.update();
        // swiper.appendSlide('' +

        // );
        // swiper.update();
    })
};
