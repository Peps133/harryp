<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: MaisonRepository::class)]
#[Broadcast]
class Maison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    private $eleve;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }


    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addEleve(Eleve $eleve): self
    {
        if (!$this->eleve->contains($cours)) {
            $this->eleve[] = $eleve;
            $eleve->addMaison($this);
        }
        return $this;
    }

    public function removeEleve(Eleve $eleve): self{
        if ($this->eleve->removeElement($eleve)) {
            $eleve->removeEleve($this);
        }
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
