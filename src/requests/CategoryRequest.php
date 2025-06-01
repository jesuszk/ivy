<?php

namespace src\requests;

class CategoryRequest extends Request
{
    protected array $rules = [
        "uuid" => "required",
        "name" => "required",
    ];
}
