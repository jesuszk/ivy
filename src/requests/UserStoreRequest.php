<?php

namespace src\requests;

use src\requests\Request;

class serStoreRequest extends Request {
    protected array $rules = [
        'id' => 'required',
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
    ];
}