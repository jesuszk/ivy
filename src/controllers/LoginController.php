<?php

namespace src\controllers;

use Exception;
use src\database\models\User;
use src\requests\AuthLoginRequest;
use src\services\UserService;
use src\support\Redirect;
use src\support\Sessions;
use src\support\View;

class LoginController
{

    function __construct(
        private UserService $userService
    ) {}

    /**
     * Exibe o formulário de login
     * @return View
     */
    function form(): View
    {
        return view("auth.login", []);
    }

    /**
     * Recebe a requisição para realizar o login
     * @param AuthLoginRequest $req - Request com os dados do formulário
     * @return Redirect
     */
    function login(AuthLoginRequest $req): Redirect
    {
        try {
            $this->userService->login($req->get());
            return redirect()->route("panel.home");
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Realiza o logout da aplicação excluindo a sessão e redirecionando para a tela de login
     * @return Redirect
     */
    function logout(): Redirect
    {
        Sessions::unset("authentication");
        return redirect()->route("auth.login")->withSuccess("Logout realizado com sucesso. Te espero novamente em breve 🙂");
    }
}
