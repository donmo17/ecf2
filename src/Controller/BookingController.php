<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    // https://symfony.com/doc/current/security/csrf.html
    #[Route('/booking', name: 'app_booking_new', methods:['POST'])]
    public function index(Request $request): Response
    {
        $submittedToken = $request->getPayload()->get('token');

        // 'new_booking' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('new_booking', $submittedToken)) {
            // ... do something, like deleting an object
        }
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }
}
