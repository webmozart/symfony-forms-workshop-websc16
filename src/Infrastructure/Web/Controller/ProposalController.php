<?php

namespace Contacts\Infrastructure\Web\Controller;

use Contacts\Application\Contact\ApproveContact;
use Contacts\Application\Contact\RejectContact;
use Contacts\Domain\Contact\ContactId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/proposals")
 */
class ProposalController extends Controller
{
    /**
     * @Route("/", name="proposal_list")
     */
    public function listAction()
    {
        $contacts = $this->get('contact_repository')->findProposed();

        return $this->render('proposal/list.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/propose", name="proposal_propose")
     */
    public function proposeAction(Request $request)
    {
        // TODO create form and pass to view

        return $this->render('proposal/propose.html.twig', [
        ]);
    }

    /**
     * @Route("/{id}", name="proposal_show")
     */
    public function showAction($id)
    {
        $contact = $this->get('contact_repository')->get(ContactId::fromString($id));

        return $this->render('proposal/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    /**
     * @Route("/{id}/approve", name="proposal_approve")
     */
    public function approveAction($id)
    {
        $this->get('command_bus')->handle(
            new ApproveContact(ContactId::fromString($id))
        );

        return $this->redirectToRoute('proposal_list');
    }

    /**
     * @Route("/{id}/reject", name="proposal_reject")
     */
    public function rejectAction($id)
    {
        $this->get('command_bus')->handle(
            new RejectContact(ContactId::fromString($id))
        );

        return $this->redirectToRoute('proposal_list');
    }
}
