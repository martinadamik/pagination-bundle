<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Pagination\Transformer;

use Everlution\PaginationBundle\Pagination\Page;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class PageToLimitOffsetQueryTransformer
{
    const DEFAULT_PAGE_QUERY_STRING = 'page';

    /** @var PageToLimitOffset */
    private $transformer;
    /** @var string */
    private $pageQueryString;
    /**
     * @var int
     */
    private $pageSize;

    public function __construct(
        PageToLimitOffset $transformer,
        int $pageSize = Page::DEFAULT_PAGE_SIZE,
        string $pageQueryString = self::DEFAULT_PAGE_QUERY_STRING
    ) {
        $this->transformer = $transformer;
        $this->pageQueryString = $pageQueryString;
        $this->pageSize = $pageSize;
    }

    public function transform(Request $request): Request
    {
        if (false === $request->query->has($this->pageQueryString)) {
            $request->attributes->add(
                [
                    'limit' => $request->query->get('limit', $this->pageSize),
                    'offset' => $request->query->get('offset', 0),
                ]
            );

            return $request;
        }

        if (0 > $page = (int) $request->query->get($this->pageQueryString)) {
            $page = 1;
        }

        $parameters = $this->transformer->transform($page, $this->pageSize);
        $request->attributes->add($parameters);

        return $request;
    }

    public function setPageQueryString(string $string): self
    {
        $this->pageQueryString = $string;

        return $this;
    }
}
