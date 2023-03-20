<?php

namespace App\Entity;

use App\Repository\AccommodationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AccommodationRepository::class)]
#[Vich\Uploadable]
class Accommodation
{
    use TimestampableEntity;
    
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
    private ?int $nbrMaxPerson = null;

    #[ORM\Column]
    private ?float $nightPrice = null;

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: Booking::class, orphanRemoval: true)]
    private Collection $bookings;

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: Rating::class, orphanRemoval: true)]
    private Collection $ratings;

    #[ORM\OneToMany(mappedBy: 'accommodation', targetEntity: AccommodationImage::class, orphanRemoval: true)]
    private Collection $accommodationImages;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'accommodations', fileNameProperty: 'image')]
    private ?File $imageFile = null;

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
        return $this->nbrMaxPerson;
    }

    public function setNbrMaxPerson(int $NbrMaxPerson): self
    {
        $this->nbrMaxPerson = $NbrMaxPerson;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
