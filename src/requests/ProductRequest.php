<?php

namespace src\requests;

class ProductRequest extends Request
{
    protected array $rules = [
        "uuid" => "required",
        "name" => "required",
        "price" => "required",
        "stock_min" => "required",
    ];
}
