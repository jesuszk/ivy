<?php

namespace src\controllers;

use src\requests\HabitStoreRequest;

class HabitController
{
    function __construct() {}

    function add(HabitStoreRequest $req)
    {
        dd($req->getStore());
    }
}
