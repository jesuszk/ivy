<?php

namespace src\exceptions\app;

use Exception;
use src\traits\LogException;

class PasswordWrongException extends Exception
{
    private string $entity = 'app';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Senha inválida, por favor, verifique e tente novamente';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}
