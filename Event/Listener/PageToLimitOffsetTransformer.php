<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Event\Listener;

use Everlution\PaginationBundle\Pagination\Transformer\PageToLimitOffsetQueryTransformer;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class PageToLimitOffsetTransformer
{
    /** @var PageToLimitOffsetQueryTransformer */
    private $transformer;

    public function __construct(PageToLimitOffsetQueryTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $this->transformer->transform($request);
    }
}
