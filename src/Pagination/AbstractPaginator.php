<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AbstractPaginator
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
abstract class AbstractPaginator implements Paginator
{
    /**
     * @var QueryBuilder
     */
    private $builder;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * @return QueryBuilder
     */
    public function getBuilder(): QueryBuilder
    {
        return $this->builder;
    }

    /**
     * @param QueryBuilder $builder
     * @return AbstractPaginator
     */
    public function setBuilder(QueryBuilder $builder): AbstractPaginator
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->query;
    }

    /**
     * @return AbstractPaginator
     */
    public function setQuery(): AbstractPaginator
    {
        $this->query = $this->builder->getQuery()
            ->setMaxResults($this->limit)
            ->setFirstResult($this->offset);

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return AbstractPaginator
     */
    public function setLimit(int $limit): AbstractPaginator
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return AbstractPaginator
     */
    public function setOffset(int $offset): AbstractPaginator
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    abstract public function count(): int;

    /**
     * @return array
     */
    abstract public function getResults(): array;

}
