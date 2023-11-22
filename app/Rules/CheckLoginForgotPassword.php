<?php

namespace App\Rules;

use App\Services\API;
use Illuminate\Contracts\Validation\Rule;

class CheckLoginForgotPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = (new API())->checkMailCustomer($value);

        if($response != null){
            session()->put('password_reset.customer_id',$response[0]->id);
            session()->put('password_reset.customer_fullname',$response[0]->nome);
            session()->put('password_reset.customer_login',$response[0]->login);
        }

        return $response != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ops, login não cadastrado';
    }
}
