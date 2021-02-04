<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\CategoryExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $results = $categories->getMainCategories();

        $books = [];
        for($i = 0; $i < count($results); $i++){
            $books[] = $repository->getBooksByCategory(1, 1, $results[$i]);
        }
        foreach($books as $key => $book){
            if($key == 5){
                foreach ($book as $item){

                    //dd($item);
                }
            }

        }


        return $this->render('pages/homepage.html.twig', [
            'categories' => $results,
        ]);
    }

    /**
     * @Route("/categorySelected/{number}", name="app_category_selected", requirements={"number"="[0-9]+"})
     */
    public function category(Request $request, BookRepository $repository):Response
    {
        $route_params = $request->attributes->get('_route_params');
        $category_number = $route_params['number'];

        $raw_data = $repository->getCategories();
        $categories = new CategoryExtractor($raw_data);
        $results = $categories->getMainCategories();

        $books = $repository->getBooksByCategory(1, 1, $results[$category_number]);


        return $this->render('pages/category.html.twig', [
            'paginator' => $books
        ]);
    }
}
