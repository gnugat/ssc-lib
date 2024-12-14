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

namespace spec\Ssc\Exception;

use PhpSpec\ObjectBehavior;

class SscExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Uncaught exception, or fatal error';

    function let(): void
    {
        $this->beConstructedThrough('make', [
            self::MESSAGE,
        ]);
    }

    function it_is_thrown_on_uncaught_exception_or_fatal_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_500_code(): void
    {
        $this->getCode()->shouldBe(500);
    }
}
