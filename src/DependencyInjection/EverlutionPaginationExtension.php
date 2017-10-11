<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
class EverlutionPaginationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('everlution.pagination.max_page_size', $config['max_page_size']);
        $container->setParameter('everlution.pagination.default_page_size', $config['default_page_size']);
        $container->setParameter('everlution.pagination.sortable_header_template', $config['sortable_header_template']);
        $container->setParameter('everlution.pagination.pagination_template', $config['pagination_template']);
        $container->setParameter('everlution.pagination.default_sort_query_string', $config['default_sort_query_string']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
