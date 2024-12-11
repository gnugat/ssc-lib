<?php

namespace spec\Ssc\Exception;

use Ssc\Exception\SscException;
use PhpSpec\ObjectBehavior;

class ClientErrorExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Client error exception occur just now';

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

    function it_is_thrown_on_client_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_400_code(): void
    {
        $this->getCode()->shouldBe(400);
    }
}
