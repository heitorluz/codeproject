<?php
/**
 * Created by PhpStorm.
 * User: heitor
 * Date: 20/10/15
 * Time: 16:51
 */

namespace CodeProject\OAuth;


use Illuminate\Support\Facades\Auth;

class PasswordVerifier
{
    public function verify($username, $password)
    {

        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}