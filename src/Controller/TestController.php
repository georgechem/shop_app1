<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\CategoryExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(BookRepository $repository): Response
    {

        $raw_data = $repository->getCategories();
        $categories = new CategoryExtractor($raw_data);
        $results = $categories->getMainCategories();

        return $this->render('test/test.html.twig', [
            'categories' => $results,
        ]);
    }
}
