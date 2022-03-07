<?php

namespace App\Entity;

use App\Repository\RepasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RepasRepository::class)
 */
class Repas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ingrediant1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbCaloris;

    /**
     * @ORM\ManyToOne(targetEntity=ProgNutri::class, inversedBy="repas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $progNutr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getIngrediant1(): ?string
    {
        return $this->ingrediant1;
    }

    public function setIngrediant1(string $ingrediant1): self
    {
        $this->ingrediant1 = $ingrediant1;

        return $this;
    }

    public function getNbCaloris(): ?int
    {
        return $this->nbCaloris;
    }

    public function setNbCaloris(?int $nbCaloris): self
    {
        $this->nbCaloris = $nbCaloris;

        return $this;
    }

    public function getProgNutr(): ?ProgNutri
    {
        return $this->progNutr;
    }

    public function setProgNutr(?ProgNutri $progNutr): self
    {
        $this->progNutr = $progNutr;

        return $this;
    }
}
