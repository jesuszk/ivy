<?php

namespace src\controllers;

use src\services\UserService;

class AppController
{

    function __construct(
        private UserService $userService
    ) {}

    function home()
    {
        if (user()->show_message === 'N') {
            notification()->info("Seja bem-vindo(a), <b>" . user()->username . "</b> 👋🏼");
            notification()->info("Este é um sistema pessoal, não somos uma empresa e não devem ser fornecidos dados sensíveis.");
            $this->userService->update(["show_message" => 'Y']);
        }

        return view("panel.home", []);
    }
}
