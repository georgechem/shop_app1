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
        $client = new \Google\Client();
        $client->setAuthConfig('../credentials.json');
        $client->addScope(\Google_Service_Books::BOOKS);

        $service = new \Google_Service_Books($client);

        $query = 'php';

        $optParams = array(
            'maxResults' => 1,
        );
        $results = $service->volumes->listVolumes($query, $optParams);


        return new JsonResponse($results);
    }
}
