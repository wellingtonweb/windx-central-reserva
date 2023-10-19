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
            return view('auth.login');
        }
    }

    public function reset(Request $request)
    {
        $tokenUrl = basename(url()->current());

        $response = (new Functions())->checkTokenReset($tokenUrl);

        if(!$response){
            abort(406);
        }

        session()->put('password_reset.token', $tokenUrl);

        //Se token for válido no BD
        return view('auth.reset');
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), ['login' => ['required', 'email:rfc,dns']]);

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

    public function resetSend(ResetPasswordRequest $request)
    {
        if(session()->has('password_reset')){
            $reset_session = session('password_reset');
            $validated = $request->validated();

            if($validated){
                //$string = Str::random(250);
//            dd($reset_session, $request['password']);

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

//                dd('Funcionou');

                    return redirect()->route('central.login')->with('success', 'Senha alterada com sucesso!');

                }

//            dd($request->all(), session('password_reset'), $tokenReset, $validated);
            }
        }else{
            abort(406);
        }
//        return redirect()->route('central.login')->with('error', 'Erro!');
    }

    public function logon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'email:rfc,dns'],
            'password' => ['required','min:8']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(['error' => $errors], 422);
        }else{
            $response = (new API())->customerLogon($validator->validate());

//            return response()->json(['error' => $response->body()], 404);

            if($response == null){
                return response()->json(['null' => 'Não existe cadastro com o login informado!'], 404);
            }

            if($response->successful())
            {
                session()->put('customer', $response->object());

                CustomerLog::create(UserInfo::get_customer_metadata());

                return response()->json(['message' => 'authorized'], 200);

            }
        }
    }

    public function logout()
    {

//        Logger::log(session('customer.login'),'info','Fez o logout.');

        (new Functions())->destroySessions();

        return redirect()->route('central.login');
    }
}
