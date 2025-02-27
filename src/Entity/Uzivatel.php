<?php

namespace App\Entity;

use App\Repository\UzivatelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Enums\UserRoles;

#[ORM\Entity(repositoryClass: UzivatelRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Uzivatel implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $jmeno = null;

    /**
     * @var Collection<int, Prispevek>
     */
    #[ORM\OneToMany(targetEntity: Prispevek::class, mappedBy: 'autor', orphanRemoval: true)]
    private Collection $prispeveks;

    #[ORM\Column]
    private bool $isVerified = false;

    public function __construct()
    {
        $this->prispeveks = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function setRolesValue(): void
    {
        $this->roles[] = UserRoles::Uzivatel;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = UserRoles::Uzivatel->value();
        
        return array_unique(array_map(fn($role) => $role instanceof \App\Enums\UserRoles ? $role->value() : $role, $roles));
        
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): static
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    /**
     * @return Collection<int, Prispevek>
     */
    public function getPrispeveks(): Collection
    {
        return $this->prispeveks;
    }

    public function addPrispevek(Prispevek $prispevek): static
    {
        if (!$this->prispeveks->contains($prispevek)) {
            $this->prispeveks->add($prispevek);
            $prispevek->setAutor($this);
        }

        return $this;
    }

    public function removePrispevek(Prispevek $prispevek): static
    {
        if ($this->prispeveks->removeElement($prispevek)) {
            // set the owning side to null (unless already changed)
            if ($prispevek->getAutor() === $this) {
                $prispevek->setAutor(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
