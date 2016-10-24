<?php

namespace App\Library;


use JWTAuth;
use JWTFactory;

trait Token
{

    protected function createToken($array)
    {
        $payload = JWTFactory::make($array);

        return JwtAuth::encode($payload)->get();
    }

    protected function getAuthenticatedUser()
    {
        $token = JWTAuth::getToken();

        return JWTAuth::decode($token)->get();

    }

}