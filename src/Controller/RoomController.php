<?php

namespace App\Controller;

use App\Entity\BOOKING;
use App\Form\BookingType;
use Pagerfanta\Pagerfanta;
use App\Entity\NOTIFICATION;
use App\Repository\ROOMRepository;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Symfony\Bundle\SecurityBundle\Security;
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
    public function show($id , ROOMRepository $rooms, Request $request, Security $security, EntityManagerInterface $em): Response
    {

        $room = $rooms->findOneBy(['id' => $id]);
        $booking = new BOOKING();

        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Vérifier si utilisateur est connecté
            $user = $security->getUser();

            // s'il n'est pas connecté rediriger sur 'app_login'
            if(!$user){
                return $this->redirectToRoute('app_login');
            }
            // Sinon calculer le billing = (check_in_at - check_out_at)+1 * room.price
            // Récupérer les dates d'entrée et de sortie du formulaire
            $checkInAt = $form->get('check_in_at')->getData();
            $checkOutAt = $form->get('check_out_at')->getData();

            // Calculer la différence entre les dates (en jours)
            $interval = $checkOutAt->diff($checkInAt)->days + 1; // Ajouter 1 pour inclure le jour de départ

            // Calculer le montant total
            $billing = $interval * $room->getPrice();
            
            // et enregistrer le nouveau booking
            $booking->setUserId($user);
            $booking->setRoomId($room);
            $booking->setBilling($billing);

            // Création d'une notification
            $notification = new NOTIFICATION();
            $notification->setTitle('Nouvelle réservation')
                ->setContent('Votre réservation pour la chambre ' . $room->getTitle() . ' a été effectuée avec succès.')
                ->setLabel('booking')
                ->setBookingId($booking); // Lier la notification à la réservation

            // Persister la notification et le booking
            $em->persist($notification);
            $em->persist($booking);
            $em->flush();

            $this->addFlash(
                'success',
                'Votre demande de réservation a bien été enregistré.'
            );

            // return $this->redirectToRoute('app_payment');
        }
      
        return $this->render('room/show.html.twig', [
            'BookingForm' => $form,
             'room'=>$room
        ]);
    }
}
