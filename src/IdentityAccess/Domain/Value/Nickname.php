<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Value;

use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\TooLargeNickname;
use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\TooShortNickname;

class Nickname
{
    private string $value;

    /**
     * @throws TooShortNickname
     * @throws TooLargeNickname
     */
    function __construct(string $value)
    {
        if (strlen($value) < 4) {
            throw new TooShortNickname();
        }

        if (strlen($value) > 12) {
            throw new TooLargeNickname();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}