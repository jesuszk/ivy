<?php

use src\support\View;

function view(string $view, array $data = [])
{
    return View::render($view, $data);
}
