<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EventRepository $eventRepository): Response
    {
        $today = new \DateTimeImmutable('today');

        $events = $eventRepository
            ->createQueryBuilder('e')
            ->andWhere('e.isPublished = :published')
            ->andWhere('e.dateDebut >= :today')
            ->setParameter('published', true)
            ->setParameter('today', $today)
            ->orderBy('e.dateDebut', 'ASC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();

        return $this->render('home/index.html.twig', [
            'events' => $events,
        ]);
    }
}