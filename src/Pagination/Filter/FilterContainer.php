<?php

namespace Everlution\PaginationBundle\Pagination\Filter;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FilterContainer.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class FilterContainer implements FilterContainerInterface
{
    /**
     * @var Collection|FilterQuery[]
     */
    private $filters;

    /**
     * FilterContainer constructor.
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = new ArrayCollection();
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }
    }

    protected function addFilter(FilterQuery $filterQuery): void
    {
        $this->filters->add($filterQuery);
    }

    public function appendFilters(QueryBuilder $builder, array $options = []): void
    {
        foreach ($this->filters as $filter) {
            $filter->appendFilter($builder, $options);
        }
    }

    public function configureFilters(OptionsResolver $options): void
    {
        foreach ($this->filters as $filter) {
            $filter->configureOptions($options);
        }
    }

}
