<?php

declare(strict_types=1);

namespace Everlution\PaginationBundle\Twig;

/**
 * @author Ivan Barlog <ivan.barlog@everlution.sk>
 */
abstract class BaseExtension extends \Twig_Extension
{
    protected function registerFunction(
        string $name,
        string $function,
        array $options = ['is_safe' => ['html']]
    ): \Twig_SimpleFunction {
        return new \Twig_SimpleFunction(
            $name,
            [$this, $function],
            $options
        );
    }

    protected function registerFilter(string $name, string $function, array $options = []): \Twig_SimpleFilter
    {
        return new \Twig_SimpleFilter(
            $name,
            [$this, $function],
            $options
        );
    }
}
