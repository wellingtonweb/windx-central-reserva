<?php


namespace App\Services;


use App\Helpers\UserInfo;
use App\LocalClass\ApiConnect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Ramsey\Uuid\Type\Integer;

class Functions
{

    public function generateToken()
    {
        $token = bcrypt(date('YmdHms'));
        return $token;
    }

    public function destroySessions()
    {
        session()->invalidate();
        session()->regenerate();
        session()->regenerateToken();
    }

    public static function calcFees(String $date, string $val)
    {
        $now = date_create(date('Y-m-d'));
        $dueDate = date_create(date('Y-m-d', strtotime($date)));
        $days = 0;
        $vm = 0;
        $vj = 0;
        if ($now > $dueDate)
        {
            $days = $now->diff($dueDate)->format('%a');
            $vm = (($val * 2) / 100);
            $vj = ((($val * 0.2) / 100) * $days);
//            $result = number_format(floatval($vm + $vj), 2, ',', '');
            $result = $vm + $vj;
//            dd(get_debug_type($result));

            return $result;
        } else {
            return $result = intval(0);
        }
    }



    public static function dateToPt(String $date)
    {
        return date("d/m/Y", strtotime($date));
    }

    public static function dateToPtSlim(String $date)
    {
        return date("d/m/y", strtotime($date));
    }

    public static function dateTimeToPt(String $date)
    {
        return date("d/m/Y H:i", strtotime($date));
    }

//    public function dateBirth(String $date)
//    {
//        return date("d/m/Y", (strtotime('next month',strtotime($date))));
//    }

    public function checkBirth(String $date)
    {
        $birth = Date("m-d",strtotime($date));
        $today = Date("m-d");

        if($birth == $today){
            return true;
        }else {
            return false;
        }
    }

    public function dateToUs(String $date)
    {
        return date("Y-m-d", strtotime($date));
    }

    public function infoDate()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
    }

//    public function findTerminal(String $id)
//    {
//        try
//        {
//            $tokenApi = new ApiConnect();
//
//            $response = Http::withToken($tokenApi->tokenApi())
//                ->get(getenv('API_URL') . '/api/terminals/'. $id);
//
//            $terminal = json_decode($response);
//
//            return $terminal;
//        }
//        catch (\Exception $e)
//        {
//            $msg = [
//                'title' => trans('validation.generic.Error'),
//                'message' => $e->getMessage(),
//                'alert-type' => 'danger'
//            ];
//            return back()->with($msg)->withInput();
//        }
//    }

    public function printStatus($status)
    {
        $status_out = '';

        switch ($status)
        {
            case 'created':
                $status_out = 'Criado';
                break;
            case 'approved':
                $status_out = 'Aprovado';
                break;
            case 'refused':
                $status_out = 'Recusado';
                break;
            case 'canceled':
                $status_out = 'Cancelado';
                break;
        }
        return $status_out;
    }


    public function printPaymentType($payment_type)
    {
        $payment_type_out = '';

        switch ($payment_type)
        {
            case 'credit':
                $payment_type_out = 'Crédito';
                break;
            case 'debit':
                $payment_type_out = 'Débito';
                break;
            case 'pix':
                $payment_type_out = 'Pix';
                break;
            case null:
                $payment_type_out = 'Picpay';
                break;
        }
        return $payment_type_out;
    }

    public function getDataCoupon($data, $method)
    {
        if(empty($data)){
            return null;
        }

//        dd($data);

        $dataCoupon = [];
        $authorization_number = '';

        if($method == "tef"){

            //Dentro do data não tem method!?!?! Favor buscar method em outro lugar!

            $aut_start_cut = strpos($data, "AUT=");
            $aut_end_cut = strpos($data, "\r\n", $aut_start_cut) - $aut_start_cut;


            $flag_start_cut = strpos($data, "Bandeira");
            $flag_end_cut = strpos($data, "@@", $flag_start_cut) - $flag_start_cut;

            if (strpos($data, "AUT=") !== false && preg_match("/AUT=\s+(\d+)/", $data, $matches)) {
                $authorization_number = $matches[1];
            }

            $dataCoupon = [
                'card_number' => null,
                'card_name_customer' => null,
                'authorization_number' => $authorization_number,
                'card_flag' => str_replace("Bandeira", "", substr($data, $flag_start_cut, $flag_end_cut)),
            ];

        }else{

            $card_start_cut = strpos($data, "************");
            $card_end_cut = strpos($data, "AUTORIZACAO", $card_start_cut) - $card_start_cut;

            $name_start_cut = strpos($data, "NomeCartao");
            $name_end_cut = strpos($data, "@", $name_start_cut) - $name_start_cut;

            $flag_start_cut = strpos($data, "Bandeira");
            $flag_end_cut = strpos($data, "@@", $flag_start_cut) - $flag_start_cut;

            if (strpos($data, "AUTORIZACAO: ") !== false && preg_match("/AUTORIZACAO:\s+(\d+)/", $data, $matches)) {
                $authorization_number = $matches[1];
            }

            $dataCoupon = [
                'card_number' => substr($data, $card_start_cut, $card_end_cut),
                'card_name_customer' => str_replace("NomeCartao", "", substr($data, $name_start_cut, $name_end_cut)),
                'authorization_number' => $authorization_number,
                'card_flag' => str_replace("Bandeira", "", substr($data, $flag_start_cut, $flag_end_cut)),
            ];

        }

        return json_encode($dataCoupon);
    }

//    public function getDataCard($data)
//    {
//        if(empty($data)){
//            return null;
//        }
//
//        $start_cut = strpos($data, "************");
//        $end_cut = strpos($data, "AUTORIZACAO", $start_cut) - $start_cut;
//
//        return substr($data, $start_cut, $end_cut);
//    }
//
//    public function getNameCustomerCard($data)
//    {
//        if(empty($data)){
//            return null;
//        }
//
//        $start_cut = strpos($data, "NomeCartao");
//        $end_cut = strpos($data, "@", $start_cut) - $start_cut;
//
//        return str_replace("NomeCartao", "", substr($data, $start_cut, $end_cut));
//    }
//
//    public function getDataAutorizationPayment($data)
//    {
////        $start_cut = strpos($data, "AUTORIZACAO: ");
////        $end_cut = strpos($data, "TRANSACAO", $start_cut) - $start_cut;
////
////        return str_replace("AUTORIZACAO: ", "", substr($data, $start_cut, $end_cut));
//
//        if(empty($data)){
//            return null;
//        }
//
//        if (strpos($data, "AUTORIZACAO: ") !== false && preg_match("/AUTORIZACAO:\s+(\d+)/", $data, $matches)) {
//            // Usa a expressão regular para extrair o número de autorização
//            $authorization_number = $matches[1];
//
//            return $authorization_number;
//        }
//    }

    public function arrayCoupon($data)
    {
        if(empty($data)){
            return null;
        }

        return explode("\n", $data->receipt);
    }

    public function barcode($codeLine)
    {
//        $generator = new BarcodeGeneratorHTML();
//        echo $generator->getBarcode($codeLine, $generator::TYPE_INTERLEAVED_2_5,2, 45);

        $generator = new BarcodeGeneratorPNG();
        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($codeLine, $generator::TYPE_INTERLEAVED_2_5)) . '">';
    }

    /* milon / barcode */
    public function barcode2($codeLine)
    {
        echo DNS1D::getBarcodeSVG($codeLine, 'I25', 1, 35,'black', false);
//        echo '<img width="420px" height="45px" src="data:image/png;base64,' . DNS1D::getBarcodePNG($codeLine, 'I25', 1) . '" alt="barcode"   />';
    }

    public function formatDocument($document)
    {
        if($document.lenght > 11) {
            return printf('%d%d.%d%d%d.%d%d%d/%d%d%d-%d%d', str_split($document));
        }else{
            return printf('%d%d%d.%d%d%d.%d%d%d-%d%d', str_split($document));
        }
    }

    public function getBeneficiary($idBeneficiary){
        $beneficiary = '';

        switch ($idBeneficiary)
        {
            case 1:
                $beneficiary = [
                    'cnpj' => '01.771.952/0001-71',
                    'razao' => 'PENHA DE SOUZA JAMARIQUELI EPP',
                    'fantasia' => 'WINDX TELECOMUNICAÇÕES',
                    'cidade' => 'MARATAÍZES'
                ];
                break;
            case 3:
                $beneficiary = [
                    'cnpj' => '01.771.952/0001-71',
                    'razao' => 'PENHA DE SOUZA JAMARIQUELI EPP',
                    'fantasia' => 'WINDX / SÃO FRANCISCO',
                    'cidade' => 'MARATAÍZES'
                ];
                break;
            case 4:
                $beneficiary = [
                    'cnpj' => '01.771.952/0001-71',
                    'razao' => 'PENHA DE SOUZA JAMARIQUELI EPP',
                    'fantasia' => 'LINET INTERNET',
                    'cidade' => 'ITAPEMIRIM'
                ];
                break;
            case 5:
                $beneficiary = [
                    'cnpj' => '10.528.742/0001-48',
                    'razao' => 'J. DE S. JAMARIQUELI COM. E SERVIÇOS DE COMUNICAÇÃO E TELECOMUNICAÇÃO ME',
                    'fantasia' => 'WDX TELECOMUNICAÇÕES',
                    'cidade' => 'ITAPEMIRIM'
                ];
                break;
            default:
                $beneficiary = [
                    'cnpj' => '44.053.846/0001-65',
                    'razao' => 'ANTONIO CARLOS DE SOUZA JAMARIQUELI',
                    'fantasia' => 'A C JAMARIQUELI SERV. DE COMUNICACAO E TELECOMUNICACAO',
                    'cidade' => 'MUQUI'
                ];
                break;
        }
        return $beneficiary;
    }

    public function getCustomerOrigin()
    {
        return  [
            'ip' => UserInfo::get_ip(),
            'os' => UserInfo::get_os(),
            'browser' => UserInfo::get_browser(),
            'device' => UserInfo::get_device(),
        ];

    }

    public function orderByDue(array $dados): array
    {
        usort($dados, function($a, $b) {
            return strtotime($a['Vencimento']) - strtotime($b['Vencimento']);
        });

        return $dados;
    }

    public static function checkApp($url)
    {
        $status = false;

        $status = @file_get_contents($url);

        if($status == false){
            abort(500);
        }

        return $status;
    }

    public function generateTokenUrl($customerLogin)
    {
        $token = Str::random(200) . '-' . base64_encode($customerLogin);
//        $url = env('app_base_url') . "nova-senha/" . Str::random($length) . '-' . base64_encode($customerLogin);

        return $token;
//        return $url;
    }

    public function checkTokenReset($tokenUrl)
    {
        $login = base64_decode(explode('-',$tokenUrl)[1]);

        $validatedToken = DB::table('password_resets')
            ->where('token', $tokenUrl)
            ->exists();

        //Se existir e a hora for maior que 60 min, será excluido
//        DB::table('password_resets')
//            ->where('token', $tokenUrl)
//            ->delete();

        if($validatedToken){
            return true;
        }

        return false;
    }
}
