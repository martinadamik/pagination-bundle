<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\DependencyInjection;

use Everlution\PaginationBundle\Sort\Properties\DirectionHelper;
use Everlution\PaginationBundle\Twig\SortableHeaderExtension;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('everlution_pagination');

        $rootNode
            ->children()
                ->integerNode('max_page_size')->defaultValue(100)->end()
                ->integerNode('default_page_size')->defaultValue(20)->end()
                ->scalarNode('sortable_header_template')->defaultValue(SortableHeaderExtension::DEFAULT_HEADER_TEMPLATE)->end()
                ->scalarNode('default_sort_query_string')->defaultValue(DirectionHelper::DEFAULT_SORT_QUERY_STRING)->end()
            ->end();

        return $treeBuilder;
    }
}
