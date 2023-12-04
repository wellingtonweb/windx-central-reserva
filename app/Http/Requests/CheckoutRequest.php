<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class CheckoutRequest extends FormRequest
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

            'bandeira' =>           ['required_if:payment_type,credit,debit'],
            'billets' =>            ['required'],
//            'card_number' =>        ['required_if:payment_type,credit,debit'],
//            'expiration_year' =>    ['required_if:payment_type,credit,debit'],
//            'expiration_month' =>   ['required_if:payment_type,credit,debit'],
//            'cvv' =>                ['required_if:payment_type,credit,debit'],
            'card_number' =>        ['required_if:payment_type,credit,debit',
                $this->get('card_number') != null ? new CardNumber : ''],
            'expiration_year' =>    ['required_if:payment_type,credit,debit',
                $this->get('expiration_year') != null ? new CardExpirationYear($this->get('expiration_month')) : '' ],
            'expiration_month' =>   ['required_if:payment_type,credit,debit',
                $this->get('expiration_month') != null ?  new CardExpirationMonth($this->get('expiration_year')) : ''],
            'cvv' =>                ['required_if:payment_type,credit,debit',
                $this->get('cvv') != null ? new CardCvc($this->get('card_number')) : ''],
            'customer' =>           ['required'],
            'holder_name' =>        ['required_if:payment_type,credit,debit'],
//            'ip_address' =>         ['required_if:payment_type,credit,debit'],
            'method' =>             ['required'],
            'payment_type' =>       ['required_if:method,ecommerce,tef'],
            'full_name' =>          ['required_if:method,picpay','string'],
            'email' =>              ['required_if:method,picpay','string'],
            'cpf_cnpj' =>           ['required_if:method,picpay','required_if:payment_type,pix'],
//            'cpf_cnpj_type' =>      ['required_if:payment_type,pix','string'],
            'phone' =>              ['required_if:method,picpay','string'],
            'installment' =>        ['required'],
//            'terminal_id' =>        ['required_if:method,tef'],
//            'reference' =>          ['required_if:method,tef'],
        ];
    }
//
    public function messages()
    {
        return [
            'holder_name.required' => 'O nome do titular do cartão é obrigatório',
            'card_number.required' => 'O número do cartão é obrigatório',
            'expiration_year.required' => 'O ano do vencimento é obrigatório',
            'expiration_month.required' => 'O mês do vencimento é obrigatório',
            'cvv.required' => 'O dígito verificador é obrigatório',
            'bandeira.required' => 'A bandeira do cartão é obrigatória',
            'validation.credit_card.card_expiration_month_invalid' => 'Mês expirado'
        ];
    }
}
