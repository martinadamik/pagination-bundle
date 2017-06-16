<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Sort\Properties;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class DirectionHelper
{
    const DEFAULT_SORT_QUERY_STRING = 'sort';

    private $directionFlow = [
        Direction::NONE => Direction::ASCENDING,
        Direction::ASCENDING => Direction::DESCENDING,
        Direction::DESCENDING => Direction::NONE,
    ];

    /** @var Request */
    private $request;
    /** @var string */
    private $sortQueryString;

    public function __construct(RequestStack $requestStack, string $sortQueryString = self::DEFAULT_SORT_QUERY_STRING)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->sortQueryString = $sortQueryString;
    }

    public function getNextDirection(string $queryString): Direction
    {
        $currentDirectionValue = $this->getCurrentDirection($queryString)->getValue();

        return new Direction($this->directionFlow[$currentDirectionValue]);
    }

    public function getCurrentDirection(string $queryString): Direction
    {
        $direction = $this->getDirectionFromSortParameters($queryString);

        if (false === in_array($direction, $this->directionFlow)) {
            return new Direction(Direction::NONE);
        }

        return new Direction($direction);
    }

    public function getQueryArray(string $queryString): array
    {
        $query = $this->request->query->all();

        $sort = $this->request->get($this->sortQueryString, []);
        $sort[$queryString] = $this->getNextDirection($queryString)->getValue();

        $query[$this->sortQueryString] = $this->cleanUpSort($sort);

        return $query;
    }

    private function getDirectionFromSortParameters(string $queryString): int
    {
        $sort = $this->request->get($this->sortQueryString, []);

        if (false === array_key_exists($queryString, $sort)) {
            return Direction::NONE;
        }

        return (int) $sort[$queryString];
    }

    private function cleanUpSort(array $query): array
    {
        return array_filter(
            $query,
            function ($item) {
                return $item != 0;
            }
        );
    }
}
