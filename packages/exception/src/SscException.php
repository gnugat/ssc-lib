<?php

/*
 * This file is part of the ssc/lib package.
 *
 * (c) Loïc Faugeron <faugeron.loic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Ssc\Exception;

class SscException extends \DomainException
{
    public const CODE = 500;

    final public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public static function make(string $message, ?\Exception $previous = null): self
    {
        return new static($message, static::CODE, $previous);
    }
}
