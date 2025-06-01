<?php

namespace src\models;

use src\repositories\Querio;

class Product extends Querio
{
    public static string $table = "products";


    public string $uuid;
    public string $id;
    public ?string $price;
    public ?string $name;
    public ?string $stock_min;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;
}
