<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * Interface DataTransformer
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
interface DataTransformer
{
    public function transform(array $data): array;
}
