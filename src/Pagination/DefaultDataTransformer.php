<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

/**
 * Class DefaultDataTransformer
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
class DefaultDataTransformer implements DataTransformer
{
    public function transform(array $data): array
    {
        return $data;
    }
}
