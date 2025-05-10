<?php

namespace src\exceptions\categories;

use Exception;
use src\traits\LogException;

class CategoryGetAllFailedException extends Exception
{
    private string $entity = 'categories';

    use LogException;

    function __construct(array $content = [])
    {
        $message = 'Failed to get all categories';
        $code = 500;
        $this->log($message, $code, json_encode($content));
        return parent::__construct($message, $code);
    }
}