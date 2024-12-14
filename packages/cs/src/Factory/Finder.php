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

namespace Ssc\Cs\Factory;

use Symfony\Component\Finder\Finder as SfFinder;

class Finder
{
    public static function in(string $path): SfFinder
    {
        return SfFinder::create()
            ->in($path)
            ->files()
            ->name('/\.php$/')
            ->exclude('vendor')
            ->exclude('bin')
            ->exclude('cache')
            ->exclude('doc')
            ->exclude('logs')
        ;
    }
}
