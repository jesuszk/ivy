<?php

namespace src\controllers;

use Exception;
use src\requests\AuthLoginRequest;
use src\services\UserService;
use src\support\Sessions;

class LoginController
{

    function __construct(
        private UserService $userService
    ) {}

    function form()
    {
        return view("auth.login", []);
    }

    function login(AuthLoginRequest $req)
    {
        try {
            $this->userService->login($req->get());
            return redirect()->route("panel.home");
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    function logout()
    {
        Sessions::unset("authentication");
        return redirect()->route("auth.login")->withSuccess("Logout realizado com sucesso. Te espero novamente em breve 🙂");
    }
}
