<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface FilterQuery
{
    public function addFilter(QueryBuilder $builder): QueryBuilder;
}
