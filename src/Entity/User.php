<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Giveaway", mappedBy="user")
     */
    private $giveaway;

    public function __construct()
    {
        $this->giveaway = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Giveaway[]
     */
    public function getGiveaway(): Collection
    {
        return $this->giveaway;
    }

    public function addGiveaway(Giveaway $giveaway): self
    {
        if (!$this->giveaway->contains($giveaway)) {
            $this->giveaway[] = $giveaway;
            $giveaway->setUser($this);
        }

        return $this;
    }

    public function removeGiveaway(Giveaway $giveaway): self
    {
        if ($this->giveaway->contains($giveaway)) {
            $this->giveaway->removeElement($giveaway);
            // set the owning side to null (unless already changed)
            if ($giveaway->getUser() === $this) {
                $giveaway->setUser(null);
            }
        }

        return $this;
    }
}
