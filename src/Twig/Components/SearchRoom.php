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

    public function __construct(private ROOMRepository $Rooms) {}

    public function getRooms(): array
    {
        if ($this->query) {
            return $this->Rooms->findByQuery($this->query);
        }
        if ($this->city) {
            return $this->Rooms->findByCity($this->city);
        }
        if ($this->capacityMin || $this->capacityMax) {
            return $this->Rooms->findRoomsByCapacity($this->capacityMin, $this->capacityMax);
        }
        // if ($this->capacityMax) {
        //     return $this->Rooms->findByCapacityMax($this->capacityMax);
        // }

        return $this->Rooms->findAll();
    }


}
