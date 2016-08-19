<?php

namespace Contacts\Application\Contact;

use Contacts\Domain\Contact\ContactId;

class ProposeContact
{
    /**
     * @var ContactId
     */
    private $contactId;

    /**
     * @var array
     */
    private $fieldValues;

    public function __construct(ContactId $contactId, array $fieldValues)
    {
        $this->contactId = $contactId;
        $this->fieldValues = $fieldValues;
    }

    /**
     * @return ContactId
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @return array
     */
    public function getFieldValues()
    {
        return $this->fieldValues;
    }
}
