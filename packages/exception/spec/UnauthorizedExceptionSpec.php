<?php

namespace spec\Ssc\Exception;

use Ssc\Exception\SscException;
use PhpSpec\ObjectBehavior;

class UnauthorizedExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Missing or invalid credentials';

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

    function it_is_thrown_on_authentication_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_401_code(): void
    {
        $this->getCode()->shouldBe(401);
    }
}
