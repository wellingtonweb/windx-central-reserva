<?php


namespace App\Services;


use App\Mail\CouponPDF;
use App\Models\AppLog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Jobs\couponMailPDF;

class SendMail
{

    public function couponMailPDF($id)
    {

        if(session()->has('customer')) {
            $customer = session('customer');
            $payment = (new API())->getPayment($id);

            $pay = Functions::dateToPt($payment->data->created_at);

            $data["full_name"] = $customer['full_name'];
            $data["email"] = $customer['email'];
            $data["title"] = "Comprovante de pagamento nº ".$payment->data->id." - Pago em ".$pay;
            $data["body"] = "Olá ".$customer['full_name'].", para sua comodidade, enviamos em anexo, seu comprovante de pagamento em formato digital!";
            $data["payment_id"] = "Pagamento nº: ".$payment->data->id;
            $data["payment_created"] = "Data do pagamento: ".$pay;
            $data["value"] = "Valor pago: R$ ".number_format($payment->data->amount, 2, ',', '');
            $data["payment"] = (array)($payment->data);

            try {

                couponMailPDF::dispatch($data)->delay(now()->addSecond('10'));

                return response()->with('msg','E-mail enviado com sucesso!');

            } catch (\Exception $e) {
                Session::forget('billet-pdf');

                return response()->json([
                    'status' => 'error',
                    'error' => $e->getMessage(),
                ], 400);
            }
        } else {
            throw new CheckUserException();
        }
    }

//    public function notify($message)
//    {
//        $data["email"] = env('MAIL_ADMIN_APP');
//        $data["message"] = $message;
//
//        try {
//
//            NotificationApp::dispatch($data)->delay(now()->addSecond('10'));
//            //Mail::to($data["email"])->send(new CouponPDF($data));
//
////            Session::forget('billet-pdf');
//
//            return response()->json([
//                'status' => 'success',
//                'message' => 'E-mail enviado com sucesso!',
//            ], 200);
//
//        } catch (\Exception $e) {
//            Session::forget('billet-pdf');
//            return response()->json([
//                'status' => 'error',
//                'error' => $e,
//            ], 400);
//        }
//
//    }


}
