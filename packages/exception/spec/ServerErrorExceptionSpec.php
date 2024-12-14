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
use Ssc\Exception\SscException;

class ServerErrorExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Unexpected server error has been thrown';

    function let(): void
    {
        $this->beConstructedThrough('make', [
            self::MESSAGE,
        ]);
    }

    function it_is_a_bcom_exception(): void
    {
        $this->shouldHaveType(SscException::class);
    }

    function it_is_thrown_on_unexpected_server_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_500_code(): void
    {
        $this->getCode()->shouldBe(500);
    }
}
