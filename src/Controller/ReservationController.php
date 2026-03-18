<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Event;

use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation', methods: ['PUT'])]
    public function index(Event $event, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException('Você precisa estar logado para fazer uma reserva.');
        }

        $reservation = new Reservation();
        $reservation->setUser($user);
        $reservation->setEvent($event);
        $reservation->setCreatedAt(new \DateTimeImmutable());

        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_event_show', ['id' => $event->getId()]);
    }
}