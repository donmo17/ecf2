<?php

namespace App\Twig\Components;

use App\Repository\ROOMRepository;
use DateTime;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('SearchRoom', template: 'components/SearchRoom.html.twig')]
class SearchRoom
{
    use DefaultActionTrait;

    #[LiveProp(writable: true, url: true)]
    public ?string $query = null;

    #[LiveProp(writable: true, url: true)]
    public ?string $city = null;

    #[LiveProp(writable: true, url: true)]
    public ?int $capacityMin = null;

    #[LiveProp(writable: true, url: true)]
    public ?int $capacityMax = null;

    #[LiveProp(writable: true, url: true)]
    public ?string $ergonomics = null; // Garder comme une chaîne de caractères

    #[LiveProp(writable: true, url: true)]
    public ?string $equipment = null; // Equipement

    #[LiveProp(writable: true, url: true)]
    public ?DateTime $checkIn = null;

    #[LiveProp(writable: true, url: true)]
    public ?DateTime $checkOut = null;

    public function __construct(private ROOMRepository $Rooms) {
        
    }


    public function getRooms(): array
    {
  
        if ($this->query) {
            return $this->Rooms->findByQuery($this->query);
        }
       
        if ($this->checkIn || $this->checkOut) {
            return $this->Rooms->findByDate($this->checkIn, $this->checkOut);
        }

        if ($this->city) {
            return $this->Rooms->findByCity($this->city);
        }

        if ($this->ergonomics) {
            return $this->Rooms->findByErgonomic($this->ergonomics);
        }
        if ($this->equipment) {
            return $this->Rooms->findByEquipment($this->equipment);
        }

        if ($this->capacityMin || $this->capacityMax || $this->city  ) {
            return $this->Rooms->findByRange($this->capacityMin, $this->capacityMax,$this->city);
        }    


        return $this->Rooms->findAll();
    }


}
