<?php

namespace App\Entity;

use App\Repository\DepenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepenseRepository::class)]
class Depense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $imputationBudgetaire;

    #[ORM\Column(type: 'string', length: 255)]
    private $objet;

    #[ORM\Column(type: 'string', length: 255)]
    private $beneficiaire;

    #[ORM\Column(type: 'integer')]
    private $montant;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'integer')]
    private $numeroMandat;

    #[ORM\Column(type: 'string', length: 5)]
    private $numero;

    #[ORM\Column(type: 'string', length: 255)]
    private $compteTiers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImputationBudgetaire(): ?string
    {
        return $this->imputationBudgetaire;
    }

    public function setImputationBudgetaire(string $imputationBudgetaire): self
    {
        $this->imputationBudgetaire = $imputationBudgetaire;

        return $this;
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

    public function getBeneficiaire(): ?string
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(string $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumeroMandat(): ?int
    {
        return $this->numeroMandat;
    }

    public function setNumeroMandat(int $numeroMandat): self
    {
        $this->numeroMandat = $numeroMandat;

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

    public function getCompteTiers(): ?string
    {
        return $this->compteTiers;
    }

    public function setCompteTiers(string $compteTiers): self
    {
        $this->compteTiers = $compteTiers;

        return $this;
    }
}
