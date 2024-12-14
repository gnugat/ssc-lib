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

namespace Ssc\Cs\Factory\Template;

class Replace
{
    /** @param array<string, string> $thoseParameters */
    public static function in(string $template, array $thoseParameters): string
    {
        $placeholders = [];
        $values = [];
        foreach ($thoseParameters as $placeholder => $value) {
            $placeholders[] = "{{ {$placeholder} }}";
            $values[] = $value;
        }

        return str_replace($placeholders, $values, $template);
    }
}
