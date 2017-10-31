<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

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

    /**
     * ListPage constructor.
     *
     * @param Paginator $paginator
     * @param DataTransformer $dataTransformer
     */
    public function __construct(Paginator $paginator, DataTransformer $dataTransformer)
    {
        $offset = $paginator->getOffset();
        $limit = $paginator->getLimit();

        $this->items = $dataTransformer->transform($paginator->getResults());
        $this->currentPage = (int) ceil($offset / $limit) + 1;
        $this->availableItems = $paginator->count();
        $this->availablePages = (int) ceil($this->availableItems / $limit);
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
