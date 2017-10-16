<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\QueryBuilder;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface QueryToPagination extends Pagination
{
    public function setQueryBuilder(QueryBuilder $builder): Pagination;

    public function setHydrationMode(string $hydrationMode): Pagination;
}
