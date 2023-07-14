var acceptedCreditCards = {
    visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
    mastercard: /^5[1-5][0-9]{14}$|^2(?:2(?:2[1-9]|[3-9][0-9])|[3-6][0-9][0-9]|7(?:[01][0-9]|20))[0-9]{12}$/,
    amex: /^3[47][0-9]{13}$/,
    discover: /^65[4-9][0-9]{13}|64[4-9][0-9]{13}|6011[0-9]{12}|(622(?:12[6-9]|1[3-9][0-9]|[2-8][0-9][0-9]|9[01][0-9]|92[0-5])[0-9]{10})$/,
    diners_club: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
    jcb: /^(?:2131|1800|35[0-9]{3})[0-9]{11}$/,
};

// $('#cc-expiration').mask('00/00');

$('#cc-name').keyup(function() {
    $(this).val(this.value.replace(/[^a-zA-Z""]+/g,''));
});

$('#cc, #cvv').on('input', function() {
    $(this).val(this.value.replace(/\D/g,''));
});

$('#cc').on('input', function(){
    if (validateCard($('#cc').val())) {
        $('#cc-error').hide().html('');
    } else {
        $('#cc-error').show().html('Número de cartão inválido!');
    }
});

$('#cvv').on('input', function(){
    // $(this).val(this.value.replace(/\D/g,''));
    if (validateCVV($('#cc').val(), $('#cvv').val())) {
        $('#cvv-error').hide().html('');
    } else {
        $('#cvv-error').show().html('Código de cartão inválido!');
    }
});

$('#cc-expiration').on('input', function(){
    // $(this).val(this.value.replace(/\D/g,''));
    let dtDue = $(this).val()
    // console.log('Click: '+ Date.parse(dtDue))
    // if (validateDue(dtDue)) {
    //     $('#cc-expiration-error').hide().html('');
    // } else {
    //     $('#cc-expiration-error').show().html('Vencimento do cartão inválido!');
    // }
});
// $('#cc, #cvv').out()
// if($(this).val('')) {
//     $('#card-number-error').hide().html('');
// }

function validateDue(dt){
    console.log(dt)
    // let date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(0[1-9]|1[1-9]|2[1-9])$/;
    let date_regex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$;
    if (date_regex.test(dt)) {
        console.log(dt)
        return true
    }
    else{
        console.log(dt)
        return false
    }
}

function validateCard(value) {
    // remove all non digit characters
    var value = value.replace(/\D/g, '');
    var sum = 0;
    var shouldDouble = false;
    // loop through values starting at the rightmost side
    for (var i = value.length - 1; i >= 0; i--) {
        var digit = parseInt(value.charAt(i));

        if (shouldDouble) {
            if ((digit *= 2) > 9) digit -= 9;
        }

        sum += digit;
        shouldDouble = !shouldDouble;
    }

    var valid = (sum % 10) == 0;
    var accepted = false;

    // loop through the keys (visa, mastercard, amex, etc.)
    Object.keys(acceptedCreditCards).forEach(function(key) {
        var regex = acceptedCreditCards[key];
        if (regex.test(value)) {
            accepted = true;
        }
    });

    return valid && accepted;
}

function validateCVV(creditCard, cvv) {
    // remove all non digit characters
    var creditCard = creditCard.replace(/\D/g, '');
    var cvv = cvv.replace(/\D/g, '');
    // american express and cvv is 4 digits
    if ((acceptedCreditCards.amex).test(creditCard)) {
        if((/^\d{4}$/).test(cvv))
            return true;
    } else if ((/^\d{3}$/).test(cvv)) { // other card & cvv is 3 digits
        return true;
    }
    return false;
}
