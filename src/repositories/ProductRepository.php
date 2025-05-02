<?php

namespace src\repositories;

use src\repositories\Querio;

class ProductRepository extends Querio
{
    protected string $table = 'products';

    /**
     * @return array<int, object>
     */
    function getAllWithCategories(): array
    {
        $results = $this->getAll();
        foreach ($results as $resultIdx => &$result) {
            $result->category = $this->table('categories')->selectOne(['*'])->where('id', '=', $result->category_id)->finish();
        }
        return $results;
    }
}
