<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\QueryBuilder;
use Everlution\PaginationBundle\Pagination\Filter\FilterContainerInterface;
use Everlution\PaginationBundle\Pagination\Sort\SortQuery;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class QueryPagination implements QueryToPagination
{
    const DEFAULT_MAX_RESULTS = 100;

    /** @var QueryBuilder */
    private $builder = null;
    /** @var FilterContainerInterface */
    private $filterContainer;
    /** @var SortQuery */
    private $sortQuery;
    /** @var AbstractPaginator */
    private $paginator;
    /** @var int */
    private $maxResults;
    /** @var DataTransformer */
    private $transformer = DefaultDataTransformer::class;

    public function __construct(
        FilterContainerInterface $filterContainer,
        SortQuery $sortQuery,
        AbstractPaginator $paginator,
        int $maxResults = self::DEFAULT_MAX_RESULTS,
        DataTransformer $transformer
    ) {
        $this->filterContainer = $filterContainer;
        $this->sortQuery = $sortQuery;
        $this->paginator = $paginator;
        $this->maxResults = $maxResults;
        $this->transformer = $transformer;
    }

    public function paginate(int $limit, int $offset, array $parameters = []): Page
    {
        if ($limit > $this->maxResults) {
            throw new MaxResultsExceeded($this->maxResults, $limit);
        }

        if (false === $this->builder instanceof QueryBuilder) {
            throw new QueryPaginatorNotInitialized();
        }

        $optionsResolver = new OptionsResolver();
        $this->filterContainer->configureFilters($optionsResolver);
        $options = $optionsResolver->resolve($parameters);

        $this->filterContainer->appendFilters($this->builder, $options);
        $queryBuilder = $this->sortQuery->addSorting($this->builder);

        $this->paginator
            ->setBuilder($queryBuilder)
            ->setOffset($offset)
            ->setLimit($limit)
            ->setQuery();

        return new ListPage($this->paginator, $this->transformer);
    }

    public function setQueryBuilder(QueryBuilder $builder): Pagination
    {
        $this->builder = $builder;

        return $this;
    }

    public function getMaxResults(): int
    {
        return $this->maxResults;
    }

    public function setMaxResults(int $maxResults): Pagination
    {
        $this->maxResults = $maxResults;

        return $this;
    }
}
