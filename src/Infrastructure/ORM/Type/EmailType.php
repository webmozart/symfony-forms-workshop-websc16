<?php

namespace Contacts\Infrastructure\ORM\Type;

use Contacts\Domain\Value\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EmailType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return $value ? Email::fromString($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $value = $value instanceof Email ? $value->toString() : null;

        return parent::convertToDatabaseValue($value, $platform);
    }

    public function getName()
    {
        return 'email';
    }
}
