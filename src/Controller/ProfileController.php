<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

         
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/bookings', name: 'app_profbooking')]
    public function profbooking(): Response
    {
        return $this->render('profile/booking.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
    
    #[Route('/profile/edit', name: 'app_profiledit')]
    public function profiledit(  ): Response
    {
   


     
        

        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


    
}
