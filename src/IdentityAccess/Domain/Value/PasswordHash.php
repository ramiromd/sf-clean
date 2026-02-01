<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Value;

class PasswordHash
{
    private string $value;

    function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}