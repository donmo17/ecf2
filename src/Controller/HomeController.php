<?php

namespace App\Controller;

use App\Repository\ROOMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ROOMRepository $rooms): Response

    {
         $room  = $rooms->findAll() ;
        return $this->render('home/index.html.twig', [
             'rooms' => $room 
        ]);
    }
}
