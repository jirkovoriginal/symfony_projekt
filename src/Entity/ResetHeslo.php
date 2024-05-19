<?php

namespace App\Entity;

use App\Repository\ResetHesloRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResetHesloRepository::class)]
class ResetHeslo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $kod = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $datum_vytvoreni = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Uzivatel $uzivatel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKod(): ?string
    {
        return $this->kod;
    }

    public function setKod(string $kod): static
    {
        $this->kod = $kod;

        return $this;
    }

    public function getDatumVytvoreni(): ?\DateTimeImmutable
    {
        return $this->datum_vytvoreni;
    }

    public function setDatumVytvoreni(\DateTimeImmutable $datum_vytvoreni): static
    {
        $this->datum_vytvoreni = $datum_vytvoreni;

        return $this;
    }

    public function getUzivatel(): ?Uzivatel
    {
        return $this->uzivatel;
    }

    public function setUzivatel(Uzivatel $uzivatel): static
    {
        $this->uzivatel = $uzivatel;

        return $this;
    }
}
