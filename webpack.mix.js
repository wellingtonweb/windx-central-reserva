const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    /* Styles CSS - Libs */
    // .sass('node_modules/bootstrap/scss/bootstrap.scss','public/assets/css/bootstrap.css')

    .styles('resources/views/assets/css/fawesome.min.css','public/assets/css/fawesome.min.css')
    .styles('resources/views/assets/css/app.css','public/assets/css/app.css')
    .styles('resources/views/assets/css/modules/login.css','public/assets/css/modules/login.css')
    .styles('resources/views/assets/css/owl.carousel.min.css','public/assets/css/owl.carousel.min.css')

    /* Styles CSS - Custom */
    .styles('resources/views/assets/css/cover.css','public/assets/css/cover.css')
    .styles('resources/views/assets/css/loader.css','public/assets/css/loader.css')

    // .styles(
    //     [
    //
    //          'resources/views/assets/css/loader.css'
    //         ],'public/assets/css/libs.css')
    // .styles('resources/views/assets/css/print.invoice.css','public/assets/css/print.invoice.css')
    // .styles('resources/views/assets/css/print.coupon.css','public/assets/css/print.coupon.css')

    .styles('resources/views/assets/css/animate.min.css','public/assets/css/animate.css')
    // .styles('node_modules/swiper/swiper-bundle.min.css','public/assets/css/swiper.css')

    .styles('resources/views/assets/css/print-pdf.css','public/assets/css/print-pdf.css')

    /* Scripts JS - Libs */
    .scripts('node_modules/jquery/dist/jquery.js', 'public/assets/js/jquery.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/assets/js/bootstrap.js')
    .scripts('resources/views/assets/js/sweetalert2.all.min.js', 'public/assets/js/swal2.js')
    .scripts('resources/views/assets/js/owl.carousel.min.js', 'public/assets/js/owl.carousel.min.js')

    /* Scripts JS - Custom */
    .scripts('resources/views/assets/js/functions.js', 'public/assets/js/functions.js')
    .scripts('resources/views/assets/js/effects.js', 'public/assets/js/effects.js')

    // .scripts('resources/views/assets/js/jquery-3.5.1.min.js', 'public/assets/js/jquery-3.5.1.min.js')

    .scripts('resources/views/assets/js/jquery.mask.min.js', 'public/assets/js/jquery.mask.min.js')
    // .scripts('resources/views/assets/js/functions.js', 'public/assets/js/functions.js')

    // .scripts('resources/views/assets/js/js.jsbarcode2.js', 'public/assets/js/js.jsbarcode2.js')
    // .scripts('resources/views/assets/js/generate-pdf.js', 'public/assets/js/generate-pdf.js')
    // .scripts('resources/views/assets/js/slider-card.js', 'public/assets/js/slider-card.js')
    // .scripts('resources/views/assets/js/e-cart.js', 'public/dev/assets/js/e-cart.js')
    // .scripts('resources/views/assets/js/e-cart-control.js', 'public/dev/assets/js/e-cart-control.js')
    // .scripts('resources/views/assets/js/payment.js', 'public/dev/assets/js/payment.js')

    .scripts([
        'resources/views/assets/js/jspdf.min.js',
        'node_modules/html2canvas/dist/html2canvas.min.js'
    ], 'public/assets/js/pdf.js')

    .scripts('resources/views/assets/js/jsbarcode2.js', 'public/assets/js/jsbarcode2.js')
    .scripts('resources/views/assets/js/intro.js', 'public/assets/js/intro.js')
    .scripts('resources/views/assets/js/moment.min.js', 'public/assets/js/moment.min.js')
    .scripts('resources/views/assets/js/functions-payment.js', 'public/assets/js/functions-payment.js')

    .scripts([
        'resources/views/assets/js/e-cart.js',
        'resources/views/assets/js/e-cart-control.js',
        'resources/views/assets/js/e-cart-checkout.js',
    ], 'public/assets/js/payment.js')

    /* Scripts JS - Custom pages*/
    .scripts('resources/views/assets/js/contracts.custom.js', 'public/assets/js/contracts.custom.min.js')
    .scripts('resources/views/assets/js/contract.custom.js', 'public/assets/js/contract.custom.min.js')
    .scripts('resources/views/assets/js/payments.custom.js', 'public/assets/js/payments.custom.min.js')

    .copyDirectory('resources/views/assets/img','public/assets/img')
    .copyDirectory('resources/views/assets/fonts','public/assets/fonts')
    .copyDirectory('resources/views/assets/webfonts','public/assets/webfonts')


//C:\Users\Wellington\Desktop\new_projects\windx_central\resources\views\assets\css_old
