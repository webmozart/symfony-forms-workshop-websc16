<?php

namespace Contacts\Application\Contact;

use Contacts\Domain\Contact\ContactId;

class MergeContacts
{
    /**
     * @var ContactId
     */
    private $sourceContactId;

    /**
     * @var array
     */
    private $sourceFieldValues;

    /**
     * @var ContactId
     */
    private $targetContactId;

    /**
     * @param ContactId $sourceContactId
     * @param array     $sourceFieldValues
     * @param ContactId $targetContactId
     */
    public function __construct(ContactId $sourceContactId, array $sourceFieldValues, ContactId $targetContactId)
    {
        $this->sourceContactId = $sourceContactId;
        $this->sourceFieldValues = $sourceFieldValues;
        $this->targetContactId = $targetContactId;
    }

    /**
     * @return ContactId
     */
    public function getSourceContactId()
    {
        return $this->sourceContactId;
    }

    /**
     * @return array
     */
    public function getSourceFieldValues()
    {
        return $this->sourceFieldValues;
    }

    /**
     * @return ContactId
     */
    public function getTargetContactId()
    {
        return $this->targetContactId;
    }
}
