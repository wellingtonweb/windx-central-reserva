<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivationController;



Route::prefix('assinante')->name('central.')->group(function(){

    Route::get('clear', function() {
        $clearCache = Artisan::call('cache:clear');
        $clearView = Artisan::call('view:clear');
        $clearConfig = Artisan::call('config:clear');
        $clearOptimize = Artisan::call('optimize:clear');
        $clearRoute = Artisan::call('route:clear');
        $clearCache = Artisan::call('cache:clear');
        return redirect()->route('central.login');
    });

    /* Terminals Routes */
    Route::get('bloqueado', [ActivationController::class, 'locked'])->name('locked');
    Route::post('/desbloquear', [ActivationController::class, 'unlock'])->name('unlock');

//    Route::middleware(['check.terminal'])->group(function () {

        Route::get('/', function () {
            return redirect()->route('central.home');
//            return redirect()->route('central.login');
        });

        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('logon', [AuthController::class, 'logon'])->name('logon');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');



        Route::middleware(['check.user'])->group(function () {

            /* Simple Routes */
            Route::get('/home', [PagesController::class, 'home'])->name('home');
            Route::get('/contrato', [PagesController::class, 'contract'])->name('contract');
            Route::get('/notasfiscais', [PagesController::class, 'invoices'])->name('invoices');
            Route::get('/invoices', [PagesController::class, 'invoicesList'])->name('invoices.list');

            Route::get('/suporte', [PagesController::class, 'support'])->name('support');
            Route::get('/support-list', [PagesController::class, 'supportList'])->name('support.list');
            Route::post('/suporte/novo', [PagesController::class, 'supportNew'])->name('support.new');
//            Route::get('/info', [PagesController::class, 'info'])->name('info');
//            Route::get('/contratos', [PagesController::class, 'contracts'])->name('contracts');
            Route::get('/pagamento', [PagesController::class, 'payment'])->name('payment');

            Route::get('/comprovantes', [PagesController::class, 'payments'])->name('payments');
            Route::get('/coupons', [PagesController::class, 'coupons'])->name('coupons');
            Route::post('/contrato/liberar', [PagesController::class, 'release'])->name('release');

            Route::get('/check/{billetId}', [PagesController::class, 'check'])->name('check');

            Route::get('paginate', [NotificationController::class, 'index']);

            /* Payment Routes */
            Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
            Route::get('/callback/{id}', [PaymentController::class, 'callbackCheckout'])->name('callback');

            /* Services Routes */
            Route::get('/print-invoice/{id}', [PDFController::class, 'printInvoice'])->name('printInvoice');
            Route::get('/invoice-pdf/{id}', [PDFController::class, 'invoicePDF'])->name('invoice');
            Route::get('/coupon/{id}', [PDFController::class, 'coupon'])->name('coupon');
            Route::get('/comprovante/{id}/download', [PDFController::class, 'couponPDF'])->name('coupon.pdf');
            Route::get('/invoice-mail-pdf/{id}', [PDFController::class, 'invoiceMailPDF'])->name('invoice.pdf');
            Route::get('/failure/{data}', [NotificationController::class, 'failure'])->name('failure');

        });
//    });

});

//Route::get('login2', [AuthController::class, 'login2'])->name('login2');
