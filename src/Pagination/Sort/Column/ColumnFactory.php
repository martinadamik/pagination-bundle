<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort\Column;

use Everlution\PaginationBundle\Sort\Properties\Direction;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface ColumnFactory
{
    public function create(string $columnName, Direction $direction): SortColumn;
}
