<?php

namespace src\controllers;

use Exception;
use src\requests\AuthRegisterRequest;
use src\services\UserService;
use src\support\View;

class RegisterController
{

    function __construct(
        private UserService $userService
    ) {}

    /**
     * Exibe o formulário de registro de usuáriop
     * @return View
     */
    function form(): View
    {
        return view("auth.register", []);
    }

    /**
     * Recebe o formulário de registro de usuário
     * @param AuthRegisterRequest $req - Request com os dados de cadastro do usuário
     */
    function createUser(AuthRegisterRequest $req)
    {
        try {
            $user = $this->userService->create($req->getDataWithPasswordEncrypted());
            $sessionData = $this->userService->createSessionAuthentication($user);

            return redirect()->route("panel.home")->withSuccess("Seja bem-vindo(a), estou muito feliz em ter você aqui 🎉");
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
