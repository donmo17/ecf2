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

    public function __construct(private ROOMRepository $Rooms) {}

    public function getRooms(): array
    {
        if ($this->query) {
            return $this->Rooms->findByQuery($this->query);
        }
        return $this->Rooms->findAll();
    }
}
