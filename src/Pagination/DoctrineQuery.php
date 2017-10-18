<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;
use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Pagination\Filter\FilterContainer;
use Everlution\PaginationBundle\Pagination\Sort\SortRulesContainer;


/**
 * Class DoctrineQuery
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
class DoctrineQuery implements Query
{
    /** @var QueryBuilder */
    private $queryBuilder;
    private $limit;
    private $offset;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function appendFilters(FilterContainer $container)
    {
        /** @var DoctrineQueryFilter $filter */
        foreach ($container->getFilters() as $filter) {
            $filter->append($this->queryBuilder);
        }
    }

    public function addSorting(SortRulesContainer $container)
    {
        foreach ($container->getSortRules() as $sortRule) {
            $sortRule->accept($this->queryBuilder);
        }
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    public function getResults()
    {
        return $this
            ->queryBuilder
            ->setFirstResult($this->offset)
            ->setMaxResults($this->limit)
            ->getQuery()
            ->getResult();
    }
}
