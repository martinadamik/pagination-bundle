<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface Pagination
{
    /**
     * @param int $limit
     * @param int $offset
     * @param array $parameters
     * @return Page
     */
    public function paginate(int $limit, int $offset, array $parameters = []): Page;
}
