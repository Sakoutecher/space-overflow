<?php

namespace App\Services;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

final class MarkdownHelper {
    public function __construct(
        private MarkdownParserInterface $markdown,
        private CacheInterface $cache,
        private LoggerInterface $mdLogger,
        private bool $isDebug,
    ) {}

    public function parse(string $raw): string {
        $this->mdLogger->info('Un markdown à été parser.');
        if ($this->isDebug) {
            return $this->markdown->transformMarkdown($raw);
        }
        return $this->cache->get(md5($raw), function () use ($raw) {
            sleep(2.5);
            return $this->markdown->transformMarkdown($raw);
        });
    }
}