<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
#[Broadcast]
class Eleve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    
    private $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCours(Cours $cours): self
    {
        if (!$this->cours->contains($cours)) {
            $this->cours[] = $cours;
            $cours->addEleve($this);
        }

        return $this;
    }

    public function removeCours(Cours $cours): self
    {
        if ($this->cours->removeElement($cours)) {
            $cours->removeEleve($this);
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    private $maison;


    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): self
    {
        $this->maison = $maison;

        return $this;
    }


    private $professeurs;

    /**
     * @return Collection|Professeur[]
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->addEleve($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeEleve($this);
        }

        return $this;
    }


}
