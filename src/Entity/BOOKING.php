<?php

namespace App\Entity;

use App\Enum\BookingStatus;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BOOKINGRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: BOOKINGRepository::class)]
class BOOKING
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ROOM $room_id = null;

    

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?bool $is_validate = null;

    #[ORM\Column]
    private ?float $billing = null;

    #[ORM\Column(length: 255)]
    private ?BookingStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $check_in_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $check_out_at = null;

    /**
     * @var Collection<int, NOTIFICATION>
     */
    #[ORM\OneToMany(targetEntity: NOTIFICATION::class, mappedBy: 'booking_id')]
    private Collection $nOTIFICATIONs;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    private ?User $user_id = null;


    public function __construct()
    {
        $this->nOTIFICATIONs = new ArrayCollection();
        $this->status = BookingStatus::Pending; // Ajout de l'initialisation

        $this->is_validate = false;
        $this->status = BookingStatus::Pending; // Correction ici
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?ROOM
    {
        return $this->room_id;
    }

    public function setRoomId(?ROOM $room_id): static
    {
        $this->room_id = $room_id;

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

    public function isValidate(): ?bool
    {
        return $this->is_validate;
    }

    public function setValidate(bool $is_validate): static
    {
        $this->is_validate = $is_validate;

        return $this;
    }

    public function getBilling(): ?float
    {
        return $this->billing;
    }

    public function setBilling(float $billing): static
    {
        $this->billing = $billing;

        return $this;
    }


    public function getStatus(): ?BookingStatus
    {
        return $this->status;
    }

    public function setStatus(BookingStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCheckInAt(): ?\DateTimeImmutable
    {
        return $this->check_in_at;
    }

    public function setCheckInAt(\DateTimeImmutable $check_in_at): static
    {
        $this->check_in_at = $check_in_at;

        return $this;
    }

    public function getCheckOutAt(): ?\DateTimeImmutable
    {
        return $this->check_out_at;
    }

    public function setCheckOutAt(\DateTimeImmutable $check_out_at): static
    {
        $this->check_out_at = $check_out_at;

        return $this;
    }
    /**
     * @return Collection<int, NOTIFICATION>
     */
    public function getNOTIFICATIONs(): Collection
    {
        return $this->nOTIFICATIONs;
    }

    public function addNOTIFICATION(NOTIFICATION $nOTIFICATION): static
    {
        if (!$this->nOTIFICATIONs->contains($nOTIFICATION)) {
            $this->nOTIFICATIONs->add($nOTIFICATION);
            $nOTIFICATION->setBookingId($this);
        }

        return $this;
    }

    public function removeNOTIFICATION(NOTIFICATION $nOTIFICATION): static
    {
        if ($this->nOTIFICATIONs->removeElement($nOTIFICATION)) {
            // set the owning side to null (unless already changed)
            if ($nOTIFICATION->getBookingId() === $this) {
                $nOTIFICATION->setBookingId(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    
}
