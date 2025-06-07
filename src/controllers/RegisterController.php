<?php

namespace src\controllers;



class RegisterController
{

    function __construct() {}

    function form()
    {
        return view("auth.register", []);
    }

    function store()
    {
        dd($_POST);
    }
}
