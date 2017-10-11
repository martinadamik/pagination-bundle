<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\Query;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
interface Pagination
{
    /**
     * @param int $limit
     * @param int $offset
     * @param array $options
     * @param $hydrationMode
     * @return Page
     */
    public function paginate(int $limit, int $offset, array $options = [], $hydrationMode = Query::HYDRATE_OBJECT): Page;
}
