<?php

namespace src\controllers;

use src\requests\RegisterRequest;
use src\services\RegisterService;
use src\support\View;

class RegisterController
{
    function __construct(
        private RegisterService $registerService
    ) {}

    /**
     * Show the register page
     * @return View
     */
    function index(): View
    {
        return view('auth.register');
    }

    /**
     * Store the register
     * @return View
     */
    function store(RegisterRequest $request)
    {
        $this->registerService->register($request->get());
    }
}
