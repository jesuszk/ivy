<?php

namespace src\controllers\shared;

use src\support\View;

class MenuController
{

    function __construct() {}

    /**
     * Renderiza a tela com a tabela das etapas da SFP do tipo DIFERENTE DE RODAS
     * @return View
     */
    function render(): View
    {
        make_log("Acessou a listagem de etapas", "listagem {$_ENV["DW"]}");
        return view("shared.menu.index");
    }
}
