<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Giveaway", mappedBy="category")
     */
    private $giveaways;

    public function __construct()
    {
        $this->giveaways = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Giveaway[]
     */
    public function getGiveaways(): Collection
    {
        return $this->giveaways;
    }

    public function addGiveaway(Giveaway $giveaway): self
    {
        if (!$this->giveaways->contains($giveaway)) {
            $this->giveaways[] = $giveaway;
            $giveaway->setCategory($this);
        }

        return $this;
    }

    public function removeGiveaway(Giveaway $giveaway): self
    {
        if ($this->giveaways->contains($giveaway)) {
            $this->giveaways->removeElement($giveaway);
            // set the owning side to null (unless already changed)
            if ($giveaway->getCategory() === $this) {
                $giveaway->setCategory(null);
            }
        }

        return $this;
    }
}
