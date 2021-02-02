<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/googleBooks", name="app_google_books", methods={"GET", "HEAD"})
     */
    public function index(): JsonResponse
    {
        $client = new \Google\Client();
        $client->setAuthConfig('../credentials.json');
        $client->addScope(\Google_Service_Books::BOOKS);

        $service = new \Google_Service_Books($client);

        $query = 'php';

        $optParams = array(
            'startIndex' => 1,
            'maxResults' => 1,
            'filter'=>'ebooks'
        );
        $results = $service->volumes->listVolumes($query, $optParams);
        $data = [];

        foreach ($results->items as $result){
            $data[] = $result->selfLink;
        }

        $opts = array(
            'http'=>array(
                'method'=>"GET",
            )
        );
        $context = stream_context_create($opts);
        $test = [];
        foreach ($data as $part){
            $test[] = json_decode(file_get_contents($part, false, $context), false, 512);

        }

        return new JsonResponse($test);
    }
}
