<?php


namespace App\Enum;


enum BookingStatus: string
{
    case Pending = 'en attente';
    case Booked = 'réservé';
    case Cancelled = 'annulé';
    case Declined = 'refusé';
    case Completed = 'terminé';


    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'En attente',
            self::Booked => 'Réservé',
            self::Cancelled => 'Annulé',
            self::Declined => 'Refusé',
            self::Completed => 'Terminé',
        };
    }
}


