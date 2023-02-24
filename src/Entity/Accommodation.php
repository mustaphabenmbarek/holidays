<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccommodationRepository::class)]
class Accommodation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $NbrMaxPerson = null;

    #[ORM\Column]
    private ?float $nightPrice = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbrMaxPerson(): ?int
    {
        return $this->NbrMaxPerson;
    }

    public function setNbrMaxPerson(int $NbrMaxPerson): self
    {
        $this->NbrMaxPerson = $NbrMaxPerson;

        return $this;
    }

    public function getNightPrice(): ?float
    {
        return $this->nightPrice;
    }

    public function setNightPrice(float $nightPrice): self
    {
        $this->nightPrice = $nightPrice;

        return $this;
    }
}
