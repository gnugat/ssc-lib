<?php

/**
 * This file is part of the ssc/lib package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Ssc\Cs;

use PhpCsFixer\Config;
use PhpCsFixer\Runner\Parallel\ParallelConfig;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use Symfony\Component\Finder\Finder;

class ConfigBuilder
{
    private function __construct(
        public Finder $finder,
        public ParallelConfig $parallelConfig,
        public array $rules,
        public bool $usingCache,
    ) {
    }

    public static function forPath(string $path): self
    {
        return new self(
            finder: Factory\Finder::in($path),
            parallelConfig: ParallelConfigFactory::detect(),
            rules: Factory\Rules::make(),
            usingCache: true,
        );
    }

    public function withLicenseHeader(string $licenseHeader): self
    {
        $this->rules = \array_merge($this->rules, [
            'header_comment' => [
                'comment_type' => 'PHPDoc',
                'header' => \trim($licenseHeader),
                'location' => 'after_open', // 'after_declare_strict',
                'separate' => 'both',
            ],
        ]);

        return $this;
    }

    public function build(): Config
    {
        return (new Config())
            ->setParallelConfig($this->parallelConfig)
            ->setRules($this->rules)
            ->setUsingCache($this->usingCache)
            ->setFinder($this->finder)
        ;
    }
}
