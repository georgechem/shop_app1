<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/googleBooks", name="app_google_books")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse('api');
    }
}
