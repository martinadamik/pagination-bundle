<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface Pagination
{
    public function paginate(int $limit, int $offset): Page;
}
