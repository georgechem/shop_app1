<?php

namespace App\Controller;

use App\Entity\Book;
use Google\Client;
use Google_Service_Books;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/googleBooks/{start}/{max}/{query}", name="app_google_books", requirements={"query"="[a-zA-Z0-9?=\+\-]+",
     *     "start"="\d+", "max"="\d{1,2}"}, methods={"GET"})
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
        /**
         * Write here writing data to database and save files to certain location
         */
        //dd($test[0]->volumeInfo->industryIdentifiers[1]->identifier);
        foreach($test as $volume){
            $book = new Book();
            $book->setBookId($volume->id);
            $book->setEtag($volume->etag ?? 'no_etag');
            $book->setSelfLink($volume->selfLink ?? 'https://');
            $book->setEpub($volume->accessInfo->epub->isAvailable ?? 'false');
            $book->setPdf($volume->accessInfo->pdf->isAvailable ?? 'false');
            $book->setPrice($volume->saleInfo->listPrice->amount ?? 0.0);
            $book->setCurrencyCode($volume->saleInfo->listPrice->currencyCode ?? 'EUR');
            $book->setBuyLink($volume->saleInfo->buyLink ?? 'https://');

            dd($volume);
            $title = $volume->id;
            $url = $volume->volumeInfo->imageLinks->thumbnail ?? 'noSmallImage';
            if ($url === 'noSmallImage'){
                continue;
            }
            $file = file_get_contents($url, false, $context);
            file_put_contents("books/".$title.".png", $file, 0, $context);
        }
        //$title = $test[0]->volumeInfo->industryIdentifiers[1]->identifier;
        //$url = $test[0]->volumeInfo->imageLinks->small;
        //$file = file_get_contents($url, false, $context);
        //file_put_contents("books/".$title.".png", $file, 0, $context);

        return new JsonResponse($test);
    }
}
