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

class LicenseHeader
{
    private const DEFAULT_TEMPLATE = <<<'TPL'
        This file is part of the {{ package_name }} package.
        
        (c) {{ owner_name }} <{{ owner_email }}>
         
        For the full copyright and license information, please view the LICENSE
        file that was distributed with this source code.
        TPL;

    public static function forPackage(
        string $name,
        array $owners,
        string $template = self::DEFAULT_TEMPLATE,
    ): string {
        return Template\Replace::in($template, [
            'package_name' => $name,
            'owner_name' => $owners[0]['name'],
            'owner_email' => $owners[0]['email'],
        ]);
    }
}
