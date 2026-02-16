<?php

namespace Ramiromd\Sfclean\Shared\Repository\Type;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramiromd\Sfclean\Shared\Value\CreationDate;

class CreationDateType extends Type
{
    public const NAME = 'creation_date';
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

    public function convertToPHPValue($value, AbstractPlatform $platform): ?CreationDate
    {

        return $value ? new CreationDate(new DateTimeImmutable($value)) : null;
    }
}