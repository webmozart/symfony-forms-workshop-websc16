<?php

namespace Contacts\Infrastructure\Framework;

use Ramsey\Uuid\Uuid;

abstract class UuidId
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     *
     * @return static
     */
    public static function fromString($string)
    {
        return new static($string);
    }

    /**
     * @return static
     */
    public static function generate()
    {
        return static::fromString(Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->string;
    }

    public function __toString()
    {
        return $this->string;
    }

    private function __construct($string)
    {
        $this->string = (string) $string;
    }
}
