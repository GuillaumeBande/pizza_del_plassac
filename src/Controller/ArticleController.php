<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'title' => "Pizza Del Plassac",
            'bienvenue' => "Bienvenue !"
        ]);

    }
    /**
     * @Route("/article/list", name="articleList")
     */
    public function articleList(): Response
    {
        return $this->render('article/articleList.html.twig', [
            'title' => "La carte",

        ]);

    }
    /**
     * @Route("contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('article/contact.html.twig', [
            'title' => "Contact",

        ]);

    }
    /**
     * @Route("/restaurant", name="restaurant")
     */
    public function restaurant(): Response
    {
        return $this->render('article/restaurant.html.twig', [
            'title' => "Restaurant",

        ]);

    }
    /**
     * @Route("/reservation", name="reservation")
     */
    public function reservation(): Response
    {
        return $this->render('article/reservation.html.twig', [
            'title' => "Réservation",

        ]);

    }
}
