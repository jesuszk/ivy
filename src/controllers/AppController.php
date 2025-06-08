<?php

namespace src\controllers;

use src\services\UserService;
use src\support\View;

class AppController
{

    function __construct(
        private UserService $userService
    ) {}

    /**
     * Retorna a view inicial do painel administrativo
     * 
     * Exibe uma mensagem de boas-vindas para o usuário no primeiro acesso.
     * @return View
     */
    function home(): View
    {
        $this->userService->greetings();
        return view("panel.home", []);
    }
}
