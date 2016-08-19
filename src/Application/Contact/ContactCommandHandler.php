<?php

namespace Contacts\Application\Contact;

use Contacts\Domain\Contact\Contact;
use Contacts\Domain\Contact\ContactRepository;

class ContactCommandHandler
{
    /**
     * @var ContactRepository
     */
    private $repo;

    /**
     * @param ContactRepository $repo
     */
    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
    }

    public function handleProposeContact(ProposeContact $command)
    {
        $contact = Contact::propose($command->getContactId(), $command->getFieldValues());

        $this->repo->add($contact);
    }

    public function handleApproveContact(ApproveContact $command)
    {
        $contact = $this->repo->get($command->getContactId());

        $contact->approve();

        $this->repo->flush();
    }

    public function handleRejectContact(RejectContact $command)
    {
        $this->repo->delete($command->getContactId());
    }

    public function handleModifyContact(ModifyContact $command)
    {
        $contact = $this->repo->get($command->getContactId());

        $contact->modify($command->getFieldValues());

        $this->repo->flush();
    }

    public function handleMergeContacts(MergeContacts $command)
    {
        $targetContact = $this->repo->get($command->getTargetContactId());

        $targetContact->merge($command->getSourceContactId(), $command->getSourceFieldValues());

        $this->repo->delete($command->getSourceContactId());
        $this->repo->flush();
    }

    public function handleDeleteContact(DeleteContact $command)
    {
        $this->repo->delete($command->getContactId());
    }
}
