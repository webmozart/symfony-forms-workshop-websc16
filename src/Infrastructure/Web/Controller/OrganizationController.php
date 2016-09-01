<?php

namespace Contacts\Infrastructure\Web\Controller;

use Contacts\Domain\Organization\OrganizationId;
use Contacts\Infrastructure\Web\Form\OrganizationType;
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
        $form = $this->createForm(OrganizationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('organization_repository')->add($form->getData());

            return $this->redirectToRoute('organization_list');
        }

        return $this->render('organization/create.html.twig', [
            'form' => $form->createView(),
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

        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('organization_repository')->flush();

            return $this->redirectToRoute('organization_list');
        }

        return $this->render('organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form->createView(),
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
