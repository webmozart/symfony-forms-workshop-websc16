<?php

namespace Contacts\Domain\Contact;

interface ContactRepository
{
    public function add(Contact $contact);

    /**
     * @param ContactId $contactId
     *
     * @return Contact
     */
    public function get(ContactId $contactId);

    /**
     * @return Contact[]
     */
    public function findProposed();

    /**
     * @return Contact[]
     */
    public function findApproved();

    public function delete(ContactId $contactId);

    public function flush();
}
