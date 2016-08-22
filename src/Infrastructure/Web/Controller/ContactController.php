<?php

namespace Contacts\Infrastructure\Web\Controller;

use Contacts\Application\Contact\DeleteContact;
use Contacts\Domain\Contact\ContactId;
use Contacts\Infrastructure\Util\ObjectArray;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/contacts")
 */
class ContactController extends Controller
{
    /**
     * @Route("/", name="contact_list")
     */
    public function listAction()
    {
        $contacts = $this->get('contact_repository')->findApproved();

        $organizationNames = $this->get('organization_repository')->findNames(
            array_unique(ObjectArray::map('getOrganizationId', $contacts))
        );

        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts,
            'organizationNames' => $organizationNames,
        ]);
    }

    /**
     * @Route("/{id}", name="contact_show")
     */
    public function showAction($id)
    {
        return $this->render('contact/show.html.twig', [
            'contact' => $this->get('contact_repository')->get(ContactId::fromString($id)),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contact_edit")
     */
    public function editAction(Request $request, $id)
    {
        $contact = $this->get('contact_repository')->get(ContactId::fromString($id));

        // TODO create form and pass to view

        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="contact_delete")
     */
    public function deleteAction($id)
    {
        $this->get('command_bus')->handle(
            new DeleteContact(ContactId::fromString($id))
        );

        return $this->redirectToRoute('contact_list');
    }
}
