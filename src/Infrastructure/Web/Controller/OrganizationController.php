<?php

namespace Contacts\Infrastructure\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
