<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure\Repository\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\PasswordHash;

class PasswordHashType extends Type
{
    public const NAME = 'password_hash';
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

    public function convertToPHPValue($value, AbstractPlatform $platform): ?PasswordHash
    {
        return $value ? new PasswordHash($value) : null;
    }
}