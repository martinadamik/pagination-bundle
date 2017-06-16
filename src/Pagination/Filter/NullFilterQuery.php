<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class NullFilterQuery implements FilterQuery
{
    public function addFilter(QueryBuilder $builder): QueryBuilder
    {
        return $builder;
    }
}
