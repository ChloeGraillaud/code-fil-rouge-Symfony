<?php

namespace App\Entity;

use App\Repository\VerificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VerificationRepository::class)]
class Verification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Statut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateVerification = null;

    #[ORM\ManyToOne(inversedBy: 'verifications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Admin $idAdmin = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Commentaire $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getDateVerification(): ?\DateTimeInterface
    {
        return $this->DateVerification;
    }

    public function setDateVerification(\DateTimeInterface $DateVerification): static
    {
        $this->DateVerification = $DateVerification;

        return $this;
    }

    public function getIdAdmin(): ?Admin
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(?Admin $idAdmin): static
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Commentaire $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
