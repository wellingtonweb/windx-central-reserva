<?php

namespace App\Http\Controllers;

use App\Helpers\UserInfo;
use App\Http\Requests\CheckMailRequest;
use App\Http\Requests\LogonRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\StoreTerminalRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\CustomerLog;
use App\Services\API;
use App\Services\Functions;
use App\Services\Logger;
use App\Services\Validations;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

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

    public function reset()
    {
        return view('auth.reset');
    }

    public function checkMailCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), ['login' => ['required', 'email:rfc,dns']]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(['error' => $errors->first('login')], 422);
        }else{
            $checkedLogin = (new API)->checkMailCustomer($request->login);

            if($checkedLogin){


                return response()->json([
                    'status' => 200,
                    'message' => "Enviamos um link de redefinição de senha para seu e-mail de cadastro!",
                ]);
            }else{
                return response()->json(['error' => 'Login não cadastrado'], 404);
            }
        }
    }

    public function resetSend(ResetPasswordRequest $request)
    {
//        dd($request->all());

        $validated = $request->validated();

//        $faker = Factory::create();

        $string = '1234@Wdx';
//        $string = Str::random(250);
        $codificada = base64_encode($string);
        echo "Resultado da codificação usando base64: " . $codificada;
        // TyByYXRvIHJldSBhIHJvcGEgZG8gcmVpIGRlIFJvbWE=
        $original = base64_decode($codificada);
        echo "Resultado da decodificação usando base64: " . $original;
        // O rato reu a ropa do rei de Roma

        dd($string, $codificada, $original);


//        if(){
//
//        }

        return redirect()->route('central.login');
    }

    public function logon(LogonRequest $request)
    {

//        Functions::checkApp(getenv('API_URL_VIGO_PROD'));

//        if(!session()->has('customer')){
            $validated = $request->validated();

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

                return redirect()->back()->withInput()->withErrors($validated);
            }
            else
            {
                $response = (new API())->customerLogon($validated);

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
