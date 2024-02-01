<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
#[Broadcast]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    private $eleves;

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
        if (!$this->eleves->contains($eleve)) {
            $this->eleves[] = $eleve;
            $eleve->addProfesseur($this);
        }

        return $this;
    }

    public function removeEleve(Eleve $eleve): self
    {
        if ($this->eleves->removeElement($eleve)) {
            $eleve->removeProfesseur($this);
        }

        return $this;
    }
}
