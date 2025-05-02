<?php

namespace src\requests\categories;

use src\requests\Request;

class CategoryStoreRequest extends Request
{
    protected array $rules = [
        'name' => 'required',
        'active' => 'required',
    ];
}
