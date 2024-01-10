<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\AppLog;

class Made4Graph
{

    private $apiUrl;
    private $apiLogin;
    private $apiPassword;
    private $apiToken;
    private $login_pppoe;

    public function __construct()
    {
        $this->apiUrl = getenv('API_MADE4GRAPH_URL');
        $this->apiLogin = getenv('API_MADE4GRAPH_LOGIN');
        $this->apiPassword = getenv('API_MADE4GRAPH_PASSWORD');
        $this->apiToken = $this->tokenApi();
        $this->login_pppoe = "097wdf";
//        $this->login_pppoe = session('customer.login');

    }

    public function tokenApi()
    {
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->post( $this->apiUrl . '/api/v1/login.php', [
                'email' => $this->apiLogin,
                'password' => $this->apiPassword
            ]);

//        dd($response->object()->message->token, session('customer.login'));

        if($response->successful()){
            return $response->object()->message->token;
        }else{
            return $response->throw();
//            throw new ApiConnectException();
        }
    }

    public function trafficAverage($period)
    {
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->post($this->apiUrl . '/api/v1/trafficAverage.php',
                [
                    'login' => [$this->login_pppoe],
                    'dateFrom' => "2024-01-01 00:00:00",
                    'dateTo' => "2024-01-09 23:59:00",
                    '11.201/2020' => true,
                ]);


        if($response->successful()){
            return ['obj'=> $response->object()->message, 'token' => $this->apiToken];
        }else{
            return $response->throw();
        }

    }

    public function trafficRealTime()
    {
        $response = Http::accept('application/json')
            ->retry(3, 100)
            ->withToken($this->apiToken)
            ->post($this->apiUrl . '/api/v1/trafficRealTime.php',
                [
                    "login" => $this->login_pppoe,
                ]);


        if($response->successful()){
            return ['obj'=> $response->object(), 'token' => $this->apiToken];
        }else{
            return $response->throw();
        }
    }


}
