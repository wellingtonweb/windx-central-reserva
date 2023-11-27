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
        /*
        if(session()->has('customer')){

            $validated = $request->validated();

                if(!$validated)
                {
                    Logger::log(session('customer.login'),'error','Erro no pagamento ');
                    return response()->json([
                        'status' => 'error',
                        'error' => 'Não foi possível concluir o pagamento!',
                    ], 400);
                }else {

                    if($validated['method'] == 'picpay'){
                        $body = Checkout::getBodyPaymentPicpay($validated);

                        $response = (new API())->postPayment($body);

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Pagamento criado com sucesso!',
                            'resp' => json_encode($response->original)
                        ], 200);

                    } elseif ($validated['method'] == 'tef') {

                        $body = Checkout::getBodyPaymentTef($validated);

//                        dd($body);

                        $response = (new API())->postPayment($body);

//                        dd($response->original);

//                        $emailValid = (new Validations())->validateEmail(session('customerActive')[0]->email);

//                        if($response->original['data']->status == 'approved' && $emailValid == true){
//
//                            $payment = (new API())->getPayment($response->original['id']);
//
//                            (new API())->getCouponPDF($payment->data);
//                        }

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Criado com sucesso!',
                            'resp' => json_encode($response->original)
                        ], 200);

//                        if($response->original['data']->status == 'approved'){
//                            return $response;
////                            return Checkout::success($response);
//                        }else if($response->original['data']->status == 'created'){
//                            return $response;
////                            return Checkout::created($response);
//                        }else {
//                            return $response;
//                        }
                    } else {
                        $body = Checkout::getBodyPaymentEcommerce($validated);

                        $response = (new API())->postPayment($body);

//                        dd(json_encode($response->original));

                        if($validated['payment_type'] == 'pix'){
                            return response()->json([
                                'status' => 'success',
                                'message' => $response->original,
//                                'resp' =>  $body
                                'resp' => json_encode($response->original)
                            ], 200);
                        }else{
                            if($response->original['data']->status == 'approved'){
                                return Checkout::success($response);
                            }else if($response->original['data']->status == 'created'){
                                return Checkout::created($response);
                            }else {
                                return Checkout::error($response);
                            }
                        }
                    }
                }
        } else {

            throw new CheckUserException();
        }*/

        if(!session()->has('customer'))
        {
            return redirect()->route('central.login')->with('info', 'Sessão expirada!');
        }

//        $validated = $request->all();
        $validated = $request->validated();

        if(!$validated)
        {
            //Logger::log(session('customer.login'),'error','Erro no pagamento ');
            return response()->json(false);
        }

        if($validated['method'] == 'picpay')
        {
            $body = Checkout::getBodyPaymentPicpay($validated);

            $response = (new API())->postPayment($body);

            if($response->status() > 201)
            {
                return response()->json($response->object(), $response->status());
            }

            return response()->json($response->object()->data, 200);
        }
        else
        {
            $body = Checkout::getBodyPaymentEcommerce($validated);

            $response = (new API())->postPayment($body);

            if($response->status() > 201)
            {
                return response()->json($response->object(), $response->status());
            }

            return response()->json($response->object()->data, 200);
        }

    }

    public function callbackCheckout($id)
    {
        if(!session()->has('customer'))
        {
            return redirect()->route('central.login')->with('info','Sessão expirada!');
        }

        return (new API())->callback($id);
    }

}
