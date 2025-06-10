<?php

namespace src\database\models;

use src\repositories\Querio;

class User extends Querio
{
    public static string $table = "wozk_users";


    public string $uuid;
    public string $id;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;

    public string $username;
    public string $password;
    public string $show_message;
}
