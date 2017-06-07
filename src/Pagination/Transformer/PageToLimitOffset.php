<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Transformer;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class PageToLimitOffset
{
    public function transform(int $page, int $pageSize)
    {
        return [
            'limit' => $pageSize,
            'offset' => $pageSize * ($page - 1),
        ];
    }
}
