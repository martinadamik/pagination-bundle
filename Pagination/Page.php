<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface Page
{
    const DEFAULT_PAGE_SIZE = 20;

    /**
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * @return int
     */
    public function getAvailablePages(): int;

    /**
     * @return int
     */
    public function getAvailableItems(): int;

    /**
     * @return int
     */
    public function getPageSize(): int;

    /**
     * @return array
     */
    public function getItems(): array;
}
