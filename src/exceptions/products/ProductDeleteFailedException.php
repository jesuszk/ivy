<?php

namespace src\exceptions\products;

use Exception;
use src\traits\LogException;

class ProductDeleteFailedException extends Exception
{
    private string $entity = 'products';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Failed to delete product';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}