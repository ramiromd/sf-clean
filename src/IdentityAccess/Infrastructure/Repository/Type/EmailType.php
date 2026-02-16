<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure\Repository\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Email;

class EmailType extends Type
{
    public const NAME = 'user_email';
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

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return $value ? new Email($value) : null;
    }
}