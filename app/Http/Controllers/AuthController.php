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
                'login' => ['required', 'email:rfc,dns'],
                'password' => ['required','min:8'],
                'captcha' => ['required','captcha'],
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
            'login' => ['required', 'email:rfc,dns'],
            'captcha' => ['required','captcha'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(['error' => $errors->first('login')], 422);
        }else{
            $customer = (new API)->checkMailCustomer($request->login);

            if($customer != null){
                //Gerar o token + login do cliente
                $token = (new Functions())->generateTokenUrl($customer[0]->login);

                $request->session()->put('password_reset.customer_id', $customer[0]->id);

                //Gravar no banco de dados o token e o login do cliente
                DB::table('password_resets')->insert([
                    'email' => $customer[0]->login,
                    'token' => $token,
                    'created_at' => date("Y-m-d H:i:s")
                ]);

                $customerData = [
                    'customer_id' => $customer[0]->id,
                    'customer_name' => $customer[0]->nome,
                    'customer_login' => $customer[0]->login,
                    'url' => env('app_base_url') . "nova-senha/" . $token
                ];

                //Fazer o disparo do e-mail com o link de recuperação
                SendMailResetPasswordJob::dispatch($customerData);

                return response()->json([
                    'status' => 200,
                    'message' => "Enviamos um link de redefinição de senha para seu e-mail de cadastro!",
                ], 200);
            }else{
                return response()->json([
                    'error' => "Login não cadastrado!",
                    'message' => "Solicite seu cadastro em nossa Central de Atendimento.",
                ], 404);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        if(session()->has('password_reset')){
            $reset_session = session('password_reset');

            if(empty($reset_session['customer_id'])){
                DB::table('password_resets')
                    ->where('token', $reset_session['token'])
                    ->delete();

                abort(406);
            }

            $validator = Validator::make($request->all(), [
                'login' => ['required', 'email:rfc,dns'],
                'password' => ['required','min:8'],
                'confirm' => ['required','min:8','same:password'],
                'captcha' => ['required','captcha'],
            ]);

//            dd($validator->validated());

//            $validated = $request->validated();

            if(!$validator->fails()){
                $response = (new API)
                    ->updatePasswordCustomer([
                        'customer_id' => $reset_session['customer_id'],
                        'customer_password' => base64_encode($request['password'])
                    ]);

                if($response->successful()){
                    DB::table('password_resets')
                        ->where('token', $reset_session['token'])
                        ->delete();

                    $request->session()->forget('password_reset');

                    return redirect()->route('central.login')->with('success', 'Senha alterada com sucesso!');

                }
            }
        }else{
            abort(406);
        }
    }

    public function newPassword(Request $request)
    {

//        dd($request->all());

        $tokenUrl = basename(url()->current());

//        dd($tokenUrl);

//        $response = (new Functions())->checkTokenReset($tokenUrl);

        $validatedToken = DB::table('password_resets')
            ->where('token', $tokenUrl)
            ->exists();

        if(!$validatedToken){
            DB::table('password_resets')
                ->where('token', $tokenUrl)
                ->delete();

            abort(406);
        }

        session()->put('password_reset.token', $tokenUrl);

//        DB::table('password_resets')
//            ->where('token', $tokenUrl)
//            ->delete();

        //Se token for válido no BD
        return view('auth.reset');
    }

}
