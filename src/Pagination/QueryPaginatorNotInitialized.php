<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Everlution\PaginationBundle\PaginationException;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class QueryPaginatorNotInitialized extends PaginationException
{
    public function __construct()
    {
        parent::__construct(
            sprintf(
                'In order to use %s:paginate() you need to set the query builder first.',
                QueryPagination::class
            )
        );
    }
}
