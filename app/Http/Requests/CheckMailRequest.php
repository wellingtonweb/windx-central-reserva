<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Validation\Validator;

class CheckMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => ['required', 'email:rfc,dns'],
        ];
    }

//    public function failedValidation(Validator $validator)
//    {
//        throw new \HttpResponseException(response()->json([
//            'status' => 422,
//            'message' => 'E-mail inválido!',
//            'errors' => $validator->errors()
//        ]));
//    }

//    public function messages()
//    {
//        return [
//            'login.required' => 'O e-mail de cadastro é necessário para prosseguir.',
//            'login.email' => 'O login precisa ser um e-mail válido.',
//            'login.email:rfc' => 'O e-mail de cadastro é inválido 01.',
//            'login.email:dns' => 'O e-mail de cadastro é inválido 02.',
//        ];
//    }
}
