<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
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

        $books = $repository->getBooksByCategory(0, 10, $results[$category_number]);

        return $this->render('pages/category.html.twig', [
            'paginator' => $books,
            'category' => $results[$category_number],
        ]);
    }

    /**
     * @Route("/contactUs", name="app_contact_us")
     */
    public function contactUs(): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
