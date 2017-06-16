<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Sort\Properties;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class Direction
{
    const ASCENDING = 1;
    const DESCENDING = 2;
    const NONE = 0;

    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
