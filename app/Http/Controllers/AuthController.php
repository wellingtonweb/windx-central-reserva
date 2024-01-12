<?php

namespace App\Http\Controllers;

use App\Helpers\UserInfo;
use App\Http\Requests\CheckMailRequest;
use App\Http\Requests\LogonRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreTerminalRequest;
use App\Http\Requests\CheckoutRequest;
use App\Jobs\SendMailResetPasswordJob;
use App\Mail\SendMailResetPassword;
use App\Models\CustomerLog;
use App\Services\API;
use App\Services\Functions;
use App\Services\Logger;
use App\Services\Validations;
use Faker\Factory;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\Models\PasswordResets;
use App\Rules\Captcha;
use App\Rules\CheckLoginForgotPassword;
use App\Rules\CheckFormatLogin;
use App\Rules\CheckTokenPasswordReset;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function __construct()
    {
        $array = explode(",", env('BACKUP_VIGO_SCHEDULES'));

        $hourBackup = Validations::checkHourBackupVigo($array);

//        if ($hourBackup) return abort(423);
    }

    public function login()
    {
        if(session()->has('customer'))
        {
            return redirect()->route('central.home');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function logon(Request $request)
    {
//        if($request->all())

//        dd($request);

        $validator = Validator::make($request->all(), [
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }
        else
        {
            $response = (new API())->customerLogon($validator->validate());

            if($response->object() == "ERRO"){
                return response()->json(['error' => 'Login ou senha inválidos!'], 404);
            }

            if($response->status() == 500){
                return response()->json(['error' => 'Dados inválidos!'], 500);
            }

            $customer = json_decode(json_encode($response->object()),true);

            session()->put('customer',  $customer);
            session()->put('customer.login',  $validator->validate()['login']);
            UserInfo::get_customer_metadata();

//            dd(session('customer'));



//            session()->put('customer.ip_address', \Request::getClientIp(true));

//            CustomerLog::create(UserInfo::get_customer_metadata());

            return response()->json(200);
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('central.login');
    }

}
