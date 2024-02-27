<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthController2;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\CaptchaController;



Route::name('central.')->group(function(){

    Route::get('clear', function() {
        $clearCache = Artisan::call('cache:clear');
        $clearView = Artisan::call('view:clear');
        $clearConfig = Artisan::call('config:clear');
        $clearOptimize = Artisan::call('optimize:clear');
        $clearRoute = Artisan::call('route:clear');
        return redirect()->route('central.login');
    });

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('logon', [AuthController::class, 'logon'])->name('logon');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//    Route::get('/lembrar-senha', [AuthController2::class, 'forgotPassword'])->name('forgot.password');
//    Route::post('/forgot-password', [AuthController2::class, 'mailForgotPassword'])->name('mail.forgot.password');
//    Route::get('/nova-senha/{token}', [AuthController::class, 'newPassword'])->name('new.password');
//    Route::post('/send-new-password', [AuthController::class, 'sendNewPassword'])->name('reset.password');
//    Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha'])->name('reload.captcha');
    Route::get('/callback/{id}', [PaymentController::class, 'callback'])->name('callback');
    Route::get('/tokencielo', [PagesController::class, 'tokencielo'])->name('tkcielo');
    Route::get('/debito', [PagesController::class, 'debit'])->name('debit');

    Route::middleware(['check.user'])->group(function () {

        /* Simple Routes */
//        Route::get('/', function () {
//            return redirect()->route('central.home');
//        });
        Route::get('/home', [PagesController::class, 'home'])->name('home');
        Route::get('/contrato', [PagesController::class, 'contract'])->name('contract');
        Route::get('/graficos', [PagesController::class, 'graphics'])->name('graphics');
        Route::post('/graficos', [PagesController::class, 'trafficAverage'])->name('traffic.average');
        Route::get('/conexao', [PagesController::class, 'connection'])->name('connection');
        Route::get('/notasfiscais', [PagesController::class, 'invoices'])->name('invoices');
        Route::get('/invoices', [PagesController::class, 'invoicesList'])->name('invoices.list');
        Route::get('/suporte', [PagesController::class, 'support'])->name('support');
        Route::get('/support-list', [PagesController::class, 'supportList'])->name('support.list');
        Route::post('/suporte/novo', [PagesController::class, 'supportNew'])->name('support.new');
        Route::get('/pagamento', [PagesController::class, 'payment'])->name('payment');
        Route::get('/getbillets', [PagesController::class, 'getbillets'])->name('get.billets');
        Route::get('/getbillets2', [PagesController::class, 'getbillets2'])->name('get.billets2');
        Route::get('/comprovantes', [PagesController::class, 'payments'])->name('payments');
        Route::get('/coupons', [PagesController::class, 'coupons'])->name('coupons');


        /* Payment Routes */
        Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
//        Route::get('/callback/{id}', [PaymentController::class, 'callbackCheckout'])->name('callback');

        /* Services Routes */
        Route::get('/print-invoice/{id}', [PDFController::class, 'printInvoice'])->name('printInvoice');
        Route::get('/invoice-pdf/{id}', [PDFController::class, 'invoicePDF'])->name('invoice');
        Route::get('/coupon/{id}', [PDFController::class, 'coupon'])->name('coupon');
        Route::get('/comprovante/{id}/download', [PDFController::class, 'couponPDF'])->name('coupon.pdf');
        Route::get('/invoice-mail-pdf/{id}', [PDFController::class, 'invoiceMailPDF'])->name('invoice.pdf');
        Route::get('/failure/{data}', [NotificationController::class, 'failure'])->name('failure');
        Route::get('/check/{billetId}', [PagesController::class, 'check'])->name('check');
        Route::post('/contrato/liberar', [PagesController::class, 'release'])->name('release');
    });
});
