<?php

namespace src\exceptions\products;

use Exception;
use src\traits\LogException;

class ProductEmptyInStockException extends Exception
{
    private string $entity = 'products';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Ocorreu um erro';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}