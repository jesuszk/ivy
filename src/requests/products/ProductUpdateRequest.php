<?php

namespace src\requests\products;

use src\requests\Request;

class ProductUpdateRequest extends Request {
    protected array $rules = [
        'name' => 'required',
        'price' => 'required',
        'quantity' => 'required',
        'control_stock' => 'required',
        'value_min' => 'nullable',
    ];
}
