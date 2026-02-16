<?php

namespace Ramiromd\Sfclean\Shared\Repository\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramiromd\Sfclean\Shared\Value\EntityId;

class EntityIdType extends Type
{
    public const NAME = 'entity_id';
    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) : string
    {
        return $platform->getStringTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        return $value?->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?EntityId
    {
        return $value ? new EntityId($value) : null;
    }
}