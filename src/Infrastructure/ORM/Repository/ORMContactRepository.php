<?php

namespace Contacts\Infrastructure\ORM\Repository;

use Contacts\Domain\Contact\Contact;
use Contacts\Domain\Contact\ContactId;
use Contacts\Domain\Contact\ContactRepository;

class ORMContactRepository extends ORMRepository implements ContactRepository
{
    public function add(Contact $contact)
    {
        $this->doAdd($contact);
    }

    /**
     * @param ContactId $contactId
     *
     * @return Contact
     */
    public function get(ContactId $contactId)
    {
        return $this->doGet($contactId);
    }

    public function findProposed()
    {
        return $this->findBy(['approved' => false]);
    }

    public function findApproved()
    {
        return $this->findBy(['approved' => true]);
    }

    public function delete(ContactId $contactId)
    {
        return $this->doDelete($contactId);
    }
}
