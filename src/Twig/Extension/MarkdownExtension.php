<?php

namespace App\Twig\Extension;

use App\Services\MarkdownHelper;
use App\Twig\Runtime\MarkdownExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MarkdownExtension extends AbstractExtension
{
    public function __construct(private MarkdownHelper $markdownHelper) {}

    public function getFilters(): array {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('parse_markdown', [$this, 'parse']),
        ];
    }

    public function parse($value) {
        return $this->markdownHelper->parse($value);
    }
}
