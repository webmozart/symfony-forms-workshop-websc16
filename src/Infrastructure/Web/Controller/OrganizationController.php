<?php

namespace Contacts\Infrastructure\Web\Controller;

use Contacts\Domain\Organization\OrganizationId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/organizations")
 */
class OrganizationController extends Controller
{
    /**
     * @Route("/", name="organization_list")
     */
    public function listAction()
    {
        $organizations = $this->get('organization_repository')->findAll();

        return $this->render('organization/list.html.twig', [
            'organizations' => $organizations,
        ]);
    }

    /**
     * @Route("/create", name="organization_create")
     */
    public function createAction(Request $request)
    {
        // TODO create form and pass to view

        return $this->render('organization/create.html.twig', [
        ]);
    }

    /**
     * @Route("/{id}", name="organization_show")
     */
    public function showAction(Request $request, $id)
    {
        $organization = $this->get('organization_repository')->get(OrganizationId::fromString($id));

        return $this->render('organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="organization_edit")
     */
    public function editAction(Request $request, $id)
    {
        $organization = $this->get('organization_repository')->get(OrganizationId::fromString($id));

        // TODO create form and pass to view

        return $this->render('organization/edit.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="organization_delete")
     */
    public function deleteAction($id)
    {
        $this->get('organization_repository')->delete(OrganizationId::fromString($id));

        return $this->redirectToRoute('organization_list');
    }
}
