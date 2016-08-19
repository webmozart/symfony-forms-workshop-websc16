<?php

namespace Contacts\Infrastructure\Framework;

use Exception;

class NoResult extends Exception
{
    public static function forId($id)
    {
        return new static(sprintf(
            'The object with ID "%s" was not found.',
            $id
        ));
    }
}
