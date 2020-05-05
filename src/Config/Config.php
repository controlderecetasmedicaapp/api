<?php


namespace App\Config;


class Config
{
    public function configEmail()
    {
        $email = 'controlderecetasmedicaapp@gmail.com';
        return ['emailFrom' => $email];
    }
}
