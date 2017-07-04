<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface FilterQuery.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
interface FilterQuery
{
    /**
     * @param QueryBuilder $builder
     * @param array $options
     */
    public function appendFilter(QueryBuilder $builder, array $options = []): void;

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver): void;
}
