<?php


namespace App\Services;

use App\Models\AppLog;
use App\Services\API;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\UserInfo;

class Checkout
{
//    private $body;
//    protected $customerIp;
//    protected $customerOs;
//    protected $customerBrowser;
//    protected $customerDevice;

    public function __construct($customer_ip, $customer_os, $customer_browser, $customer_device)
    {
//        $this->customerIp = UserInfo::get_ip();
//        $this->customerOs = UserInfo::get_os();
//        $this->customerBrowser = UserInfo::get_browser();
//        $this->customerDevice = UserInfo::get_device();
    }

    public function getBodyPaymentEcommerce($valid)
    {

        $name = explode(" ", $valid["full_name"]);
        $chars = array(".", "-", "/");
        $identity = str_replace($chars, "", $valid["cpf_cnpj"]);
        $body = [
            'billets' => $valid["billets"],
            'method' => $valid["method"],
            'customer' => $valid["customer"],
//            'customer_origin' => [
//                'ip' => $this->customerIp,
//                'os' => $this->customerOs,
//                'browser' => $this->customerBrowser,
//                'device' => $this->customerDevice,
//            ],
            'buyer' => [
                "first_name" => $name[0],
                "last_name" => end($name),
                "cpf_cnpj" => $identity,
            ],
            'payment_type' => $valid["payment_type"],
            'terminal_id' => Cookie::get('terminal_id'),
        ];

        return $body;
    }

    public function getBodyPaymentTef($valid)
    {
        $body = [
            'customer' => $valid["customer"],
            'billets' => $valid["billets"],
            'method' => $valid["method"],
            "payment_type" => $valid["payment_type"],
//            'customer_origin' => Functions::getCustomerOrigin(),
//            "terminal_id" => 2,
            "terminal_id" => Cookie::get('terminal_id'),
        ];

        return $body;
    }

    public function getBodyPaymentPicpay($valid)
    {
        $name = explode(" ", $valid["full_name"]);

        $body = [
            'customer' => $valid["customer"],
            'billets' => $valid["billets"],
            'buyer' => [
                "first_name" => $name[0],
                "last_name" => end($name),
                "email" => $valid["email"],
                "cpf_cnpj" => $valid["cpf_cnpj"],
                "phone" => $valid["phone"]
            ],
//            'customer_origin' => Functions::getCustomerOrigin(),
            'method' => $valid["payment_type"]
        ];

        return $body;
    }

//    public function success($response)
//    {
//        //SendMail::couponMailPDF($response->original['data']->id);
//
////        Logger::log(session('customer.login'),'info','Pagamento nº '
////            .$response->original['data']->id.' concluído com sucesso.');
////
////        AppLog::create([
////            'customer_id' => session('customer.id'),
////            'content' => 'Pagamento nº '
////                .$response->original['data']->id.' concluído com sucesso.',
////            'operation' => 'checkout',
////            'status' => 'success'
////        ]);
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'Pagamento realizado com sucesso!',
//            'resp' => json_encode($response->original)
//        ], 200);
//    }
//
//    public function created($response)
//    {
////        Logger::log(session('customer.login'),'info','Criado novo pagamento nº '
////            .$response->original['data']->id.'.');
////
////        AppLog::create([
////            'customer_id' => session('customer.id'),
////            'content' => 'Criado novo pagamento nº '
////                .$response->original['data']->id.'.',
////            'operation' => 'checkout',
////            'status' => 'info'
////        ]);
//
//        return response()->json([
//            'status' => 'info',
//            'message' => 'Criado novo pagamento nº '
//                .$response->original['data']->id.'.',
//            'resp' => json_encode($response->original)
//        ], 200);
//    }
//
//    public function error($response)
//    {
////        Logger::log(session('customer.login'),'info','Não foi possível concluir o pagamento nº '
////            .$response->original['data']->id.'.');
////
////        AppLog::create([
////            'customer_id' => session('customer.id'),
////            'content' => 'Não foi possível concluir o pagamento nº '
////                .$response->original['data']->id.'.',
////            'operation' => 'checkout',
////            'status' => 'error'
////        ]);
//
//        return response()->json([
//            'status' => 'error',
//            'message' => 'Não foi possível concluir o pagamento nº '
//                .$response->original['data']->id.'.',
//            'resp' => json_encode($response->original)
//        ], 200);
//    }
//
////    public function setPayment($validated)
////    {
////        $body = '';
////
////        if($validated['method'] == 'picpay'){
////            $body = $this->getBodyPaymentPicpay($validated);
////        } else {
////            $body = $this->getBodyPaymentEcommerce($validated);
////        }
////
////        return (new API())->postPayment($body);
////    }
}
