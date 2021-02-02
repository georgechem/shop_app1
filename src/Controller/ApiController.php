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

        $query = 'book';

        $optParams = array(
            'startIndex' => 1,
            'maxResults' => 1,
            'filter'=>'ebooks'
        );
        $results = $service->volumes->listVolumes($query, $optParams);
        $data =null;
        if(true){
            $data = $results->items[0]->selfLink;
        }else{
            $data = $results;
        }

        $opts = array(
            'http'=>array(
                'method'=>"GET",
            )
        );
        $context = stream_context_create($opts);

        $test = file_get_contents($data, false, $context);

        return new JsonResponse(json_decode($test));
    }
}
