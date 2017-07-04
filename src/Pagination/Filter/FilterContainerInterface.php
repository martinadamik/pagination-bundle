<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface FilterContainerInterface.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
interface FilterContainerInterface
{
    /**
     * @param QueryBuilder $builder
     * @param array $options
     */
    public function appendFilters(QueryBuilder $builder, array $options = []): void;

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureFilters(OptionsResolver $optionsResolver): void;
}
