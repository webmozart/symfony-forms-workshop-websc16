<?php

namespace Contacts\Domain\Organization;

use Contacts\Domain\Value\Address;
use Contacts\Domain\Value\Email;
use Contacts\Domain\Value\PhoneNumber;

class Organization
{
    /**
     * @var OrganizationId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var PhoneNumber
     */
    private $phoneNumber;

    /**
     * @var Address
     */
    private $address;

    /**
     * @param OrganizationId $id
     */
    public function __construct(OrganizationId $id)
    {
        $this->id = $id;
    }

    /**
     * @return OrganizationId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param PhoneNumber $phoneNumber
     */
    public function setPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }
}
