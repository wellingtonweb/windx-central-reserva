<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckUserException;
use App\Exceptions\JsonException;
use App\Http\Controllers\Controller;
use App\Mail\Notification;
use App\Notifications\NotificationErrosApp;
use App\Services\Logger;
use App\Services\Result;
use App\Services\Validations;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Helpers\UserInfo;
use Illuminate\Support\Facades\Http;
use App\Services\API;
use App\Services\Checkout;
use App\Services\SendMail;
use App\Services\Functions;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\AppLog;
use App\Jobs\CheckoutJob;

class PaymentController extends Controller implements ShouldQueue
{

    public function checkout(CheckoutRequest $request)
    {
        $status = 'created';

        if(!session()->has('customer'))
        {
            return redirect()->route('central.login')->with('info', 'Sessão expirada!');
        }

        $validated = $request->validated();

        if(!$validated)
        {
            return response()->json(false);
        }

        if($validated['method'] == 'picpay')
        {
            $body = Checkout::getBodyPaymentPicpay($validated);
        }
        else
        {
            $body = Checkout::getBodyPaymentEcommerce($validated);
        }

        $response = (new API())->postPayment($body);

//        dd($response->status(), $response->object(), ($response->object())->data->status);

//        $status =

        if($response->status() > 201 && ($response->object())->data->status != 'approved')
        {
            return response()->json('Pagamento recusado!', $response->status());
        }

        $payment = json_decode(json_encode($response->object()->data),true);

        session()->put("payment", $payment);

        return response()->json($response->object()->data, 200);

    }

    public function callback($id)
    {

        if(!session()->has('customer'))
        {
            return redirect()->route('central.login')->with('info','Sessão expirada!');
        }

        return (new API())->callback($id);

    }

    public function callbackCheckout($id)
    {
//        if(session()->has('customer') && !empty($id))
//        {
        return redirect()->route('central.payment')->with('success',"Pagamento {$id} realizado com sucesso!");
//        }
    }

}
