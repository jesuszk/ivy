<?php

namespace src\controllers;

use src\support\View;

class LoginController
{
    function __construct() {}

    /**
     * Show the login page
     * @return View
     */
    function index(): View
    {
        return view('auth.login');
    }
}
