<?php

namespace App\Controller;

use App\Entity\BOOKING;
use App\Form\BookingType;
use Pagerfanta\Pagerfanta;
use App\Repository\ROOMRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'app_room', methods:['GET'])]
    public function index(Request $request, ROOMRepository $repo): Response
    {
        // Si je récupère un 'city' dans la requête
        // if ($request->query->has('city')) {
        //     // Récupérer la ville de la requête
        //     $city = $request->query->get('city');

        //     // Requête filtrée par la ville avec ton repository
        //     $rooms = Pagerfanta::createForCurrentPageWithMaxPerPage(
        //         new QueryAdapter($repo->findByCity($city)),  // Appelle la méthode 'findByCity' avec la ville récupérée
        //         $request->query->get('page', 1),
        //         10
        //     );
        // } else {
        //     // Sinon récupérer toutes les rooms
        //     $rooms = Pagerfanta::createForCurrentPageWithMaxPerPage(
        //         new QueryAdapter($repo->createQueryBuilder('b')),  // Requête sans filtre
        //         $request->query->get('page', 1),
        //         10
        //     );
        // }

        return $this->render('room/index.html.twig', [
            // 'rooms' => $rooms,
        ]);
    }


    #[Route('/room/show/{id}', name: 'app_room_show', methods: ['GET', 'POST'])]
    public function show($id , ROOMRepository $rooms, Request $request): Response
    {

        $room = $rooms->findOneBy(['id' => $id]);
        $booking = new BOOKING();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }
      
        return $this->render('room/show.html.twig', [
            'BookingForm' => $form,
             'room'=>$room
        ]);
    }
}
