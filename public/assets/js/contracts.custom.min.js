$('.loading').removeClass('d-none')
inactivitySession();
clearAllSections()

$(document).ready(function(){
    $('#contracts-container').trigger('click');

    $('.loading').addClass('d-none')

    Swal.fire({
        imageUrl: base_url.replace('autoatendimento/', '')+'assets/img/arrastar2.gif',
        text: 'Arraste para os lados para navegar entre os contratos',
        imageAlt: 'Navegar entre faturas',
        showConfirmButton: true,
        showDenyButton: false,
        showCancelButton: false,
        timer: 4000,
        // timerProgressBar: true,
        confirmButtonText: 'OK',
    })
});
