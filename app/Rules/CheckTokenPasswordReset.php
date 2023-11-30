<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Session;

class CheckTokenPasswordReset implements Rule
{
    public $token;

    /**
     * Create a new rule instance.
     *
     * @return void
     *
     */
    public function __construct()
    {
        $this->token = session('password_reset.token');
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
        $reset = PasswordResets::where('login', '=', $value)
            ->where('token', '=', $this->token)
            ->first();

        return $reset != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Login inválido para esta sessão.';
    }
}
