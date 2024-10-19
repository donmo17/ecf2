<?php

namespace App\Controller;

use App\Repository\BOOKINGRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile_index')]
    public function index(Security $security, BOOKINGRepository $bookingRepository): Response
    {
        // récupérer l'utilisateur
        $user = $security->getUser();

            // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer les 6 dernières réservations les plus récentes de l'utilisateur
        $recentBookings = $bookingRepository->findBy(
            ['user_id' => $user],
            ['created_at' => 'DESC'],  // Trier par date de création décroissante
            6  // Limiter à 6 résultats
        );

        // Récupérer les notifications associées aux réservations
        $recentNotifications = [];
        foreach ($recentBookings as $booking) {
            // Récupérer les notifications liées à chaque réservation
            foreach ($booking->getNotifications() as $notification) {
                $recentNotifications[] = $notification;
            }
        }

        // Limiter à 6 notifications récentes (en fonction de l'ordre d'ajout)
        $recentNotifications = array_slice($recentNotifications, 0, 6);
           
        
        return $this->render('profile/index.html.twig', [
            'recentBookings' => $recentBookings,
            'recentNotifications' => $recentNotifications,
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
    public function notification(Security $security, BOOKINGRepository $bookingRepository): Response
    {
        // récupérer l'utilisateur
        $user = $security->getUser();

            // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupérer les réservations de l'utilisateur
        $bookings = $bookingRepository->findBy(
            ['user_id' => $user],
        );

        // Récupérer les notifications associées aux réservations
        $notifications = [];
        foreach ($bookings as $booking) {
            // Récupérer les notifications liées à chaque réservation
            foreach ($booking->getNotifications() as $notification) {
                $notifications[] = $notification;
            }
        }

        return $this->render('profile/notification.html.twig', [
            'notifications' => $notifications,
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
