<?php

namespace App\Entity;

use App\Repository\VersementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersementRepository::class)]
class Versement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $objet;

    #[ORM\Column(type: 'string', length: 255)]
    private $partieVersante;

    #[ORM\Column(type: 'integer')]
    private $montant;


    #[ORM\Column(type: 'date')]
    private $dateDeVersement;

    #[ORM\Column(type: 'string', length: 255)]
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getPartieVersante(): ?string
    {
        return $this->partieVersante;
    }

    public function setPartieVersante(string $partieVersante): self
    {
        $this->partieVersante = $partieVersante;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDeVersement(): ?\DateTimeInterface
    {
        return $this->dateDeVersement;
    }

    public function setDateDeVersement(\DateTimeInterface $dateDeVersement): self
    {
        $this->dateDeVersement = $dateDeVersement;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
