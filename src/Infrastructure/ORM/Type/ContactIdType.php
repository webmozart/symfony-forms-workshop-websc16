<?php

namespace Contacts\Infrastructure\ORM\Type;

use Contacts\Domain\Contact\ContactId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ContactIdType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $value = parent::convertToPHPValue($value, $platform);

        return $value ? ContactId::fromString($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $value = $value instanceof ContactId ? $value->toString() : null;

        return parent::convertToDatabaseValue($value, $platform);
    }

    public function getName()
    {
        return 'contact_id';
    }
}
