$('.btn-flip').on('click', function() {
    $('.card-login').addClass('is-flipped');
    //timeOutLogin()
    setTimeout(function () {
        $('#input-document').val('');
        $('.card-login').removeClass('is-flipped');
    }, 60000);
});

const inputDoc = document.getElementById('input-document');
const numPadButtons = document.querySelectorAll('.num-pad');
const btnClear = document.getElementById('clear');
var temp, temp2 = '';
let displayValue = '';

numPadButtons.forEach(button => {
    button.addEventListener('click', function() {
        temp = '';
        temp2 = '';
        displayValue += this.innerHTML;
        inputDoc.value = displayValue
    });
});

btnClear.addEventListener('click', function(e) {
    temp = inputDoc.value;
    displayValue = temp.substring(0,temp.length -1);
    inputDoc.value = displayValue;
});

btnClear.addEventListener('dblclick', function(e) {
    document.getElementById('form_login').reset()
    temp, displayValue = '';
    inputDoc.value = '';
     // = '';
    console.log(inputDoc.value, temp)
});

$("#check-login").on('click',function() {
    $('.logo-windx').addClass('animate__animated animate__fadeOutUp');
    $('#footer').addClass('animate__animated animate__fadeOutDown');
    $('.card-login').removeClass('animate__animated animate__flipInX');
    // $('.card-login').addClass('animate__animated animate__flipOutX');
    $('.card-login').addClass('is-flippedX');
    $('.loader').removeClass('d-none');

    let input = $('.input-document')
    input.unmask();
    let verify = input.val().replace(/\D/g, '').length;
    switch (verify) {
        case 11:
            input.unmask()
            input.val(input.val().replace(/\D/g, ''))
            input.mask("999.999.999-99");
            break;
        case 14:
            input.unmask()
            input.val(input.val().replace(/\D/g, ''))
            input.mask("99.999.999/9999-99");
            break;
        default:
            input.unmask()
            document.referrer;
            break;
    }
});

// $('.num').click(function () {
//     press()
//     let input = $('.input-document')
//     if($(this).attr('rel') != "del"){
//         let num = $(this).attr('rel');
//         input.val(input.val() + num);
//     }else{
//         var temp = input.val();
//         temp = temp.slice(0,temp.length-1);
//         input.val(temp);
//     }
// });
//
// $('.num').dblclick(function () {
//     press()
//     if($(this).attr('rel') == "del") {
//         $('.input-document').val('');
//         $('.input-document').unmask();
//     }
// });

$("#input-document").unmask();

$("#clear").click(function (){
    $("#input-document").unmask();
});


