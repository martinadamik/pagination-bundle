<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\Query;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface QueryToPagination extends Pagination
{
    public function setQuery(Query $query): Pagination;
}
