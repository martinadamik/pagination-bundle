<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort;

use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Pagination\Sort\Rule\SortRule;
use Everlution\PaginationBundle\Sort\RequestSortQuery;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class DoctrineSortQuery implements SortQuery
{
    /** @var SortRule[] */
    private $rules;
    /** @var RequestSortQuery */
    private $query;

    public function __construct(SortRulesProvider $provider, RequestSortQuery $query)
    {
        $this->rules = $provider->getSortRules();
        $this->query = $query;
    }

    public function addSorting(QueryBuilder $builder): QueryBuilder
    {
        foreach ($this->rules as $rule) {
            $rule->accept($builder, $this->query);
        }

        return $builder;
    }
}
