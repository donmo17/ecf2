<?php

namespace App\Controller;

use App\Repository\ROOMRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'app_room')]
    public function index(): Response
    {
        return $this->render('room/index.html.twig', [
            'controller_name' => 'RoomController',
        ]);
    }


    #[Route('/room/show/{id}', name: 'app_room_show')]
    public function show( $id , ROOMRepository $rooms): Response
    {
        $room = $rooms->findOneBy(['id' => $id]);        

      
        return $this->render('room/show.html.twig', [
            'controller_name' => 'RoomController',
             'room'=>$room
        ]);
    }
}
