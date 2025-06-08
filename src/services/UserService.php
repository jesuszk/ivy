<?php

namespace src\services;

use DI\NotFoundException;
use src\database\models\User;
use src\exceptions\app\CreateUserFailException;
use src\exceptions\app\PasswordWrongException;
use src\support\Sessions;

class UserService
{

    /**
     * cria um novo usuário
     * @param array $data - username e password
     * @return User
     */
    function create(array $data): User
    {
        $user = User::create($data);

        if (!$user)
            throw new CreateUserFailException($data);

        return $user;
    }

    /**
     * Exibe uma mensagem de boas vindas ao usuário no primeiro acesso
     * @return void
     */
    function greetings(): void
    {
        if (user()->show_message === 'N') {
            notification()->info("Seja bem-vindo(a), <b>" . user()->username . "</b> 👋🏼");
            notification()->info("Este é um sistema pessoal, não somos uma empresa e não devem ser fornecidos dados sensíveis.");
            $user = User::updateByUuid(user()->uuid, ["show_message" => 'Y']);
            $this->createSessionAuthentication($user);
        }
    }


    /**
     * Realiza o login do usuário
     * @param array $data - username e password
     * @return array - Sessão contendo os dados do usuário
     */
    function login(array $data): array
    {
        $user = User::table("users")->selectOne(["*"])->where("username", "=", $data["username"])->finish();

        if (!$user)
            throw new NotFoundException("Usuário não encontrado em nossa base");

        if (!password_verify($data["password"], $user->password))
            throw new PasswordWrongException($data);

        return $this->createSessionAuthentication($user);
    }

    /**
     * Cria a sessão de autenticação do usuário
     * @param User $user
     * @return array - Sessão contendo os dados do usuário
     */
    function createSessionAuthentication(User $user): array
    {
        return Sessions::set("authentication", [
            "uuid" => $user->uuid,
            "username" => $user->username,
            "start_at" => date("Y-m-d H:i:s"),
            "show_message" => $user->show_message
        ], true);
    }
}
