<?php

namespace src\requests\users;

use src\requests\Request;

class UserUpdateRequest extends Request {
    protected array $rules = [
        'id' => 'required',
        'name' => 'required',
        'age' => 'required',
        'gender' => 'required',
    ];
}