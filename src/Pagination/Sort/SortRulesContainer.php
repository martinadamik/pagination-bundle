<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Sort;

use Everlution\PaginationBundle\Pagination\Sort\Rule\SortRule;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class SortRulesContainer implements SortRulesProvider
{
    /** @var SortRule[] */
    private $rules = [];

    public function addRule(SortRule $rule): self
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * @return SortRule[]
     */
    public function getSortRules(): array
    {
        return $this->rules;
    }
}
