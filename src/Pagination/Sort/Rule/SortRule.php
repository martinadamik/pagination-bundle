<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort\Rule;

use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Sort\RequestSortQuery;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface SortRule
{
    public function accept(QueryBuilder &$builder, RequestSortQuery $query): void;
}
