<?php

namespace Ramiromd\Sfclean\Shared\Value;

use Ramiromd\Sfclean\Shared\Exception\InvalidEntityId;
use Ramsey\Uuid\Uuid;

class EntityId
{

    private string $value;

    /**
     * @throws InvalidEntityId
     */
    function __construct(?string $value)
    {
        $uuid = ($value) ?: Uuid::uuid4()->toString();
        if (!Uuid::isValid($uuid)) {
            throw new InvalidEntityId();
        }

        $this->value = $uuid;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}