<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort\Column;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class DoctrineSortColumn implements SortColumn
{
    const DESCENDING = 'desc';
    const ASCENDING = 'asc';

    const DIRECTION = [
        1 => self::DESCENDING,
        2 => self::ASCENDING,
    ];

    const OPPOSITE_DIRECTION = [
        1 => self::ASCENDING,
        2 => self::DESCENDING,
    ];

    /** @var string */
    private $column;
    /** @var int */
    private $direction;

    public function __construct(string $column, int $direction)
    {
        if (false === array_key_exists($direction, self::DIRECTION)) {
            throw new \InvalidArgumentException('Invalid direction value.');
        }

        $this->column = $column;
        $this->direction = $direction;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function getDirection(): string
    {
        return self::DIRECTION[$this->direction];
    }

    public function getOppositeDirection(): string
    {
        return self::OPPOSITE_DIRECTION[$this->direction];
    }
}
