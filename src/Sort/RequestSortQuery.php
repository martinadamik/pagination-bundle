<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Sort;

use Everlution\PaginationBundle\Pagination\Sort\Column\ColumnFactory;
use Everlution\PaginationBundle\Pagination\Sort\Column\SortColumn;
use Everlution\PaginationBundle\Sort\Properties\Direction;
use Everlution\PaginationBundle\Sort\Properties\DirectionHelper;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class RequestSortQuery
{
    private $data = [];

    public function __construct(
        RequestStack $requestStack,
        ColumnFactory $columnFactory,
        string $sortQueryString = DirectionHelper::DEFAULT_SORT_QUERY_STRING
    ) {
        $sort = $requestStack->getCurrentRequest()->query->get($sortQueryString, ['id' => 1]);

        foreach ($sort as $column => $direction) {
            if ((int) $direction === 0) {
                continue;
            }

            $this->data[$this->normalize($column)] = $columnFactory->create($column, new Direction((int) $direction));
        }
    }

    public function __call(string $method, array $arguments = []): ?SortColumn
    {
        $column = preg_replace('/^get/', '', $method);

        if (false === array_key_exists($column, $this->data)) {
            return null;
        }

        return $this->data[$column];
    }

    private function normalize(string $column): string
    {
        return join(array_map('ucfirst', explode('_', $column)));
    }
}
