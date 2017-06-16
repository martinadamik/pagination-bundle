<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Twig;

use Everlution\PaginationBundle\Sort\Properties\DirectionHelper;
use Everlution\PaginationBundle\Sort\Properties\Icon\HeaderIcon;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class SortableHeaderExtension extends BaseExtension
{
    const DEFAULT_HEADER_TEMPLATE = 'EverlutionPaginationBundle::sortable_header.html.twig';

    /** @var \Twig_Environment */
    private $templating;
    /** @var DirectionHelper */
    private $directionHelper;
    /** @var HeaderIcon */
    private $headerIcon;
    /** @var string */
    private $headerTemplate;

    public function __construct(
        \Twig_Environment $templating,
        DirectionHelper $directionHelper,
        HeaderIcon $headerIcon,
        string $headerTemplate = self::DEFAULT_HEADER_TEMPLATE
    ) {
        $this->templating = $templating;
        $this->directionHelper = $directionHelper;
        $this->headerIcon = $headerIcon;
        $this->headerTemplate = $headerTemplate;
    }

    public function getSortableHeader(string $label, string $queryString, string $class = ''): string
    {
        $query = $this->directionHelper->getQueryArray($queryString);
        $currentDirection = $this->directionHelper->getCurrentDirection($queryString);

        return $this
            ->templating
            ->render(
                $this->headerTemplate,
                [
                    'label' => $label,
                    'query' => $query,
                    'icon' => $this->headerIcon->getIcon($currentDirection),
                    'class' => $class,
                ]
            );
    }

    public function getFunctions()
    {
        return [
            $this->registerFunction('sortable_header', 'getSortableHeader'),
        ];
    }
}
