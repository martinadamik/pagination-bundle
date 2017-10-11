<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Twig;

use Everlution\PaginationBundle\Pagination\Page;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class PaginateExtension extends BaseExtension
{
    const DEFAULT_TEMPLATE = 'EverlutionPaginationBundle::pagination.html.twig';

    /** @var \Twig_Environment */
    private $templating;

    /** @var string */
    private $paginationTemplate;

    public function __construct(
        \Twig_Environment $templating,
        string $paginationTemplate = self::DEFAULT_TEMPLATE
    )
    {
        $this->templating = $templating;
        $this->paginationTemplate = $paginationTemplate;
    }

    public function renderPagination(
        Page $page,
        array $customParameters = [],
        string $customRoute = null,
        string $paramPrefix = ''
    ): string {
        return $this
            ->templating
            ->render(
                $this->paginationTemplate,
                [
                    'page' => $page,
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
            $this->registerFunction('paginate', 'renderPagination'),
        ];
    }

    public function getFilters()
    {
        return [
            $this->registerFilter('setPage', 'setPage'),
        ];
    }
}
