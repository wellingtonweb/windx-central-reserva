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
