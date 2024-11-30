<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?float $Prix = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Photo::class)]
    private Collection $photos;

    /**
     * @var Collection<int, Modification>
     */
    #[ORM\OneToMany(targetEntity: Modification::class, mappedBy: 'service')]
    private Collection $modifications;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $CategoriePrincipale = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $SousCategorie1 = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $SousCategorie2 = null;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->modifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setService($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            if ($photo->getService() === $this) {
                $photo->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modification>
     */
    public function getModifications(): Collection
    {
        return $this->modifications;
    }

    public function addModification(Modification $modification): static
    {
        if (!$this->modifications->contains($modification)) {
            $this->modifications->add($modification);
            $modification->setService($this);
        }

        return $this;
    }

    public function removeModification(Modification $modification): static
    {
        if ($this->modifications->removeElement($modification)) {
            // set the owning side to null (unless already changed)
            if ($modification->getService() === $this) {
                $modification->setService(null);
            }
        }

        return $this;
    }

    public function getCategoriePrincipale(): ?string
    {
        return $this->CategoriePrincipale;
    }

    public function setCategoriePrincipale(string $CategoriePrincipale): static
    {
        $this->CategoriePrincipale = $CategoriePrincipale;

        return $this;
    }

    public function getSousCategorie1(): ?string
    {
        return $this->SousCategorie1;
    }

    public function setSousCategorie1(string $SousCategorie1): static
    {
        $this->SousCategorie1 = $SousCategorie1;

        return $this;
    }

    public function getSousCategorie2(): ?string
    {
        return $this->SousCategorie2;
    }

    public function setSousCategorie2(string $SousCategorie2): static
    {
        $this->SousCategorie2 = $SousCategorie2;

        return $this;
    }
}
