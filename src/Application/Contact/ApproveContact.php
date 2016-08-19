<?php

namespace Contacts\Application\Contact;

use Contacts\Domain\Contact\ContactId;

class ApproveContact
{
    /**
     * @var ContactId
     */
    private $contactId;

    /**
     * @param ContactId $contactId
     */
    public function __construct(ContactId $contactId)
    {
        $this->contactId = $contactId;
    }

    /**
     * @return ContactId
     */
    public function getContactId()
    {
        return $this->contactId;
    }
}
