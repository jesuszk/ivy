<?php

namespace src\controllers;



class LoginController
{

    function __construct() {}

    function form()
    {
        return view("auth.login", []);
    }
}
