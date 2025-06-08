<?php

namespace src\exceptions\app;

use Exception;
use src\traits\LogException;

class CreateUserFailException extends Exception
{
    private string $entity = 'app';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Não foi possível criar a conta. Se o erro persistir, contate o administrador.';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}
