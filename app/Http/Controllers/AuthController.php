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


            //Gravar no banco de dados o token e o login do cliente


//            $url = (new Functions())->generateTokenUrl("sup.windx@gmail.com", 250);
//
//
//            dd($url, base64_decode('c3VwLndpbmR4QGdtYWlsLmNvbQ=='));

//            $login = "sup.windx@gmail.com";
//
//            $checkedLogin = (new API)->checkMailCustomer($login);
//
//            dd($checkedLogin[0]->id);

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

    public function checkMailCustomer(Request $request)
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
                ]);
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

            if($response){
//                DB::table('password_resets')
//                    ->where('token', $reset_session['token'])
//                    ->delete();
//
//                $request->session()->forget('password_reset');

//                dd('Funcionou');

                return redirect()->route('central.login')->with('success', 'Senha alterada com sucesso!');

            }

//            dd($request->all(), session('password_reset'), $tokenReset, $validated);
        }

        return redirect()->route('central.login')->with('error', 'Deu erro!');
    }

    public function logon(LogonRequest $request)
    {

//        Functions::checkApp(getenv('API_URL_VIGO_PROD'));

//        if(!session()->has('customer')){
            $validated = $request->validated();

        dd($validated->fails());
        if(!$validated){
            dd($validated);
        }


//            dd($validated['document']);

//        if ($validated['document'] != '097.781.357-62')
//        {
////            Logger::log($request->login,'error','Documento não autorizado!');
//
//            Log::alert("Erro - Documento não autorizado : {$request->login}");
//
//            return redirect()->back()->withInput()->with('error','Documento não autorizado!');
//        }

            if (!$validated)
            {
                Logger::log($request->login,'error','Login inválido!');

                dd($validated);

                return redirect()->back()->withInput()->withErrors($validated);
            }
            else
            {
                $response = (new API())->customerLogon($validated);

                dd($response);

                if($response->object() == false){
                    return redirect()->back()->withInput()->with('error', 'Não existe cadastro com o documento informado!');
                }

                if($response->ok())
                {

                    session()->put('customer', $response->object());

                    CustomerLog::create(UserInfo::get_customer_metadata());

                    return redirect()->route('central.home');
//                    return redirect('/assinante/contrato/' . $response->object()->id);

                }
                else
                {
//                    Logger::log($request->login,'error','Login ou senha inválidos.');

                    return redirect()->back()->withInput()->with('error', 'Documento inválido!');
//                    return response()->json([
//                        'status' => 'error',
//                        'error' => 'Não foi possível fazer logon!',
//                    ], 400);
                }
            }


//        }else{
//            redirect()->route('terminal.home');
//        }
    }

    public function logout()
    {

//        Logger::log(session('customer.login'),'info','Fez o logout.');

        (new Functions())->destroySessions();

        return redirect()->route('central.login');
    }
}
