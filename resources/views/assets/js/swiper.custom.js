// var swiper = new Swiper(".mySwiper", {
//     direction: 'horizontal',
//     effect: "coverflow",
//     grabCursor: true,
//     centeredSlides: true,
//     slidesPerView: "auto",
//     coverflowEffect: {
//         rotate: 0,
//         stretch: 0,
//         depth: 100,
//         modifier: 1,
//         slideShadows: true,
//     },
//     loop: false,
//
//     // VERIFICAR POR QUE SÓ FUNCIONA COM LOOP TRUE OU TENTAR MODIFICAR O EFEITO DO SLIDE
//
//     scrollbar: {
//         el: ".swiper-scrollbar",
//         hide: true,
//     },
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
//     pagination: {
//         el: ".swiper-pagination",
//         type: "fraction",
//     },
// });

var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 10,
    effect: "coverflow",
    coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },
    pagination: {
        el: ".swiper-pagination",
        type: "fraction",
    },
});

var swiper = new Swiper(".billetsSwiper", {
    // slidesPerView: 3,// - o padrão
    slidesPerView: 1,
    spaceBetween: 10,
    freeMode: true,
    // centeredSlides: false,
    // spaceBetween: 20,
    // pagination: {
    //     el: ".swiper-pagination",
    //     type: "fraction",
    // },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        375: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
    },
});

// //Original
// var swiper = new Swiper(".mySwiper", {
//     effect: "coverflow",
//     grabCursor: true,
//     centeredSlides: true,
//     slidesPerView: "auto",
//     coverflowEffect: {
//         rotate: 50,
//         stretch: 0,
//         depth: 100,
//         modifier: 1,
//         slideShadows: true,
//     },
//     pagination: {
//         el: ".swiper-pagination",
//     },
// });


function sizeOfThings() {
    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;

// Oque você quiser
}

window.addEventListener("click", function () {
    sizeOfThings();
})
