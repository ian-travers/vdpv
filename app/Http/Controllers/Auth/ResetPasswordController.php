<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->customValidateNewPassword();
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ];
    }

    private function customValidateNewPassword()
    {
        /**
         * Needs: Password length >= 4 (not 8)
         *
         * This happens because there is a hard coded validation in
         * @see \Illuminate\Auth\Passwords\PasswordBroker.
         *
         * When the reset method is called, it will always call validateReset first,
         * which in turn calls validateNewPassword:
         */
        Password::validator(function ($credentials) {
            return mb_strlen($credentials['password']) >= 4;
        });
    }
}
