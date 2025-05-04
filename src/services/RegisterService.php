<?php

namespace src\services;

class RegisterService
{
    function __construct() {}

    function register(array $dataFromRegisterForm)
    {
        /**
         * 1. verificar se e-mail já não possui cadastro
         * 2. verificar se senha e confirmação são iguais
         * 3. Configurar para conta estar inativa, precisando de confirmação do adm
         * 4. Informar usuário que conta estará disponível somente após a liberação do adm.
         */
    }
}
