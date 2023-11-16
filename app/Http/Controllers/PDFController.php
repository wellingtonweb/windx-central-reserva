<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckUserException;
use App\Mail\CouponPDF;
use App\Mail\InvoicePDF;
use App\Services\API;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Services\Functions;
use App\Http\Controllers\Controller;

class PDFController extends Controller
{

    public function printInvoice($id)
    {
        if(session()->has('customer')){
            $billets = session('customerActive')->billets;

            foreach ($billets as $billet){
                if($billet->Id == $id){

                    $beneficiary = Functions::getBeneficiary($billet->Id_Empresa);

                    return view('print.invoice',[
                        'invoice' => $billet,
                        'beneficiary' => $beneficiary
                    ]);
                }
            }
        } else {
            throw new CheckUserException();
        }
    }

    public function invoicePDF($id)
    {
        if(session()->has('customer')){
            $billets = session('customer.billets');
            foreach ($billets as $billet){
                //Transformar em array
                if($billet->Id == $id){
                    session()->put('billet-pdf', [$billet]);

                    $pdf = Pdf::loadView('pdf.invoice')->setPaper('a4', 'portrait');
                    return $pdf->download('Boleto-'.substr($billet->NossoNumero, 0, -1).$billet->Agencia.'.pdf');
//                    return view('pdf.invoice',['billet' => $billet]);
                }
            }
        } else {
            throw new CheckUserException();
        }
    }

    public function coupon($id)
    {
        if(session()->has('customer')) {

            if(!session()->has('customerActive')){
                return redirect()
                    ->route('central.contracts')
                    ->with('error','Por gentileza, selecione um contrato!');
            }

            $payment = (new API())->getPayment($id);

            if($payment->data->transaction == null && $payment->data->status != 'approved'){
                return redirect()
                    ->route('central.contract', ['customerId' => $payment->data->customer])
                    ->with('error','O pagamento Nº '.$id.' não foi aprovado!');
            }

            return view('print.coupon', compact('payment'));
//            return view('print.coupon', ['payment' => $payment->data]);

        } else {
            throw new CheckUserException();
        }
    }

    public function couponPDF($id)
    {
        if(session()->has('customer')) {

            $payment = (new API())->getPayment($id);

            return (new API())->getCouponPDF($payment->data);
//            return view('pdf.coupon', ['payment' => $payment->data]);

        } else {
            throw new CheckUserException();
        }
    }

    public function invoiceMailPDF($id)
    {
        if(session()->has('customer')) {
            $customer = session('customer');
            $billets = session('customer.billets');

            foreach ($billets as $billet){
                if($billet->Id == $id){

                    $pay = Functions::dateToPt($billet->Vencimento);
                    $data["email"] = $customer['email'];
                    $data["title"] = "Fatura nº ".$billet->NossoNumero." - Vencimento ".$pay;
                    $data["body"] = "Olá ".$customer['full_name'].", para sua comodidade, estamos te enviando sua fatura digital deste mês!";
                    $data["billetNumber"] = "Fatura nº: ".$billet->NossoNumero;
                    $data["pay"] = "Vencimento: ".$pay;
                    $data["value"] = "Valor: R$ ".number_format($billet->Valor, 2, ',', '');

                    Session::put('billet-pdf', [$billet]);

                    try {

                        Mail::to($data["email"])->send(new InvoicePDF($data, [$billet]));

                        Session::forget('billet-pdf');

                        return response()->json([
                            'status' => 'success',
                            'message' => 'E-mail enviado com sucesso!',
                        ], 200);

                    } catch (\Exception $e) {
                        Session::forget('billet-pdf');
                        return response()->json([
                            'status' => 'error',
                            'error' => $e,
                        ], 200);
                    }

                }
            }
        } else {
            throw new CheckUserException();
        }
    }

    public function couponMailPDF($id)
    {
        if(session()->has('customer')) {
            $customer = session('customer');
            $billets = session('customer.billets');

            foreach ($billets as $billet){
                if($billet->Id == $id){

                    $pay = Functions::dateToPt($billet->Vencimento);
                    $data["email"] = $customer['email'];
                    $data["title"] = "Fatura nº ".$billet->NossoNumero." - Vencimento ".$pay;
                    $data["body"] = "Olá ".$customer['full_name'].", para sua comodidade, estamos te enviando sua fatura digital deste mês!";
                    $data["billetNumber"] = "Fatura nº: ".$billet->NossoNumero;
                    $data["pay"] = "Vencimento: ".$pay;
                    $data["value"] = "Valor: R$ ".number_format($billet->Valor, 2, ',', '');

                    Session::put('billet-pdf', [$billet]);

                    try {

                        Mail::to($data["email"])->send(new InvoicePDF($data, [$billet]));

                        Session::forget('billet-pdf');

                        return response()->json([
                            'status' => 'success',
                            'message' => 'E-mail enviado com sucesso!',
                        ], 200);

                    } catch (\Exception $e) {
                        Session::forget('billet-pdf');
                        return response()->json([
                            'status' => 'error',
                            'error' => $e,
                        ], 200);
                    }

                }
            }
        } else {
            throw new CheckUserException();
        }
    }

    public function download($linkInvoice)
    {
        $apiURL = env('API_URL_VIGO_PROD');
//        dd($apiURL);

         return redirect($apiURL );
    }

}
