<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckUserException;
use App\Helpers\UserInfo;
use App\Http\Requests\CentralLogonRequest;
use App\Services\ApiConnect;
use App\Services\API;
use App\Helpers\WorkingDays;
use App\Services\Functions;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PagesController extends Controller
{

//    public function contracts()
//    {
//        if(session()->has('customer')){
//            session()->forget('customerId');
//            $customers = session('customer');
//
//            if(count($customers) == 1) {
//                return redirect()->route('terminal.contract', ['customerId' => $customers[0]->id]);
//            }else {
//                return view('contracts', ['customers' => $customers]);
//            }
//        } else {
//            throw new CheckUserException();
//        }
//    }

    public function release(Request $request)
    {
        $data = [
            "id" => $request->id,
            "cpf_cnpj" => str_replace(['/', '-', '.'], '', $request->cpf_cnpj)
        ];

        if(isset($data)){
            $response = (new API())->releaseCustomerID($data);
            return response()->json($response);
        } else {
            throw new CheckUserException();
        }
    }

    public function contract($customerId)
    {
        if(session()->has('customer')){
//            $customers = session('customer');

            $customer = (new API())->getCustomer($customerId);

//            dd(get_debug_type($customer));

            session()->put('customerActive', $customer[0]);

//            dd(session('customerActive')[0]->full_name);

//            dd(session('customerActive')[0]->email);

            session()->put('customerId', $customerId);

//            $test = WorkingDays::isHoliday('2023-11-02T00:00:00');
            $test = WorkingDays::hasFees('2023-07-15T00:00:00');
//            $test = WorkingDays::hasFees('2023-11-15T00:00:00');
            dd($test);

            return view('contract', ['customer' => $customer]);
//            dd($customer);

//            foreach ($customers as $customer){
//                if($customer->id == $customerId){
////                    dd($customer);
//                    return view('payment', ['customer' => $customer]);
//                }else {
//                    dd(null);
//                }
//            }

//            $customer_update = (new API())->getCustomer($customer['id']);


        } else {
            throw new CheckUserException();
        }
    }

    public function payments($customerId)
    {
        if(session()->has('customer')){
            session()->put('customerId', $customerId);

            $payments = json_decode(json_encode((new API())->getPayments()),true);
            $paymentCustomer = [];

            foreach($payments as $key => $payment){
                $paymentCustomer = array_filter($payment, function($v, $k) {
                    return $v['customer'] == session('customerId');
                }, ARRAY_FILTER_USE_BOTH);
            }

            $data = $this->paginate($paymentCustomer);

            return view('payments', compact('data'));

        } else {
            throw new CheckUserException();
        }
    }

    public function check($billetId)
    {
        if(session()->has('customerId')){

            if(!$billetId){
                return response()->json(false);
            }

            session()->put('billetId', $billetId);

            $payments = json_decode(json_encode((new API())->getPayments()),true);
            $paymentCustomer = [];
            $billetPay = [];
            $billets = [];

            foreach($payments as $key => $payment){
                $paymentCustomer = array_filter($payment, function($v, $k) {
//                    return $v['customer'] == session('customerId');
                    return $v['customer'] == session('customerId') && $v['status'] != 'approved';
                }, ARRAY_FILTER_USE_BOTH);

                foreach($paymentCustomer as $key => $billet){
                    $billetPay = array_filter($billet['billets'], function($v2, $k2) {
                        return $v2['billet_id'];
                    }, ARRAY_FILTER_USE_BOTH);

                    foreach($billetPay as $key => $billet){
                        $billets = array_filter($billet, function($v3, $k3) {
                            //1454866
                            return $v3 == session('billetId');
                        }, ARRAY_FILTER_USE_BOTH);
                    }
                }
            }

            return response()->json($billets ? true : false);

        } else {
            throw new CheckUserException();
        }
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

//    public function pdf()
//    {
//        if(session()->has('customer')){
//            $customer = session('customer');
////        $pdf = Pdf::loadView('pdf.invoice', $customer);
////        return $pdf->download('boleto.pdf');
//            return view('pdf.invoice');
////            return view('pdf.invoice',['customer' => $customer]);
//        } else {
//            throw new CheckUserException();
//        }
//    }


}
