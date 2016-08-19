<?php

namespace Contacts\Infrastructure\Web\Controller;

use Contacts\Application\Contact\DeleteContact;
use Contacts\Domain\Contact\ContactId;
use Contacts\Infrastructure\Web\Form\ModifyContactType;
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

        return $this->render('contact/list.html.twig', [
            'contacts' => $contacts,
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
     * @Route("/{id}/modify", name="contact_modify")
     */
    public function modifyAction(Request $request, $id)
    {
        $contact = $this->get('contact_repository')->get(ContactId::fromString($id));

        $form = $this->createForm(ModifyContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command_bus')->handle($form->getData());

            return $this->redirectToRoute('contact_list');
        }

        return $this->render('contact/modify.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
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
