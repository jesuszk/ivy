<?php

namespace src\requests;

use InvalidArgumentException;
use src\database\models\User;
use src\exceptions\app\AlreadyExistException;

class AuthRegisterRequest extends Request
{
    protected array $rules = [
        "username" => "required",
        "password" => "required",
        "password_confirmation" => "required"
    ];


    function getDataWithPasswordEncrypted()
    {
        $data = $this->get();

        if ($data["password"] !== $data["password_confirmation"])
            throw new InvalidArgumentException("A senha de confirmação não confere com a senha original");

        $user = User::getByColumn("username", $data["username"]);
        if($user)
            throw new AlreadyExistException("Nome de usuário indisponível. Por favor, tente outro.");

        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        return array_excepts($data, ["password_confirmation"]);
    }
}
