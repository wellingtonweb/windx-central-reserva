$(document).ready(function() {
    $('#smartcart').smartCart();



    $('#step-app').steps({
        onFinish: function () {
            // alert('Wizard Completed');
            swal("Concluído!", "Pagamento realizado com sucesso!", "success");
        }
    });

    $('.sc-add-to-cart').click(function (){
        // $(this).attr("disabled", true);
        // $(this).hide();
        // $(this).removeClass('btn-primary');
        // $(this).addClass('btn-danger, btn');
        // $(this).text('Remover');
        // $('.sc-cart-remove').show();
        // $('.sc-add-to-cart').hide();
        // $(this).attr('disabled', true);
    });




    $('.sc-cart-clear').click(function (){
        $('.sc-add-to-cart').attr('disabled', false);
    });

    $('.sc-cart-checkout').click(function (){

        if (!$('.sc-cart-checkout').hasClass('disabled')) {
            Swal.fire({
                title: 'Escolha a forma de pagamento!',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Crédito',
                // confirmButtonText2: 'Débito',
                denyButtonText: `Picpay`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sweet!',
                        text: 'Modal with a custom image.',
                        imageUrl: 'https://unsplash.it/400/200',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    })
                } else if (result.isDenied) {

                    let timerInterval
                    Swal.fire({
                        title: 'Escaneie o QRCode acima com seu aplicativo PicPay!',
                        imageUrl: 'https://images.tcdn.com.br/img/editor/up/477441/QRCodePicpay_Burohaus_03032021.jpg',
                        imageWidth: 431,
                        imageHeight: 658,
                        imageAlt: 'Custom image',
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: () => {
                            // Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })

                }
            })
        }
    })


});
