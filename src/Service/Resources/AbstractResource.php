<?php

namespace App\Service\Resources;

use DI\Container;
use Symfony\Component\Finder\Finder;

abstract class AbstractResource implements ResourceInterface
{
    public function __construct(protected readonly Container $container)
    {
    }

    public function collect(): array
    {
        $classes = $this->filter($this->getClassesFromDirectory());

        return array_map(fn (string $class) => $this->container->get($class), $classes);
    }

    abstract protected function getPathToDirectory(): string;
    abstract protected function filter(array $classes): array;

    protected function getClassesFromDirectory(): array
    {
        $finder = new Finder();
        $files = $finder->files()->in($this->getPathToDirectory())->name('*.php');

        $classes = [];

        foreach ($files as $file) {
            $content = file_get_contents($file->getRealPath());
            $namespace = '';

            $tokens = token_get_all($content);
            $count = count($tokens);

            for ($i = 0; $i < $count; $i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j = $i + 1; $j < $count; $j++) {
                        if ($tokens[$j][0] === T_NAME_QUALIFIED) {
                            $namespace .= $tokens[$j][1];
                        } elseif ($tokens[$j] === ';') {
                            break;
                        }
                    }
                }

                if (($tokens[$i][0] === T_CLASS || $tokens[$i][0] === T_INTERFACE) &&
                    $tokens[$i + 2][0] === T_STRING) {
                    $className = $tokens[$i + 2][1];
                    $classes[] = $namespace !== '' ? $namespace . '\\' . $className : $className;
                }
            }
        }

        return $classes;
    }
}