<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile_index')]
    public function index(): Response
    {

         
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/booking', name: 'app_profile_booking')]
    public function booking(): Response
    {
        return $this->render('profile/booking.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/notification', name: 'app_profile_notification')]
    public function notification(): Response
    {
        return $this->render('profile/notification.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    public function edit(  ): Response
    {
   
        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }


    
}
