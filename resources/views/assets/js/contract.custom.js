$('.loading').removeClass('d-none')
    // inactivitySession();
    clearAllSections()
    $(window).on("read", function () {
    // inactivitySession();
    // $('.loading').removeClass('d-none')
});


$(document).ready(function(){
    $('.loading').addClass('d-none')
    $('#contract-container').trigger('click');

    console.log(getFirstName(customerActive.full_name))
    var gender = customerActive.gender === 'Masculino' ? 'o' : 'a';

    Swal.fire({
        title: 'Seja bem vind'+ gender +' '+ getFirstName(customerActive.full_name) +'!',
        imageUrl: base_url.replace('autoatendimento/', '')+'assets/img/arrastar2.gif',
        text: 'Arraste para os lados para navegar entre as faturas',
        imageAlt: 'Navegar entre faturas',
        showConfirmButton: true,
        showDenyButton: false,
        showCancelButton: false,
        timer: 4000,
        // timerProgressBar: true,
        confirmButtonText: 'OK',
    })

});

    $('#printInvoice').submit(function (e){
    e.preventDefault();
    let actionForm = $(this).attr('action');
    let methodForm = $(this).attr('method');
    let dataForm = $(this).serialize();
    const csrfToken = $(input).find('_token').val()
    // let token = {dataForm['0'].name}
    console.log(csrfToken)
    fetch(actionForm,
{
    headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    "X-CSRF-Token": csrfToken,
},
    method: methodForm,
    body: dataForm
    // body: JSON.stringify({a: 1, b: 2})
})
    .then(function(res){ console.log(res) })
    .catch(function(res){ console.log(res) })
})

    $('.btn-print-billet').click(function (){
    const id = $(this).attr('id')
    if(id != 'undefined' && id != null){
    $(this).children('i').removeClass('fa-print').addClass('fa-spinner fa-spin')
    Swal.fire({
    title: 'Aguarde!',
    html: 'Imprimindo boleto!',
    timer: 20000,
    timerProgressBar: false,
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
}
})
    setTimeout(() => {
    $(this).children('i').removeClass('fa-spinner fa-spin').addClass('fa-print')
}, 5000)
}
});
