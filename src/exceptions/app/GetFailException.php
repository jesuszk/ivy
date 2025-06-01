<?php

namespace src\exceptions\app;

use Exception;
use src\traits\LogException;

class GetFailException extends Exception
{
    private string $entity = 'app';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Não foi possível encontrar o(s) registro(s)';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}
