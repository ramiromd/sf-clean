<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Value;

use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\InvalidEmail;

class Email
{
    private string $value;

    function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmail();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}