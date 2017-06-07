<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\Query;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class NullFilterQuery implements FilterQuery
{
    public function addFilter(Query $query): Query
    {
        return $query;
    }
}
