<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort;

use Doctrine\ORM\QueryBuilder;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class NullSortQuery implements SortQuery
{
    public function addSorting(QueryBuilder $builder): QueryBuilder
    {
        return $builder;
    }
}
