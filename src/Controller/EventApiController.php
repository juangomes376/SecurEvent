<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Service\EventService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class EventApiController extends AbstractController
{
    #[Route('/events', name: 'app_api_events', methods: ['GET'])]
    public function index(EventRepository $eventRepository, EventService $eventService): Response
    {
        $eventsComplete = $eventRepository->findAll();
        $events = [];
        foreach ($eventsComplete as $event) {

            $e = [
                'titre' => $event->getTitre(),
                'description' => $event->getDescription(),
                'dateDebut' => $event->getDateDebut()->format('Y-m-d H:i:s'),
                'capaciteMax' => $event->getCapaciteMax(),
                'placesRestantes' => $eventService->placesRestantes($event),
            ];
            $events[] = $e;
        }

        return $this->json($events);
    }
}