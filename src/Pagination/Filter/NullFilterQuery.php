<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NullFilterQuery.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
final class NullFilterQuery implements FilterQuery
{
    public function appendFilter(QueryBuilder $builder, array $options = []): void
    {
        return;
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        return;
    }
}
