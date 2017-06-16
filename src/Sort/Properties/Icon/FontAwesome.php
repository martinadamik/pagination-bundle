<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Sort\Properties\Icon;

use Everlution\PaginationBundle\Sort\Properties\Direction;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class FontAwesome implements HeaderIcon
{
    private $icons = [
        Direction::NONE => 'fa-sort',
        Direction::ASCENDING => 'fa-sort-asc',
        Direction::DESCENDING => 'fa-sort-desc',
    ];

    public function getIcon(Direction $direction): string
    {
        return $this->icons[$direction->getValue()];
    }
}
