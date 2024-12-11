<?php

namespace spec\Ssc\Exception;

use Ssc\Exception\SscException;
use PhpSpec\ObjectBehavior;

class ValidationFailedExceptionSpec extends ObjectBehavior
{
    private const MESSAGE = 'Error in domain, validation failed';

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

    function it_is_thrown_on_validation_error(): void
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }

    function it_has_422_code(): void
    {
        $this->getCode()->shouldBe(422);
    }
}
