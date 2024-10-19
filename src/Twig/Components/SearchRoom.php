<?php

namespace App\Twig\Components;

use App\Repository\ROOMRepository;
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
    public ?string $capacityMin = null;

    #[LiveProp(writable: true, url: true)]
    public ?string $capacityMax = null;

    #[LiveProp(writable: true, url: true)]
    public ?string $ergonomics = null; // Garder comme une chaîne de caractères

    #[LiveProp(writable: true, url: true)]
    public ?string $equipment = null; // Equipement

    

    public function __construct(private ROOMRepository $Rooms) {
        
    }

    public function getRooms(): array
    {
        if ($this->query) {
            return $this->Rooms->findByQuery($this->query);
        }
        if ($this->city) {
            return $this->Rooms->findByCity($this->city);
        }
        if ($this->capacityMin ) {
            return $this->Rooms->findByCapacityMin($this->capacityMin);
        }
         if ($this->capacityMax) {
             return $this->Rooms->findByCapacityMax($this->capacityMax);
         }

        if ($this->ergonomics) {
            return $this->Rooms->findByErgonomic($this->ergonomics);
        }
        if ($this->equipment) {
            return $this->Rooms->findByEquipment($this->equipment);
        }

        return $this->Rooms->findAll();
    }


}
