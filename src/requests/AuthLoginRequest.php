<?php

namespace src\requests;


class AuthLoginRequest extends Request
{
    protected array $rules = [
        "username" => "required",
        "password" => "required",
    ];


    function getDataWithPasswordEncrypted()
    {
        $data = $this->get();

        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        return array_excepts($data, ["password_confirmation"]);
    }
}
