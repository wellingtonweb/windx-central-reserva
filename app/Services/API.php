<?php

namespace App\Services;

use App\Exceptions\AuthenticationException;
use App\Exceptions\CheckoutException;
use App\Exceptions\TerminalException;
use App\Exceptions\ApiConnectException;
use App\Exceptions\TransactionException;
use App\Services\Logger;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\AppLog;

class API
{
    private $apiUrl;
    private $apiLogin;
    private $apiPassword;
    private $apiToken;
//    private $app_log;

    public function __construct()
//    public function __construct(AppLog $app_log)
    {
        $this->apiUrl = getenv('API_URL');
        $this->apiLogin = getenv('API_LOGIN');
        $this->apiPassword = getenv('API_PASSWORD');
        $this->apiToken = $this->tokenApi();
//        $this->app_log = $app_log;
    }

    public function tokenApi()
    {
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->post( $this->apiUrl . '/api/login', [
                'email' => $this->apiLogin,
                'password' => $this->apiPassword
            ]);

        if($response->successful()){
            return $apiToken = ($response->object())->token;
        }else{
            return $response->throw();
//            throw new ApiConnectException();
        }
    }

    public function customerLogon($validate)
    {
        if($validate){
            $response = Http::accept('application/json')
//                ->retry(3, 100)
                ->withToken($this->apiToken)
                ->post($this->apiUrl . '/api/customer/central/login', [
                    'login' => $validate['login'],
                    'password' => $validate['password']
//                    'password' => base64_encode($validate['password'])//Auth with mail
                ]);

            if($response->status() == 500) return null;

            return $response;
        }

        return null;
    }

    public function updatePasswordCustomer($customer)
    {
        $response = '';
        if(!empty($customer)){
            $response = Http::accept('application/json')
                ->retry(3, 100)
                ->withToken($this->apiToken)
                ->post($this->apiUrl . '/api/customer/reset-password', $customer);
        }

        return $response;
    }

    public function getCustomer($customer_id)
    {
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->get($this->apiUrl . '/api/customer/' . $customer_id);

        if($response->successful()){
            return $response->object();
        }else{
            return $response->throw();
        }
    }

    public function releaseCustomerID($customer)
    {

        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->post($this->apiUrl . '/api/customer/release', $customer);

//        dd($response->object());

//        if($response->successful()){
//            return response()->json($response->object());
        return $response->object();
//        }else{
//            return $response->throw();
//        }
    }

    public function getPayments()
    {
        $response = Http::accept('application/json')
            ->withToken($this->apiToken)
            ->retry(3, 100)
            ->get($this->apiUrl . '/api/payments');

        if($response->successful()){
//        if($response->successful()){
            return $response->object();
        }else{
            return $response->throw();
//            throw new ApiConnectException();
        }
    }

    public function getPayment($id)
    {
        $response = Http::accept('application/json')
            ->withToken($this->apiToken)
            ->retry(3, 100)
            ->get($this->apiUrl . '/api/payments/' . $id);

//        dd($response->object());

        if($response->successful()){
            return $response->object();
        }else{
            return $response->throw();
        }
    }

    public function getCalls($id)
    {
        $response = Http::accept('application/json')
            ->withToken($this->apiToken)
            ->retry(3, 100)
            ->get($this->apiUrl . '/api/customer/calls/' . $id);

//        dd($response->object());

        if($response->successful()){
            return $response->object();
        }else{
            return $response->throw();
        }
    }

    public function postCall($call)
    {
        $response = Http::accept('application/json')
            ->withToken($this->apiToken)
            ->retry(3, 100)
            ->post($this->apiUrl . '/api/customer/call/new', $call);

//        dd($response->object());

        if($response->successful()){
            return $response->object();
        }else{
            return $response->throw();
        }
    }

    public function postPayment($body)
    {
//        try {
            return Http::accept('application/json')
                ->withToken($this->apiToken)
                ->retry(3, 100)
                ->post($this->apiUrl . '/api/payments', $body);

//        } catch (\Exception $e) {
//
////            AppLog::create([
////                'customer_id' => session('customer.id'),
////                'content' => $e->getMessage(),
////                'operation' => 'checkout',
////                'status' => 'error'
////            ]);
//
//            return response()->json([
//                'status' => 'error',
//                'error' => $e->getMessage(),
//            ], 400);
//        }
    }

    public function callback($id_transaction){
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->get($this->apiUrl . '/api/payments/' . $id_transaction);

        try {
            return response()->json($response->object()->data);
        } catch (HttpException $e) {
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function getCouponPDF($payment)
    {
//        $payment = (array)($payment);
        $customer = session('customer');
        $pay = date("d/m/Y", strtotime($payment['created_at']));
        $customerFirstName = explode(" ", $customer['full_name']);
        $couponContent = [
            "full_name" => $customer['full_name'],
            "first_name" => $customerFirstName[0],
            "email" => "sup.windx@gmail.com",
//            "email" => $customer['email'],
            "title" => "Comprovante de pagamento nº ".$payment['id']." - Pago em ".$pay,
            "payment_id" => $payment['id'],
            "payment_created" => $pay,
            "billets" => (array)$payment['billets'],
            "value" => number_format($payment['amount'], 2, ',', ''),
            "payment" => $payment,
            "date_full" => ucfirst((new Functions)->getDateFull()),
            "date_time_full" => ucfirst((new Functions)->getDateTimeFull())
        ];

        $paper = array(0,0,200,460);
//        $paper = array(0,0,280,600);

//        dd($payment, $customer, $pay, $customerFirstName, $couponContent);

        $pdf = Pdf::loadView('pdf.coupon', $couponContent)->setPaper( $paper, 'portrait');

        return $pdf->download('Comprovante_'.$payment['id'].'-'.Functions::dateToPt($payment['created_at']).'.pdf');
    }

    public function getTerminal($id)
    {
        $response = Http::accept('application/json')
            ->withToken($this->apiToken)
            ->retry(3, 100)
            ->get($this->apiUrl . '/api/terminals/' . $id);

//        dd($response->status());

        try {
            return $response->object();
        } catch (Exception $e){
//            throw new TerminalException();
            return response()->json([
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 400);
        }

//        dd($response);

//        if($response->ok()){
////        if($response->successful()){
//            return $response->object();
//        }else{
//            throw new TerminalException();
//        }
    }

    public function checkMailCustomer($login){
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->post($this->apiUrl . '/api/customer/check-login-customer', ['login' => $login]);

        return $response->object();

//        try {
//            return response()->json($response);
//        } catch (HttpException $e) {
//            return response()->json([
//                'status' => 'error',
//                'error' => $e->getMessage(),
//            ], 400);
//        }
    }



}
