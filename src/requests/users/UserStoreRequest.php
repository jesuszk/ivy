<?php

namespace src\requests\users;

use src\requests\Request;

class UserStoreRequest extends Request {
    protected array $rules = [
        'id' => 'required',
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
    ];
}