<?php

namespace src\requests;

class RegisterRequest extends Request
{
    public function __construct() {}

    protected array $rules = [
        'email' => 'required',
        'passwd' => 'required',
        'passwd_confirmation' => 'required',
    ];
}
