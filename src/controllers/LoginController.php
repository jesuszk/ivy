<?php

namespace src\controllers;

class LoginController
{
    function __construct() {}

    function index() {
        return view('auth.login');
    }
}
