<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(name: 'pluralize', callable: [$this, 'pluralize']),
        ];
    }

    public function pluralize(?int $count, string $singular, string $plural): string
    {
        return $count > 1 ? $plural : $singular;
    }
}
