<?php

namespace Contacts\Domain\Value;

class Address
{
    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @param string $street
     * @param string $postalCode
     * @param string $city
     * @param string $countryCode
     */
    public function __construct($street, $postalCode, $city, $countryCode)
    {
        $this->street = (string) $street;
        $this->postalCode = (string) $postalCode;
        $this->city = (string) $city;
        $this->countryCode = (string) $countryCode;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}
