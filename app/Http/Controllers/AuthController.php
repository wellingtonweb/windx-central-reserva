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
use Carbon\Carbon;

class AuthController extends Controller
{

    public function login()
    {
        if(session()->has('customer')){
            return redirect()->route('central.home');
        }
        else {
            return view('auth.login', [
                // Captcha configuration for example page
                'ExampleCaptcha' => [
                    'UserInputID' => 'CaptchaCode',
                    'ImageWidth' => 250,
                    'ImageHeight' => 50,
                ]
            ]);
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

                if($response == null){
                    return response()->json(['error' => 'Ops, login não cadastrado!'], 404);
                }

                if($response->successful())
                {
                    $customer = json_decode(json_encode($response->object()),true);

                    session()->put('customer',  $customer);

                    CustomerLog::create(UserInfo::get_customer_metadata());

                    return response()->json(200);
                }
            }
        }
    }

    public function logout()
    {

//        Logger::log(session('customer.login'),'info','Fez o logout.');

        (new Functions())->destroySessions();

        return redirect()->route('central.login');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required','bail','email:rfc,dns', new CheckLoginForgotPassword],
            'captcha' => ['required','bail', new Captcha],
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $customer_reset = session('password_reset');
        $token = Str::random(200);

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
        $tokenUrl = basename(url()->current());

        $passwordReset = DB::table('password_resets')
            ->where('token', $tokenUrl)
            ->first();

        if($passwordReset === null)
        {
            return redirect()->route('central.login')->with('error','Token inválido!');
        }

//        if ($passwordReset && now()->diffInMinutes($passwordReset->created_at) > 15)
//        {
//            DB::table('password_resets')
//                ->where('token', $tokenUrl)
//                ->delete();
//
//            session()->forget('password_reset');
//
//            return redirect()->route('central.login')->with('error','Token expirado!');
//        }

        return view('auth.reset');
    }

    public function sendNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required','bail','email:rfc,dns','exists:App\Models\PasswordResets,login'],
            'password' => ['required','bail','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/'],
            'confirm' => ['required','bail','min:8','same:password'],
            'captcha' => ['required', new Captcha],
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $validator->validated();

//
//        $passwordReset = DB::table('password_resets')
//            ->where('login', $data['login'])
//            ->first();
//
//        if($passwordReset === null)
//        {
//            session()->forget('password_reset');
//
//            return redirect()->route('central.login')->with('error','Login inválido!');
//        }

        $reset_session = session('password_reset');

//        dd($data, $reset_session, $request['login']);

        $response = (new API)
            ->updatePasswordCustomer([
                'customer_id' => $reset_session['customer_id'],
                'customer_password' => base64_encode($request['password'])
            ]);

        if($response->failed())
        {
            session()->forget('password_reset');
            return redirect()->route('central.login')->with('error','Não foi possível redefinir a senha!');
        }

//        DB::table('password_resets')
//            ->where('login', $request['login'])
//            ->delete();

//        session()->forget('password_reset');

        $response = (new API())->customerLogon($validator->validate());

        if($response->successful())
        {
            $customer = json_decode(json_encode($response->object()),true);

            session()->put('customer',  $customer);

            CustomerLog::create(UserInfo::get_customer_metadata());

            return response()->json(200);
//            return redirect()->route('central.login')->with('success', 'Senha alterada com sucesso!');
        }

        abort('500');



//        if(session()->has('password_reset')){
//            $reset_session = session('password_reset');

//            if(empty($reset_session['customer_id'])){
//                DB::table('password_resets')
//                    ->where('token', $reset_session['token'])
//                    ->delete();
//
//                abort(406);
//            }
//
//            $validator = Validator::make($request->all(), [
//                'login' => ['required', 'email:rfc,dns'],
//                'password' => ['required','min:8'],
//                'confirm' => ['required','min:8','same:password'],
//                'captcha' => ['required', new Captcha],
//            ]);
//
//            dd($validator->validated());

//            $validated = $request->validated();

//            if(!$validator->fails()){
//                $response = (new API)
//                    ->updatePasswordCustomer([
//                        'customer_id' => $reset_session['customer_id'],
//                        'customer_password' => base64_encode($request['password'])
//                    ]);
//
//                if($response->successful()){
//                    DB::table('password_resets')
//                        ->where('token', $reset_session['token'])
//                        ->delete();
//
//                    $request->session()->forget('password_reset');
//
//                    return redirect()->route('central.login')->with('success', 'Senha alterada com sucesso!');
//
//                }
//            }
//        }else{
//            abort(406);
//        }
    }



}
