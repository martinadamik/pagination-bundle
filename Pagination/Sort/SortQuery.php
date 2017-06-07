<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort;

use Doctrine\ORM\Query;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface SortQuery
{
    public function addSort(Query $query): Query;
}
