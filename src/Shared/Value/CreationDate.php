<?php

namespace Ramiromd\Sfclean\Shared\Value;

use DateTimeImmutable;

class CreationDate
{
    private DateTimeImmutable $value;

    function __construct(?DateTimeImmutable $value)
    {
        $this->value = ($value) ?: new DateTimeImmutable();
    }

    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }

}