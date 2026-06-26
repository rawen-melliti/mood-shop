<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(nullable: true)]
    private ?int $evaluation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $creation_en = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getEvaluation(): ?int
    {
        return $this->evaluation;
    }

    public function setEvaluation(?int $evaluation): static
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getCreationEn(): ?\DateTimeImmutable
    {
        return $this->creation_en;
    }

    public function setCreationEn(?\DateTimeImmutable $creation_en): static
    {
        $this->creation_en = $creation_en;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}
