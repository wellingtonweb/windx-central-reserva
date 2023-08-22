<?php

namespace App\Http\Controllers;

use App\Helpers\UserInfo;
use App\Http\Requests\LogonRequest;
use App\Http\Requests\StoreTerminalRequest;
use App\Http\Requests\CheckoutRequest;
use App\Models\CustomerLog;
use App\Services\API;
use App\Services\Functions;
use App\Services\Logger;
use App\Services\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function login()
    {
//        $terminal_validate = Validations::validateTerminal();
//
//        if($terminal_validate == false){
//            return redirect()->route('terminal.locked')->with('error', 'Terminal bloqueado!');
//        }
//
//        if(session()->has('customer')){
//
//            return redirect()->route('terminal.contracts');
//        }
//        else {
            return view('login');
//        }

    }

    public function login2()
    {
        return view('login2');
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
