<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Value;

use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\InvalidPasswordHash;

class PasswordHash
{
    private string $value;

    /**
     * Summary of __construct
     * @param string $value
     * @throws InvalidPasswordHash
     */
    function __construct(string $value)
    {
        if (empty($value)) {
            throw new InvalidPasswordHash();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}