<?php

namespace src\requests\categories;

use src\requests\Request;

class CategoryUpdateRequest extends Request
{
    protected array $rules = [
        'name' => 'required',
        'active' => 'required',
    ];
}
