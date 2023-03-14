<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: Booking::class, orphanRemoval: true)]
    private Collection $bookings;

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: Rating::class, orphanRemoval: true)]
    private Collection $ratings;

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: AccommodationImage::class, orphanRemoval: true)]
    private Collection $accommodationImages;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->accommodationImages = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setAccommodation($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getAccommodation() === $this) {
                $booking->setAccommodation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setAccommodation($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getAccommodation() === $this) {
                $rating->setAccommodation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccommodationImage>
     */
    public function getAccommodationImages(): Collection
    {
        return $this->accommodationImages;
    }

    public function addAccommodationImage(AccommodationImage $accommodationImage): self
    {
        if (!$this->accommodationImages->contains($accommodationImage)) {
            $this->accommodationImages->add($accommodationImage);
            $accommodationImage->setAccommodation($this);
        }

        return $this;
    }

    public function removeAccommodationImage(AccommodationImage $accommodationImage): self
    {
        if ($this->accommodationImages->removeElement($accommodationImage)) {
            // set the owning side to null (unless already changed)
            if ($accommodationImage->getAccommodation() === $this) {
                $accommodationImage->setAccommodation(null);
            }
        }

        return $this;
    }
}
