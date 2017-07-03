<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractFilterQuery.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
abstract class AbstractFilterQuery implements FilterQuery
{
    public function appendFilter(QueryBuilder $builder, array $options = []): void
    {
        return;
    }

    public function configureOptions(OptionsResolver $options): void
    {
        return;
    }
}
