<?php

namespace App\Entity;

use App\Repository\RoomImgRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;



#[ORM\Entity(repositoryClass: RoomImgRepository::class)]
#[Vich\Uploadable]
class RoomImg
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Vich\UploadableField(mapping: 'ROOM', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    
    #[ORM\ManyToOne(inversedBy: 'roomImgs')]
    private ?ROOM $Room = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoom(): ?ROOM
    {
        return $this->Room;
    }

    public function setRoom(?ROOM $Room): static
    {
        $this->Room = $Room;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    
}