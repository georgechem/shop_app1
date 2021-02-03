<?php

namespace App\Controller;

use Google\Client;
use Google_Service_Books;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/googleBooks/{query}/{start}/{max}", name="app_google_books", requirements={"query"="[a-zA-Z0-9]+", "start"="\d+", "max"="\d{1,2}"}, methods={"GET"})
     *
     *
     *
     *
     */
    public function index(Request $request): JsonResponse
    {
        $route_params = $request->attributes->get('_route_params');

        $client = new Client();
        $client->setAuthConfig('../credentials.json');
        $client->addScope(Google_Service_Books::BOOKS);

        $service = new Google_Service_Books($client);

        $query = $route_params['query'];

        $optParams = array(
            'startIndex' => $route_params['start'],
            'maxResults' => $route_params['max'],
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
