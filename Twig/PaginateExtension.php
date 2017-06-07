<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Twig;

use Everlution\PaginationBundle\Pagination\Page;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class PaginateExtension extends \Twig_Extension
{
    const DEFAULT_TEMPLATE = 'EverlutionPaginationBundle::pagination.html.twig';

    /** @var \Twig_Environment */
    private $templating;

    public function __construct(\Twig_Environment $templating)
    {
        $this->templating = $templating;
    }

    public function renderPagination(
        Page $page,
        array $customParameters = [],
        string $template = self::DEFAULT_TEMPLATE,
        string $customRoute = null,
        string $paramPrefix = ''
    ): string {
        return $this
            ->templating
            ->render(
                $template,
                [
                    'page' => $page,
//                    'currentPage' => $paginator['currentPage'],
//                    'pagesCount' => $paginator['availablePages'],
                    'customParameters' => $customParameters,
                    'customRoute' => $customRoute,
                    'paramPrefix' => $paramPrefix,
                ]
            );
    }

    public function setPage(array $routeParams = null, int $page = 1, string $prefix = ''): array
    {
        $routeParams[$prefix.'page'] = $page;

        return $routeParams;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('paginate', [$this, 'renderPagination'], ['is_safe' => ['html']]),
        ];
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('setPage', [$this, 'setPage']),
        ];
    }
}
