<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort;

use Everlution\PaginationBundle\Pagination\Sort\Rule\SortRule;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface SortRulesProvider
{
    /**
     * @return SortRule[]
     */
    public function getSortRules(): array;
}
