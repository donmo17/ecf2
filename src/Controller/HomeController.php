<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_home', requirements: ['_locale' => 'en|fr|es'], defaults: ['_locale' => 'fr'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
}