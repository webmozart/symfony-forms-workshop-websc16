<?php

namespace Contacts\Domain\Value;

class Email
{
    /**
     * @var string
     */
    private $string;

    public static function fromString($string)
    {
        return new static($string);
    }

    public function toString()
    {
        return $this->string;
    }

    public function __toString()
    {
        return $this->string;
    }

    /**
     * @param string $string
     */
    private function __construct($string)
    {
        $this->string = (string) $string;
    }
}
