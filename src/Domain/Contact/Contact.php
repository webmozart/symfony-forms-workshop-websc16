<?php

namespace Contacts\Domain\Contact;

use Contacts\Domain\Organization\OrganizationId;
use Contacts\Domain\Value\Address;
use Contacts\Domain\Value\Email;
use Contacts\Domain\Value\PhoneNumber;
use DateTimeInterface;
use MongoDB\Driver\Exception\InvalidArgumentException;

class Contact
{
    const FIELD_FIRST_NAME = 'firstName';

    const FIELD_LAST_NAME = 'lastName';

    const FIELD_DATE_OF_BIRTH = 'dateOfBirth';

    const FIELD_EMAIL = 'email';

    const FIELD_ADDRESS = 'address';

    const FIELD_PHONE_NUMBER = 'phoneNumber';

    const FIELD_NOTES = 'notes';

    const FIELD_ORGANIZATION_ID = 'organizationId';

    /**
     * @var ContactId
     */
    private $id;

    /**
     * @var int
     */
    private $approved = false;

    /**
     * @var ContactId[]
     */
    private $mergedIds = [];

    /**
     * @var OrganizationId
     */
    private $organizationId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var DateTimeInterface
     */
    private $dateOfBirth;

    /**
     * @var Email|null
     */
    private $email;

    /**
     * @var Address|null
     */
    private $address;

    /**
     * @var PhoneNumber|null
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $notes;

    public static function propose(ContactId $contactId, array $fieldValues)
    {
        $contact = new self($contactId);
        $contact->modify($fieldValues);

        return $contact;
    }

    public function approve()
    {
        $this->approved = true;
    }

    public function modify(array $fieldValues)
    {
        foreach ($fieldValues as $fieldName => $fieldValue) {
            $methodName = 'modify'.ucfirst($fieldName);

            if (!method_exists($this, $methodName)) {
                throw new InvalidArgumentException(sprintf(
                    'Cannot modify the field "%s".',
                    $fieldName
                ));
            }

            $this->$methodName($fieldValue);
        }
    }

    public function merge(ContactId $contactId, array $fieldValues)
    {
        $this->modify($fieldValues);

        if (!in_array($contactId, $this->mergedIds)) {
            $this->mergedIds[] = $contactId;
        }
    }

    /**
     * @return ContactId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return trim($this->firstName.' '.$this->lastName);
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return Email|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return Address|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return PhoneNumber|null
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @return OrganizationId
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * @param ContactId $id
     */
    private function __construct(ContactId $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $firstName
     */
    private function modifyFirstName($firstName)
    {
        $this->firstName = (string) $firstName;
    }

    /**
     * @param string $lastName
     */
    private function modifyLastName($lastName)
    {
        $this->lastName = (string) $lastName;
    }

    /**
     * @param DateTimeInterface $dateOfBirth
     */
    private function modifyDateOfBirth(DateTimeInterface $dateOfBirth = null)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @param Email|null $email
     */
    private function modifyEmail(Email $email = null)
    {
        $this->email = $email;
    }

    /**
     * @param Address|null $address
     */
    private function modifyAddress(Address $address = null)
    {
        $this->address = $address;
    }

    /**
     * @param PhoneNumber|null $phoneNumber
     */
    private function modifyPhoneNumber(PhoneNumber $phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @param string $notes
     */
    private function modifyNotes($notes)
    {
        $this->notes = $notes ? (string) $notes : null;
    }

    /**
     * @param OrganizationId $organizationId
     */
    private function modifyOrganizationId(OrganizationId $organizationId = null)
    {
        $this->organizationId = $organizationId;
    }
}
