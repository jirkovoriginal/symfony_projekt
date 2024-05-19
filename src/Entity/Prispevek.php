<?php

namespace App\Entity;

use App\Repository\PrispevekRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: PrispevekRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_SLUG', fields: ['slug'])]
#[ORM\HasLifecycleCallbacks]
class Prispevek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nazev = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $obsah = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $obrazek1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $obrazek2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $obrazek3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $obrazek4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $obrazek5 = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $datum_vytvoreni = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'prispeveks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Uzivatel $autor = null;

    #[ORM\PrePersist]
    public function setDatumVytvoreniValue(): void
    {
        $this->datum_vytvoreni = new \DateTimeImmutable();
    }

    public function createSlug(SluggerInterface $slugger): void
    {
        $this->slug = $slugger->slug($this->nazev);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): static
    {
        $this->nazev = $nazev;

        return $this;
    }

    public function getObsah(): ?string
    {
        return $this->obsah;
    }

    public function setObsah(string $obsah): static
    {
        $this->obsah = $obsah;

        return $this;
    }

    public function getObrazek1(): ?string
    {
        return $this->obrazek1;
    }

    public function setObrazek1(?string $obrazek1): static
    {
        $this->obrazek1 = $obrazek1;

        return $this;
    }

    public function getObrazek2(): ?string
    {
        return $this->obrazek2;
    }

    public function setObrazek2(?string $obrazek2): static
    {
        $this->obrazek2 = $obrazek2;

        return $this;
    }

    public function getObrazek3(): ?string
    {
        return $this->obrazek3;
    }

    public function setObrazek3(?string $obrazek3): static
    {
        $this->obrazek3 = $obrazek3;

        return $this;
    }

    public function getObrazek4(): ?string
    {
        return $this->obrazek4;
    }

    public function setObrazek4(?string $obrazek4): static
    {
        $this->obrazek4 = $obrazek4;

        return $this;
    }

    public function getObrazek5(): ?string
    {
        return $this->obrazek5;
    }

    public function setObrazek5(?string $obrazek5): static
    {
        $this->obrazek5 = $obrazek5;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAutor(): ?Uzivatel
    {
        return $this->autor;
    }

    public function setAutor(?Uzivatel $autor): static
    {
        $this->autor = $autor;

        return $this;
    }
}
