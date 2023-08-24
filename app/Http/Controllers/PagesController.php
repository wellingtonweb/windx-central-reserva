<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckUserException;
use App\Helpers\UserInfo;
use App\Http\Requests\CentralLogonRequest;
use App\Models\CustomerLog;
use App\Services\ApiConnect;
use App\Services\API;
use App\Helpers\WorkingDays;
use App\Services\Functions;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Resources\Json\JsonResource;

class PagesController extends Controller
{

    public function home()
    {
        if(session()->has('customer')){
            return view('home', ['header' => 'Home']);
        } else {
            throw new CheckUserException();
        }
    }

    public function contract()
    {
        if(session()->has('customer')){
            return view('contract', [
                'header' => 'Contrato',
                'customer' => session('customer')
            ]);
        } else {
            throw new CheckUserException();
        }
    }

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

    public function payment()
    {
        if(session()->has('customer')){

            $customer = (new API())->getCustomer(session('customer')->id);

            return view('payment', [
                'header' => 'Pagamento',
                'customer' => $customer
            ]);

        } else {
            throw new CheckUserException();
        }
    }

    public function payments()
    {
        if(session()->has('customer')){
            return view('payments', ['header' => 'Comprovantes (2ª via)']);
        } else {
            throw new CheckUserException();
        }
    }



    public function coupons()
    {
        if(session()->has('customer')){
            $payments = json_decode(json_encode((new API())->getPayments()),true);
            $paymentCustomer = [];

            foreach($payments as $key => $payment){

                $paymentCustomer = array_filter($payment, function($v, $k) {
                    return $v['customer'] == session('customer')->id && $v['terminal_id'] == null && $v['method'] == 'ecommerce' && $v['status'] == 'approved';
                }, ARRAY_FILTER_USE_BOTH);
            }

            return Datatables::of($paymentCustomer)
                ->addColumn('action', function($data){
                    if($data['status'] === 'approved'){
                        $button = '<a href="'. route('central.coupon.pdf', ['id' => $data['id'] ]) .
                            '" data-toggle="tooltip"  data-original-title="Download" class="download-pdf btn btn-info btn-sm"><i class="fa fa-download pr-1"></i></a>';
                    }else{
                        $button = '---';
//                        $button = '<a href="javascript:void(0)" data-original-title="None" class="btn btn-secondary btn-sm" style="pointer-events:none;"><i class="fa fa-times pr-1"></i></a>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            throw new CheckUserException();
        }
    }

    public function invoices()
    {
        if(session()->has('customer')){
            return view('invoices', [
                'header' => 'Notas fiscais',
            ]);
        } else {
            throw new CheckUserException();
        }
    }

    public function invoicesList()
    {
        if(session()->has('customer')){
            $invoices = array_reverse(json_decode(json_encode(session('customer')->invoices,true)));

            return Datatables::of($invoices)
                ->addColumn('action', function($data){
                    $button = '<a href="'. $data->link .
                        '" data-toggle="tooltip" data-original-title="Download" target="_blank" class="download-pdf btn btn-info btn-sm"><i class="fa fa-download pr-1"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            throw new CheckUserException();
        }
    }

    public function check($billetId)
    {
        if(session()->has('customer')){

            if(!$billetId){
                return response()->json(false);
            }

            session()->put('billetId', $billetId);

            $payments = json_decode(json_encode((new API())->getPayments()),true);

//            dd($payments);
            $paymentCustomer = [];
            $billetPay = [];
//            $billets = [];
//
//            foreach($payments as $key => $payment){
//                $paymentCustomer = array_filter($payment, function($v, $k) {
//                    return $v['customer'] == session('customerId') && $v['status'] != 'approved';
//                }, ARRAY_FILTER_USE_BOTH);
//
//                foreach($paymentCustomer as $key => $billet){
//                    $billetPay = array_filter($billet['billets'], function($v2, $k2) {
//                        return $v2['billet_id'];
//                    }, ARRAY_FILTER_USE_BOTH);
//
//                    foreach($billetPay as $key => $billet){
//                        $billets = array_filter($billet, function($v3, $k3) {
//                            return $v3 == session('billetId');
//                        }, ARRAY_FILTER_USE_BOTH);
//                    }
//                }
//            }

            $isBilletPay = [];

            foreach ($payments as $payment) {

//                dd($payment);

                foreach ($payment as $billets) {

//                    dd($billets['billets'], $billetId);
                    foreach ($billets['billets'] as $billet) {
//                        dd($billet, $billetId);
//                        dd($billet['billet_id'], $billetId);
                        $pay = Date("Y-m-d",strtotime($billets['created_at']));
                        $today = Date("Y-m-d");
//                        dd($pay == $today ? true : false, $pay, $today);

                        if (
                            $billet['billet_id'] == $billetId &&
                            $billets['status'] == 'created' &&
                            $pay == $today
                        ) {
                            $isBilletPay[] = $billet;

//                            dd($billets['created_at'], $isBilletPay, $billetId);
                        }
                    }


                }
            }

//            dd($isBilletPay ? true : false);

            return response()->json($isBilletPay ? true : false);

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
}
