<?php

declare(strict_types=1);

namespace Codeception\Util\Shared;

use function array_filter;
use function array_pop;
use function explode;
use function implode;
use function ltrim;
use function str_replace;

trait Namespaces
{
    /**
     * @return string[]
     */
    protected function breakParts(string $class): array
    {
        $class = str_replace('/', '\\', ltrim($class, './\\'));
        return explode('\\', $class);
    }

    protected function getShortClassName(string $class): string
    {
        $namespaces = $this->breakParts($class);
        return array_pop($namespaces);
    }

    protected function getNamespaceString(string $class): string
    {
        return implode('\\', $this->getNamespaces($class));
    }

    protected function getNamespaceHeader(string $class): string
    {
        $str = $this->getNamespaceString($class);
        return $str ? "\nnamespace {$str};\n" : '';
    }

    protected function getNamespaces(string $class): array
    {
        $namespaces = $this->breakParts($class);
        array_pop($namespaces);
        return array_filter($namespaces, 'strlen');
    }
}
