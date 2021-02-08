<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/adminPanel", name="app_admin_panel")
     */
    public function index(): Response
    {
        $links = [['link_1'],['link_2'], ['link_3']];

        return $this->render('admin/index.html.twig', [
            'links' => $links,
        ]);
    }
}
