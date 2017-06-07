<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Everlution\PaginationBundle\PaginationException;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class MaxResultsExceeded extends PaginationException
{
    public function __construct(int $maxResults, int $requestedResults)
    {
        parent::__construct(
            sprintf(
                'Number %d exceeds max allowed number of results %d to be retrieved',
                $requestedResults,
                $maxResults
            )
        );
    }
}
