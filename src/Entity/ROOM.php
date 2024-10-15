<?php

namespace App\Entity;

use App\Repository\ROOMRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ROOMRepository::class)]
class ROOM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 100)]
    private ?string $city = null;

    #[ORM\Column(length: 5)]
    private ?string $zipcode = null;

    #[ORM\Column]
    private ?int $capacity_min = null;

    #[ORM\Column(length: 5)]
    private ?string $capacity_max = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $ergonomic = [];

    #[ORM\Column(type: Types::ARRAY)]
    private array $equipment = [];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

   

    /**
     * @var Collection<int, BOOKING>
     */
    #[ORM\OneToMany(targetEntity: BOOKING::class, mappedBy: 'room_id')]
    private Collection $bOOKINGs;

    public function __construct()
    {
        $this->bOOKINGs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCapacityMin(): ?int
    {
        return $this->capacity_min;
    }

    public function setCapacityMin(int $capacity_min): static
    {
        $this->capacity_min = $capacity_min;

        return $this;
    }

    public function getCapacityMax(): ?string
    {
        return $this->capacity_max;
    }

    public function setCapacityMax(string $capacity_max): static
    {
        $this->capacity_max = $capacity_max;

        return $this;
    }

    public function getErgonomic(): array
    {
        return $this->ergonomic;
    }

    public function setErgonomic(array $ergonomic): static
    {
        $this->ergonomic = $ergonomic;

        return $this;
    }

    public function getEquipment(): array
    {
        return $this->equipment;
    }

    public function setEquipment(array $equipment): static
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }


    /**
     * @return Collection<int, BOOKING>
     */
    public function getBOOKINGs(): Collection
    {
        return $this->bOOKINGs;
    }

    public function addBOOKING(BOOKING $bOOKING): static
    {
        if (!$this->bOOKINGs->contains($bOOKING)) {
            $this->bOOKINGs->add($bOOKING);
            $bOOKING->setRoomId($this);
        }

        return $this;
    }

    public function removeBOOKING(BOOKING $bOOKING): static
    {
        if ($this->bOOKINGs->removeElement($bOOKING)) {
            // set the owning side to null (unless already changed)
            if ($bOOKING->getRoomId() === $this) {
                $bOOKING->setRoomId(null);
            }
        }

        return $this;
    }

}
