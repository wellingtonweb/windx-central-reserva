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
use App\Rules\CheckTokenPasswordReset;
use Carbon\Carbon;

class AuthController2 extends Controller
{

    public function login()
    {
        if(session()->has('customer'))
        {
            return redirect()->route('central.home');
        }
        else {
//            $response = (new API())->customerLogon([
//                "login" => "mailtest@windx.com.br",
//                "password" => "W1ndX@2835322309$",
//                "captcha" => "Hxb7"
//            ]);
//
//            $status = "Vazio";
//            if($response->object() != "ERRO"){
//                $status = "OK";
//            }else{
//                $status = $response->object();
//            }

//            $response = (new API())->checkMailCustomer('mailtest@windx.com.br');
//
//            if(count($response) != 0){
//                dd($response);
//            }else{
//                dd('Não encontrado!');
//            }


            return view('auth2.login');
        }
    }

    public function logon(Request $request)
    {
        $array = explode(",", env('BACKUP_VIGO_SCHEDULES'));

        $hourBackup = Validations::checkHourBackupVigo($array);
        if ($hourBackup) {
//            return abort(423);
            return response()
                ->json(['error' =>
                    [
                        "code" => 423,
                        "title" => "Servidor em manutenção!",
                        "message" => "Previsão de retorno: ".
                            session('backupLimitTime')['timeLimit']
                    ]
                ], 423);
        }else{
            $validator = Validator::make($request->all(), [
                'login' => ['required', 'email:rfc,dns', new CheckLoginForgotPassword],
                'password' => ['required','min:8'],
                'captcha' => ['required', new Captcha],
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

                $customer = json_decode(json_encode($response->object()),true);

                session()->put('customer',  $customer);

//                dd(session('customer'));

                CustomerLog::create(UserInfo::get_customer_metadata());

                return response()->json(200);
            }
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('central.login');
    }

    public function forgotPassword()
    {
        if(session()->has('customer')){
            return redirect()->route('central.home');
        }
        else {
            $customerData = [
                'customer_id' => 123,
                'customer_name' => 'Wellington',
                'customer_login' => '123wdf',
                'url' => env('app_base_url') . "nova-senha/" . '12344asdas'
            ];

            SendMailResetPasswordJob::dispatch($customerData);
            dd('ok');

            if(session()->has('password_reset')){
                session()->forget('password_reset');
            }

            return view('auth2.forgot');
        }
    }

    public function mailForgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'login' => ['required','bail','email:rfc,dns'],
            'login' => ['required','bail','email:rfc,dns', new CheckLoginForgotPassword],
            'captcha' => ['required','bail', new Captcha],
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $customer_reset = session('password_reset');
        $token = Str::random(200);

//        session()->put('password_reset.token',$token);

        DB::table('password_resets')->insert([
            'login' => $customer_reset['customer_login'],
            'token' => $token,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $customerData = [
            'customer_id' => $customer_reset['customer_id'],
            'customer_name' => $customer_reset['customer_fullname'],
            'customer_login' => $customer_reset['customer_login'],
            'url' => env('app_base_url') . "nova-senha/" . $token
        ];

        SendMailResetPasswordJob::dispatch($customerData);

//        session()->forget('password_reset');

        return response()->json([
            'status' => 200,
            'message' => "Enviamos um link de redefinição de senha para seu e-mail de cadastro!",
        ], 200);

    }

    public function newPassword()
    {
        $reset_session = session('password_reset');

//        dd($reset_session);


        $tokenUrl = basename(url()->current());

        $passwordReset = DB::table('password_resets')
            ->where('token', $tokenUrl)
            ->first();

        if($passwordReset === null)
        {
            return redirect()->route('central.login')->with('error','Token inválido!');
        }

        if ($passwordReset && now()->diffInMinutes($passwordReset->created_at) > 15)
        {
            DB::table('password_resets')
                ->where('token', $tokenUrl)
                ->delete();

//            session()->forget('password_reset');

            return redirect()->route('central.login')->with('error','Token expirado!');
        }

        session()->put('password_reset.token',$tokenUrl);

//        dd(session('password_reset'));

        return view('auth2.reset');
    }

    public function sendNewPassword(Request $request)
    {
        $reset_session = session('password_reset');

//        dd($reset_session);

        $validator = Validator::make($request->all(), [
            'login' => ['required','bail','email:rfc,dns', new CheckTokenPasswordReset],
//            'login' => ['required','bail','email:rfc,dns','exists:App\Models\PasswordResets,login'],
            'password' => ['required','bail','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/'],
            'confirm' => ['required','bail','min:8','same:password'],
            'captcha' => ['required', new Captcha],
        ]);



        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $validator->validated();

//        dd($data);

//
        $passwordReset = DB::table('password_resets')
            ->where('login', $data['login'])
            ->first();

        if($passwordReset === null)
        {
            session()->forget('password_reset');

            return redirect()->route('central.login')->with('error','Login inválido!');
        }

//                dd($reset_session);

        $response = (new API)
            ->updatePasswordCustomer([
                'customer_id' => $reset_session['customer_id'],
                'customer_password' => base64_encode($request['password'])
            ]);

        if(!$response)
        {
            session()->forget('password_reset');

            return response()->json(['error' => 'Não foi possível redefinir a senha!'], 400);
//            return redirect()->route('central.login')->with('error','');
        }else{
            //        dd($validator->validate());

            $response = (new API())->customerLogon($validator->validate());

//            dd($response->object());

            if($response->object() == "ERRO"){
                return response()->json(['error' => 'Login ou senha inválidos!'], 404);
            }

            $customer = json_decode(json_encode($response->object()),true);

            session()->put('customer',  $customer);

            DB::table('password_resets')
                ->where('login', $request['login'])
                ->delete();

            session()->forget('password_reset');

//            CustomerLog::create(UserInfo::get_customer_metadata());

            return response()->json(200);
        }

    }



}
