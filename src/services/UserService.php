<?php

namespace src\services;

use DI\NotFoundException;
use src\database\models\User;
use src\exceptions\app\CreateUserFailException;
use src\exceptions\app\PasswordWrongException;
use src\support\Sessions;

class UserService
{

    function create(array $data): User
    {
        $user = User::create($data);

        if (!$user)
            throw new CreateUserFailException($data);

        return $user;
    }

    function update(array $data)
    {
        $user = User::updateByUuid(user()->uuid, $data);
        $this->createSessionAuthentication($user);
    }


    function login(array $data)
    {
        $user = User::table("users")->selectOne(["*"])->where("username", "=", $data["username"])->finish();

        if (!$user)
            throw new NotFoundException("Usuário não encontrado em nossa base");

        if (!password_verify($data["password"], $user->password))
            throw new PasswordWrongException($data);

        return $this->createSessionAuthentication($user);
    }

    function createSessionAuthentication(User $user)
    {
        return Sessions::set("authentication", [
            "uuid" => $user->uuid,
            "username" => $user->username,
            "start_at" => date("Y-m-d H:i:s"),
            "show_message" => $user->show_message
        ], true);
    }
}
