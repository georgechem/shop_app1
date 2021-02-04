<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\CategoryExtractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/category", name="app_category")
     */
    public function index(BookRepository $repository): Response
    {
        $raw_data = $repository->getCategories();
        $categories = new CategoryExtractor($raw_data);
        $results = $categories->getMainCategories();

        $books = [];
        for ($i = 0; $i < count($results); $i++){
            $books[] = $repository->getBooksByCategory(1, 4, $results[$i]);
        }

        return $this->render('product/category.html.twig', [
            'categories' => $books,
            'category_list'=>$results,
        ]);
    }

    /**
     * @Route("/product/{id}", name="app_product", requirements={"id"="[a-zA-Z0-9\-\+_]+"})
     */
    public function productId():Response
    {

        return $this->render('product/product_id.html.twig',[]);
    }
}
