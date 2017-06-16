<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort\Column;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface SortColumn
{
    public function getColumn(): string;

    public function getDirection(): string;

    public function getOppositeDirection(): string;
}
