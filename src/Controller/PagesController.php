<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\CategoryExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(BookRepository $repository): Response
    {
        $raw_data = $repository->getCategories();

        $categories = new CategoryExtractor($raw_data);

        dd($categories);

        $test = 1;

        return $this->render('pages/homepage.html.twig', [
            'test' => $test,
        ]);
    }
}
