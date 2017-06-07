<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class ListPage implements Page
{
    /** @var int */
    private $currentPage;
    /** @var int */
    private $availablePages;
    /** @var int */
    private $availableItems;
    /** @var int */
    private $pageSize;
    /** @var array */
    private $items;

    public function __construct(Paginator $paginator)
    {
        $offset = $paginator->getQuery()->getFirstResult();
        $limit = $paginator->getQuery()->getMaxResults();

        $this->items = iterator_to_array($paginator);
        $this->currentPage = (int) ceil($offset / $limit) + 1;
        $itemsCount = $paginator->count();
        $this->availablePages = (int) ceil($itemsCount / $limit);
        $this->availableItems = $itemsCount;
        $this->pageSize = $limit;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getAvailablePages(): int
    {
        return $this->availablePages;
    }

    /**
     * @return int
     */
    public function getAvailableItems(): int
    {
        return $this->availableItems;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
