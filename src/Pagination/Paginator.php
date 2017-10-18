<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * Interface Paginator
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
interface Paginator
{
    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @return int
     */
    public function getOffset(): int;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @return array
     */
    public function getResults(): array;
}
