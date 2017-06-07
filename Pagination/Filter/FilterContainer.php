<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface FilterContainer
{
    public function getFilters(): array;
}
