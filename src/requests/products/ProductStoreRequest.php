<?php

namespace src\requests\products;

use src\requests\Request;

class ProductStoreRequest extends Request
{
    protected array $rules = [
        'name' => 'required',
        'price' => 'required',
        'category_id' => 'required'
    ];
}
