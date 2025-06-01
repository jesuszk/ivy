<?php

namespace src\models;

use src\repositories\Querio;

class Category extends Querio
{
    public static string $table = "categories";


    //custom fields
    public ?string $name;
    
    // fields default
    public string $uuid;
    public string $id;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;
}
