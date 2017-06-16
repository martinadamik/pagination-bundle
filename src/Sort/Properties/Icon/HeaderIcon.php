<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Sort\Properties\Icon;

use Everlution\PaginationBundle\Sort\Properties\Direction;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface HeaderIcon
{
    public function getIcon(Direction $direction): string;
}
