<?php

namespace spec\Ssc\Exception;

use Ssc\Exception\SscException;
use PhpSpec\ObjectBehavior;

class ForbiddenExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Credentials found and valid, but not allowed for this resource';

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

    function it_is_thrown_on_authorization_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_403_code(): void
    {
        $this->getCode()->shouldBe(403);
    }
}
