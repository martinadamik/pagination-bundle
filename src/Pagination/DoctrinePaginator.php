<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination;

use Doctrine\ORM\Query;

/**
 * Class DoctrinePaginator
 *
 * @author Martin Adamik <martin.adamik@everlution.sk>
 */
class DoctrinePaginator extends AbstractPaginator
{
    /**
     * Clones a query.
     *
     * @param Query $query The query.
     *
     * @return Query The cloned query.
     */
    private function cloneQuery(Query $query): Query
    {
        /* @var $cloneQuery Query */
        $cloneQuery = clone $query;

        $cloneQuery->setParameters(clone $query->getParameters());
        $cloneQuery->setCacheable(false);

        foreach ($query->getHints() as $name => $value) {
            $cloneQuery->setHint($name, $value);
        }

        return $cloneQuery;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count(
            $this->cloneQuery(
                $this->getBuilder()->getQuery()
            )
            ->setFirstResult(null)
            ->setMaxResults(null)
            ->getScalarResult()
        );
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->getQuery()->getResult();
    }
}
