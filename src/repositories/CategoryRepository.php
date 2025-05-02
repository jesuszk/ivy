<?php

namespace src\repositories;

use src\repositories\Querio;

class CategoryRepository extends Querio
{
    protected string $table = 'categories';
    private const ACTIVE = 'Y';
    private const INACTIVE = 'N';


    /**
     * Get only active categories
     * 
     * @return array|false List of active categories
     */
    function getOnlyActives(): array|false
    {
        return $this->getByActiveOrNot(self::ACTIVE);
    }

    /**
     * Get only inactive categories
     * 
     * @return array|false List of inactive categories  
     */
    function getOnlyInactives(): array|false
    {
        return $this->getByActiveOrNot(self::INACTIVE);
    }

    /**
     * Get categories filtered by active status
     * 
     * @param string $t The active status to filter by ('Y' or 'N')
     * @return array|false List of categories matching the active status
     */
    function getByActiveOrNot(string $t): array|false
    {
        return $this->select(['*'])->where('active', '=', $t)->finish();
    }
}
