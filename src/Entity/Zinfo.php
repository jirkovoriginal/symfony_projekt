<?php

namespace App\Entity;

use App\Repository\ZinfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ZinfoRepository::class)]
class Zinfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nazev = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $obsah = null;

    #[ORM\Column(length: 255)]
    private ?string $odkaz = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getOdkaz(): ?string
    {
        return $this->odkaz;
    }

    public function setOdkaz(string $odkaz): static
    {
        $this->odkaz = $odkaz;

        return $this;
    }
}
