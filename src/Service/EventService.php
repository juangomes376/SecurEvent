<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\User;

class EventService
{
    public function isEventReservedByUser(Event $event, ?User $user): bool
    {
        if (!$user) {
            return false;
        }

        foreach ($event->getReservations() as $reservation) {
            if ($reservation->getUser() === $user) {
                return true;
            }
        }

        return false;

    }

    public function placesRestantes(Event $event): int
    {
        $capaciteMax = $event->getCapaciteMax();
        $reservationsCount = count($event->getReservations());
        return max(0, $capaciteMax - $reservationsCount);
    }

    public function getParticipants(Event $event): array
    {
        $participants = [];
        foreach ($event->getReservations() as $reservation) {
            $participants[] = $reservation->getUser();
        }
        return $participants;
    }

    public function PlaceDisponible(Event $event): bool
    {
        return $this->placesRestantes($event) > 0;
    }

    public function findAllEventsByCategory($category, $eventRepository): array
    {
        return $eventRepository->findBy(['idCategorie' => $category]);
    }




    
}