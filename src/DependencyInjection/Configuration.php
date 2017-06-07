<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\DependencyInjection;

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
            ->end();

        return $treeBuilder;
    }
}
