<?php

namespace Contacts\Infrastructure\Util;

final class ObjectArray
{
    public static function map($method, array $objects)
    {
        return array_map(
            function ($object) use ($method) {
                return $object->$method();
            },
            $objects
        );
    }

    private function __construct()
    {
    }
}
