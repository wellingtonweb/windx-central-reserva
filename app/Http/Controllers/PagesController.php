<?php

namespace App\Http\Controllers;

use App\Exceptions\CheckUserException;
use App\Helpers\UserInfo;
use App\Http\Requests\CallRequest;
use App\Http\Requests\CentralLogonRequest;
use App\Models\CustomerLog;
use App\Services\ApiConnect;
use App\Services\API;
use App\Helpers\WorkingDays;
use App\Services\Functions;
use App\Services\Made4Graph;
use App\Services\Validations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Resources\Json\JsonResource;

class PagesController extends Controller
{

    public function __construct()
    {
        $array = explode(",", env('BACKUP_VIGO_SCHEDULES'));

        $hourBackup = (new Validations())->checkHourBackupVigo($array);

//        if ($hourBackup) return abort(423);
    }

    public function home()
    {
        if(session()->has('customer'))
        {


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

    public function graphics()
    {
        if(session()->has('customer')){
            return view('graphics', [
                'header' => 'Gráficos',
                'customer' => session('customer')
            ]);
        } else {
            throw new CheckUserException();
        }
    }

    public function trafficAverage(Request $request)
    {
        if(session()->has('customer')){

            $dtStart = (new Functions())->convertDate($request->dtStart);
            $dtEnd = (new Functions())->convertDate($request->dtEnd);

            $response = (new Made4Graph())->trafficAverage(['dtStart' => $dtStart, 'dtEnd' => $dtEnd ]);

            return response()->json($response);
//            return view('graphics', [
//                'header' => 'Consumo',
//                'customer' => session('customer')
//            ]);
        } else {
            throw new CheckUserException();
        }
    }

    public function connection()
    {
        if(session()->has('customer')){
            return view('connection', [
                'header' => 'Minha conexão',
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

            if($response === 'OK'){
                if ($request->session()->has('customer')) {
                    session()->put('customer.status',  'L');
                }
            }

            return response()->json($response);
        } else {
            throw new CheckUserException();
        }
    }

    public function payment()
    {
        if(session()->has('customer'))
        {
            return view('payment', [
                'header' => 'Pagamento (Checkout)',
                'authorization' => (new API())->getTokenTreeDS(session('customer.company_id'))->access_token,
                ]);
        } else {
            throw new CheckUserException();
        }
    }

    public function getbillets()
    {
        if(session()->has('customer')){
//            $customer = json_decode(json_encode((new API())->getCustomer(9)),true);
            $customer = json_decode(json_encode((new API())->getCustomer(session('customer.id'))),true);

            return Datatables::of($customer[0]['billets'])
                ->addColumn('dtEmissao', function($data){
                    return date("d/m/Y", strtotime($data['Vencimento']));
                })
                ->addColumn('valor', function($data){
                    return 'R$ ' . number_format($data['Valor'], 2, ',', '');
                })
                ->addColumn('fees', function($data){
                    return 'R$ ' . number_format((new Functions)->calcFees($data['Vencimento'], $data['Valor']), 2, ',', '');
                })
                ->addColumn('total', function($data){
                    return 'R$ ' .number_format((new Functions)->calcFees($data['Vencimento'], $data['Valor']) + $data['Valor'], 2, ',', '');
                })
                ->addColumn('copy', function($data){
                    return '<a href="#" id="copy-barcode-'. $data['Id'] .'" class="d-block billet-link btn-copy text-primary click px-2" data-id="'.
                        $data['Id'] .'" onclick="copyBarcode3(this)" data-code="'. $data['LinhaDigitavel'] .'"><i class="fas fa-copy pl-1"></i>'.
                                    '<small class="text-primary" style="font-size: .7rem">copiar</small></a>';
                })
                ->addColumn('download', function($data){
                    return '<a target="_blank" id="print-billet-'. $data['Id'] .'" href="'. env('API_URL_VIGO_PROD') . $data['Link'] .
                        '" class="billet-link btn-print-billet text-primary px-3"><i class="fas fa-download pr-1"></i>Baixar segunda via</a>';
                })
                ->addColumn('remove', function($data){
                    return '<a href="#" id="remove-billet-'. $data['Id'] .
                        '" class="btn btn-danger btn-sm btn-block delete-item d-none"
                        onclick="deleteItemCart('. $data['Id'] .')">REMOVER</a>';
                })
                ->addColumn('add', function($data){
                    $price = 0;
                    $addition = 0;
                    $fees = 0;
                    $today = Carbon::now()->startOfDay();
                    $pay = Carbon::parse($data['Vencimento']);

                    if($today > $pay)
                    {
                        $hasFees = (new WorkingDays)->hasFees($data['Vencimento']);

                        if($hasFees){
                            $fees = 0;
                        }else{
                            $fees = (new Functions)->calcFees($data['Vencimento'], $data['Valor']);
                        }

                        $price = number_format((float)($fees + $data['Valor']), 2, '.', ',');
                        $addition = number_format((float)($fees), 2, '.', '');
                    }
                    else
                    {
                        $price = number_format((float)($data['Valor']), 2, '.', ',');;
                        $addition = number_format((float)(0), 2, '.', '');
                    }

                    $billet = json_encode([
                        'id' => $data['Id'],
                        'reference' => $data['NossoNumero'],
                        'value' => $data['Valor'],
                        'duedate' => $data['Vencimento'],
//                        'duedate' => date("d/m/Y", strtotime($data['Vencimento'])),
                        'price' => $price,
                        'discount' => 0,
                        'addition' => $addition,
                        'installment' => preg_match("/acordo/i", $data['Referencia']) ? (int) preg_replace('/[^0-9]/', '', $data['Referencia']) : 1,
                        'company_id' => session('customer.company_id')
                    ]);

                    $button = '<a href="#" id="select-billet-'. $data['Id'] .
                        '" class="add-to-cart btn btn-success btn-sm btn-block" onclick="addToCartBtn('. htmlspecialchars(json_encode($billet)) .')">PAGAR</button>';

                    return $button;
                })
                ->rawColumns(['add', 'copy', 'download', 'remove'])
                ->addIndexColumn()
                ->make(true);
        } else {
            throw new CheckUserException();
        }
    }

    public function getbillets2(){
        if(session()->has('customer')){
            $customer = json_decode(json_encode((new API())->getCustomer(session('customer.id'))),true);
            return $customer[0]['billets'];
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

    public function debit()
    {
        if(session()->has('customer')){
            return view('debit', ['header' => 'Débito']);
        } else {
            throw new CheckUserException();
        }
    }

    public function tokencielo()
    {
//        if(session()->has('customer')){
            return view('tkcielo', ['header' => 'tkcielo']);
//            return view('tokencielo', ['header' => 'tokencielo']);
//        } else {
//            throw new CheckUserException();
//        }
    }

    public function coupons()
    {
        if(session()->has('customer')){
            $payments = json_decode(json_encode((new API())->getPayments()),true);
            $paymentCustomer = [];

            foreach($payments as $key => $payment){

                $paymentCustomer = array_filter($payment, function($v, $k) {
                    return $v['customer'] == session('customer.id') && $v['status'] == 'approved';
//                    return $v['customer'] == session('customer')->id && $v['terminal_id'] == null && $v['method'] == 'ecommerce' && $v['status'] == 'approved';
                }, ARRAY_FILTER_USE_BOTH);
            }



            return Datatables::of($paymentCustomer)
                ->addColumn('action', function($data){
//                    if($data['status'] === 'approved'){
//                        $compactData = json_encode($data);
//                          $button = "<a href=\"#\" class=\"download-pdf_ badge badge-pill badge-primary px-3 py-2\"><i class=\"fas fa-receipt pr-1\"></i>VISUALIZAR</a>";
//
////                        $button = '<a href="'. route('central.coupon.pdf', ['id' => $data['id'] ]) .
////                            '" data-toggle="tooltip" onclick="downloadClick()" data-original-title="Download" class="download-pdf badge badge-pill badge-primary px-3 py-2"><i class="fa fa-download pr-1"></i>BAIXAR</a>';
//                    }else{
//                        $button = '---';
//                    }
                    return '-';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true)
                ;
        } else {
            throw new CheckUserException();
        }
    }

    public function invoices()
    {
        if(session()->has('customer'))
        {
            return view('invoices', ['header' => 'Notas fiscais']);
        } else {
            throw new CheckUserException();
        }
    }

    public function invoicesList()
    {
        if(session()->has('customer')){
            $invoices = array_reverse(json_decode(json_encode(session('customer.invoices'),true)));
//            $invoices = null;

            return Datatables::of($invoices)
                ->addColumn('action', function($data){
                    $button = '<a href="'. $data->link .
                        '" data-toggle="tooltip" data-original-title="Download" target="_blank" class="download-pdf badge badge-pill badge-primary my-1 px-3 py-2"><i class="fa fa-download pr-1"></i>BAIXAR</a>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            throw new CheckUserException();
        }
    }

    public function support()
    {
        if(session()->has('customer'))
        {
            return view('support', [
                'header' => 'Suporte',
            ]);
        } else {
            throw new CheckUserException();
        }
    }

    public function supportList()
    {
        if(session()->has('customer')){
            $calls = (new API())->getCalls(session('customer.id'));

            //class="download-pdf badge badge-pill badge-primary my-1 px-3 py-2"><i class="fa fa-download pr-1"></i>BAIXAR</a>
            return Datatables::of($calls)
                ->addColumn('action', function($data){
                    $button = "<a href='#' onclick='getData(this)' data-call='".json_encode($data).
                        "' data-toggle='tooltip' data-original-title='Download' class='call-viewer badge badge-pill badge-primary my-1 px-3 py-2'><i class='fa fa-info pr-1'></i>Visualizar</a>";
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        } else {
            throw new CheckUserException();
        }
    }

    public function supportNew(CallRequest $request)
    {
        $validated = $request->validated();

        if(!$validated)
        {
            return response()->json([
                'success'=>false,
                'errors'=>($validated->getMessageBag()->toArray()),
            ],400);
        }

        $call = (new API())
            ->postCall([
                'customer_id' => session('customer.id'),
                'texto' => $validated['texto']
            ]);

        return response()->json([
            'success'=>true,
        ],200);

    }

    public function check($billetId)
    {
        if(session()->has('customer')){

            if(!$billetId){
                return response()->json(false);
            }

            session()->put('billetId', $billetId);

            $payments = json_decode(json_encode((new API())->getPayments()),true);

            $isBilletPay = [];

            foreach ($payments as $payment) {
                foreach ($payment as $billets) {
                    foreach ($billets['billets'] as $billet) {
                        $pay = Date("Y-m-d",strtotime($billets['created_at']));
                        $today = Date("Y-m-d");

                        if (
                            $billet['billet_id'] == $billetId &&
                            $billets['status'] == 'created' &&
                            $pay == $today
                        ) {
                            $isBilletPay[] = $billet;
                        }
                    }
                }
            }

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
